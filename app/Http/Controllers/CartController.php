<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
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
        if($productList = Cart::where('product_id', $product->id)->where('user_id', $user_id)->exists() == true) // Checks if a cart already exists that matches with the user
        {   
            $quantitySelected = $request->get('quantity'); //Gets the quantity the user selected
            $productList = Cart::where('product_id', $product->id)->where('user_id', $user_id)->first();
            $totalQuantity = $productList->quantity + $quantitySelected;
            $productList = Cart::where('product_id', $product->id)->where('user_id', $user_id)->update(['quantity' => $totalQuantity]); // Updates the quantity in the database 
        }
        else
        {
            $cart = new Cart;
            $cart->product_id = $product->id;
            $cart->quantity = $request->get('quantity');
            $cart->user()->associate(Auth::user());
            $cart->save();
        }

        return redirect()->route('products.index')->with('added', 'Added product to cart');   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {
        //
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
