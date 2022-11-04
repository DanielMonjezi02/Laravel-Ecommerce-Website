@extends('layouts.app')

@section('title', 'Showing ')

<div class="productList">
    <h2> Product Name: {{ $product->name }} </h2>
    <h2> Description: {{ $product->description }} </h2>
    <h2> Price: {{ $product->price }} </h2>
    <h2> ID: {{ $product->id }} </h2>
</div>
