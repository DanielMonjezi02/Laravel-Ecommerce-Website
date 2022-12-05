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
        $stripe = new \Stripe\StripeClient('sk_test_26PHem9AhJZvU623DfE1x4sd');

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
          'success_url' => route('checkout.success', [], true),
          'cancel_url' => route('checkout.cancel', [], true),
        ]);


        return redirect()->away($checkout_session->url);
    }

    public function sucessOrder()
    {

    }

    public function cancelOrder()
    {

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

        return redirect()->route('cart.index')->with('deleted', 'Deleted product from cart');
    }
}
