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
            <h3 class="productName"><u>{{ $cart->product->name }}</u> £{{ $cart->product->price }}</h3>
            <form action="{{ route('cart.destroy', $cart->id) }}" method="POST">
                <a class="btn btn-blue" href="{{ route('cart.show', $cart->id) }}">Show</a>
                @csrf
                @method('DELETE')
                    <button type="submit" class="btn btn-red">Delete</button>
            </form>
        @endif
        </article>
    </div>

@endforeach
