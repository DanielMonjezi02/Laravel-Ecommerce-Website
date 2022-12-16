<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Stripe\StripeClient;

class CartController extends Controller
{

    protected $stripe;

    public function __construct(StripeClient $stripe)
    {
        $this->stripe = $stripe;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::id();
        $carts = Cart::where('user_id', $user_id)->get();
        return view('cart', ['carts' => $carts]);
    }

    public function addProductToCart(Request $request, Product $product)
    {
        $user_id = Auth::id();
        if(Cart::where('product_id', $product->id)->where('user_id', $user_id)->exists() == true) // Checks if a cart already exists that matches with the user
        {   
            $product = Cart::where('product_id', $product->id)->where('user_id', $user_id)->first();
            $totalQuantity = $product->quantity + $request->get('quantity'); // Adds quantity from database and the quantity user selected
            $product->quantity = $totalQuantity; // Updates the quantity in the database
            $product->save(); 
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

        if(session()->has('coupon'))
        {
            $coupon_amount = session()->get('coupon')['discount'];
            $totalCartPrice = $totalCartPrice - $coupon_amount;
        }

        if($totalCartPrice < 0)
        {
            $totalCartPrice = 0;
        }
        return $totalCartPrice;
    }

    public function checkout()
    {
        if($this->getTotalCartPrice() == 0) // Ensures that the cart total price has to be higher than £0 and a free order can't be placed as stripe accepts a minimum charge of 0.50 GBP
        {
            return redirect()->route('cart.index')->with('alert', 'Your cart cant be equal to £0. Please ensure your cart total is above £0'); 
        }
        $user_id = Auth::id();
        $stripe = $this->stripe;

        // Creates an order table
        $order = new Order();
        $order->id = fake()->numerify('######');
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

        $sessionData = ([
            'line_items' => $listOfProducts,
            'mode' => 'payment',
            'success_url' => route('checkout.success', [], true)."?session_id={CHECKOUT_SESSION_ID}",
            'cancel_url' => route('checkout.cancel', [], true)."?session_id={CHECKOUT_SESSION_ID}",
        ]);

        // Conditionally add coupon if it exists in session
        if ($coupon = session('coupon.name')) {
            $sessionData['discounts'] = [
                [
                    'coupon' => $coupon,
                ],
            ];
        }

        $checkout_session = $stripe->checkout->sessions->create($sessionData);

        $order->session_id = $checkout_session->id;
        $order->save();

        return redirect()->away($checkout_session->url); // This will direct user to checkout page and they will either go to the checkout.success or checkout.cancel route after checkout depening on their action 
    }

    public function successOrder(Request $request)
    {
        $session_id = $this->checkSessionID($request);
        $order = Order::where('session_id', $session_id)->where('status', 'unpaid')->first();
        $order->success();

        return redirect()->route('orders')->with('alert', 'Your order ' . $order->id . ' was successful');
    }

    public function cancelOrder(Request $request)
    {
        $session_id = $this->checkSessionID($request);
        $order = Order::where('session_id', $session_id)->where('status', 'unpaid')->first();
        $order->cancelled();

        return redirect()->route('cart.index')->with('alert', 'You cancelled your order');
    }

    public function checkSessionID(Request $request)
    {
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET_KEY'));
        $session_id = $request->get('session_id');
        
        // Check if a session ID exists in stripe system so a random person without a valid order can not access this successOrder function
        try{         
            $session = $stripe->checkout->sessions->retrieve($session_id); 
            if(!$session){
                abort(403, 'Checkout session does not exist.');
            }
        }catch(\Exception $a)
        {
            abort(403, 'Checkout session does not exist.');
        }

        return $session_id;
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
