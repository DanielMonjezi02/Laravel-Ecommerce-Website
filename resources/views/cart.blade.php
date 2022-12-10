@php
    use App\Http\Controllers\CartController;
@endphp
@extends('layouts.app')
@section('title', 'Shopping Cart')

@if ($message = Session::get('alert'))
    <div class="alert-success">
        <p><u>{{ $message }}</u></p>
    </div>
@endif

@if(count($carts) > 0)
    @foreach ($carts as $cart)
        <div class ="productList">
            <article>
            @if (Auth::user() && Auth::user()->id === $cart->user_id)
                <h3 class="productName"><u>{{ $cart->product->name }}</u> £{{ (($cart->product->price)*($cart->quantity)) }}</h3>
                <p class="cartQuantity">Quantity: {{ $cart->quantity }}</p>
                <form action="{{ route('cart.destroy', $cart->id) }}" method="POST">
                    <button><a style="text-decoration:none" href="{{ route('cart.show', $cart->id) }}">Show</a></button>
                    @csrf
                    @method('DELETE')
                        <button type="submit" class="btn btn-red">Delete</button>
                </form>
            @endif
            </article>
        </div>
    @endforeach
    @if(session()->has('coupon'))
        <h2 class="cartTotal">Subtotal Total: £{{ CartController::getTotalCartPrice() }} </h2>
        <h2>Discount ({{ session()->get('coupon')['name'] }}) : £{{ session()->get('coupon')['discount']}}</h2>
        <form action="{{ route('coupon.destroy') }}" method="POST">
        @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-red">Remove Coupon</button>
        </form>
    @endif
    <h2 class="cartTotal">Cart Total: £{{ CartController::getTotalCartPrice() }} </h2>
    <form action="{{route('checkout')}}" method="POST">
        @csrf
        <button type ="submit">Checkout</button>
    </form>
    <a>Coupon:</a>
    <form action="{{ route('coupon.store') }}" method="POST">
        @csrf
        <input type="text" name="coupon_code">
        <button type="submit">Apply</button>
    </form>
@else
    <h1>Your cart is currently empty</h1>
@endif