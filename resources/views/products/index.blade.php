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
                <a href="{{ route('products.show', $product->id) }}"><button>Add to cart</button></a>
                <a class="btn btn-blue" href="{{ route('products.edit', $product->id) }}"><button>Edit Product</button></a>
        </article>
@endforeach
</div>
