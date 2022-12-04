@extends('layouts.app')

@section('title', 'Shopping Cart')

@if ($message = Session::get('deleted'))

<div class="alert-success">
    <p><u>{{ $message }}</u></p>
</div>
@endif


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
