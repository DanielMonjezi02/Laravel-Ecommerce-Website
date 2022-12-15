@extends('layouts.app')

@section('title', ucfirst($product->name) . ' Reviews')

@foreach ($reviews as $review)
    <div class ="productList">
        <article>
            <h3><u>Rating: {{ $review->rating }}/5</u></h3>
            <p>{{ $review->comment }}</p>
            @if (Auth::user() != NULL & (Auth::user() == $review->user))
                <form action="{{ route('reviewProduct', $product) }}">
                    <button>Edit Your Review<button>
                </form>
            @endif
        </article>
    </div>
@endforeach
