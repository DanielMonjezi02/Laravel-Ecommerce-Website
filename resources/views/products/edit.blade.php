@extends('layouts.app')

@section('title', 'Edit Product')

<div class ="showProduct">
    <article>
        <form action="{{ route('products.update', $product->id) }}" method="POST">
            @csrf
            @method('PUT')
                <label for="description">Description:</label>
                <textarea name="description" id="description" row="5" class=" p-2 bg-gray-200 @error('description') is-invalid @enderror"> {{ $product->description }}</textarea>
                @error('comments')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <button type="submit" class="btn btn-blue">Update</button>
        </form>
    </article>
</div>