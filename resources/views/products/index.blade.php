@extends('layouts.app')

@section('title', 'Products')

@if ($message = Session::get('added'))

<div class="alert-success">
    <p><u>{{ $message }}</u></p>
</div>
@endif

<div class ="productList">
@foreach ($products as $product)
        <article>
                <h3 class="productName"><u>{{ $product->name }}</u></h3>
                <p>{{ $product->description }}</p>
                <p><b>Price: £{{ $product->price }}</b></p>
                <form action="{{ route('addProductToCart', $product->id) }}" method="POST">
                        @csrf
                        <p><b>Quantity</b>
                        <select name="quantity" id="quan">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                        </select></p>
                        <button type="submit" class="btn btn-blue">Add to cart</button>
                </form>
        </article>
@endforeach
</div>
