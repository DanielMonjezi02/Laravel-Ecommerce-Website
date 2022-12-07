<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carts = Cart::orderBy('id', 'desc')->paginate(20);
        return view('cart', ['carts' => $carts]);
    }

    public function addProductToCart(Request $request, Product $product)
    {
        $user_id = Auth::id();
        if(Cart::where('product_id', $product->id)->where('user_id', $user_id)->exists() == true) // Checks if a cart already exists that matches with the user
        {   
            $quantitySelected = $request->get('quantity'); //Gets the quantity the user selected
            $product = Cart::where('product_id', $product->id)->where('user_id', $user_id)->first();
            $totalQuantity = $product->quantity + $quantitySelected;
            $product = Cart::where('product_id', $product->id)->where('user_id', $user_id)->update(['quantity' => $totalQuantity]); // Updates the quantity in the database 
        }
        else
        {
            if(Product::where('id', $product->id)->where('name', $product->name)->where('description', $product->description)->exists() == true) // Checks if product exists in database
            {
                $cart = new Cart;
                $cart->product_id = $product->id;
                $cart->quantity = $request->get('quantity');
                $cart->user()->associate(Auth::user());
                $cart->save(); 
            }
            else
            {
                return redirect()->route('products.index')->with('alert', 'Product does not exist! Has not been added to cart.');  
            }
        }
        
        return redirect()->route('products.index')->with('alert', 'Added product to cart');   
    }

    public static function getTotalCartPrice()
    {
        $user_id = Auth::id();
        $totalCartPrice = 0;
        $carts = Cart::where('user_id', $user_id)->get();

        foreach($carts as $cart)
        {
            $totalCartPrice = $totalCartPrice + ($cart->product->price * $cart->quantity);
        }
    
        return $totalCartPrice;
    }

    public function checkout()
    {
        $user_id = Auth::id();
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET_KEY'));

        // Creates an order
        $order = new Order();
        $order->status = 'unpaid';
        $order->total_price = $this->getTotalCartPrice();
        $order->user()->associate(Auth::user());
        $order->save();


        $carts = Cart::where('user_id', $user_id)->get();
        $listOfProducts = [];
        foreach($carts as $cart)
        {
            $listOfProducts[] = [
                'price_data' => [
                    'currency' => 'gbp',
                    'product_data' => [
                        'name' => $cart->product->name,
                    ],
                    'unit_amount' => $cart->product->price * 100,
                ],
                'quantity' => $cart->quantity,
            ]; 
        
            // Creates an orderItem table for each product in the cart and associates it with the order. This allows us to check what products are linked with the order
            $orderItem = new OrderItem();
            $orderItem->user()->associate(Auth::user());
            $orderItem->product()->associate($cart->product);
            $orderItem->quantity = $cart->quantity; 
            $orderItem->unit_price = $cart->product->price;
            $orderItem->order()->associate($order->id);
            $orderItem->save();

        }

        $checkout_session = $stripe->checkout->sessions->create([
          'line_items' => $listOfProducts,
          'mode' => 'payment',
          'success_url' => route('checkout.success', [], true)."?session_id={CHECKOUT_SESSION_ID}",
          'cancel_url' => route('checkout.cancel', [], true),
        ]);
        $order->session_id = $checkout_session->id;
        $order->save();

        return redirect()->away($checkout_session->url); // This will direct user to checkout page and they will either go to the checkout.success or checkout.cancel route after checkout depening on their action 
    }

    public function successOrder(Request $request)
    {
        $stripe = new \Stripe\StripeClient('sk_test_26PHem9AhJZvU623DfE1x4sd');
        $session_id = $request->get('session_id');
        
        // Check if a session ID exists in stripe system so a random person without a valid order can not access this successOrder function
        try{         
            $session = $stripe->checkout->sessions->retrieve($session_id); 
            if(!$session){
                throw new NotFoundHttpException;
            }
        }catch(\Exception $a)
        {
            throw new NotFoundHttpException;
        }

        $order = Order::where('session_id', $session_id)->where('status', 'unpaid')->first();
        $order->status = 'paid';
        $order->save();

        // Redirect user to orders page with notification informaing them that their order has been successful
        return redirect()->route('sendOrderConfirmedMail'); // Send an email confirmation to user and redirects back to the order page
    
    }

    public function cancelOrder()
    {
        return redirect()->route('sendOrderFailedMail');
        return redirect()->route('cart.index')->with('alert', 'You cancelled your order');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */

    public function show(Cart $cart)
    {
        return view('products.show', ['product' => $cart->product]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart)
    {
        $cart->delete();

        return redirect()->route('cart.index')->with('alert', 'Deleted product from cart');
    }
}
