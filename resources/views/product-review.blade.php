@extends('layouts.app')

@section('title', 'Product Review')

@if ($message = Session::get('alert'))
    <div class="alert-success">
        <p><u>{{ $message }}</u></p>
    </div>
@endif

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('product-review.css') }}" >
    <script src="https://kit.fontawesome.com/fc29d1c1ef.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container-fluid">
        <div class="row">   
            <div class="col-md-4">
                <img src="https://i.imgur.com/k5wmPtf.jpg" />
                <h2>{{ $user->username }}</h2>
                <a class="btn btn-primary" href="{{ url('/account') }}" role="button">Account</a>
                <a class="btn btn-primary" href="{{ url('/account/security') }}" role="button">Security</a>
                <a class="btn btn-primary" href="{{ route('orders') }}" role="button">Orders</a>
            </div>
            <div class="col-md-8" style="margin: 100px auto;">
                <form action="{{ url('/addReview') }}" method="POST">
                    @csrf
                    <h2>Product: {{ ucfirst($product->name) }}</h2>
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <div class="rating">
                        <input type="radio" value="5" name="product_rating" id="star1"><label for="star1"></label>
                        <input type="radio" value="4" name="product_rating" id="star2"><label for="star2"></label>
                        <input type="radio" value="3" name="product_rating" id="star3"><label for="star3"></label>
                        <input type="radio" value="2" name="product_rating" id="star4"><label for="star4"></label>
                        <input type="radio" value="1" name="product_rating" id="star5"><label for="star5"></label>
                    </div>
                    <h3>Comment:</h3>
                    <textarea id="comment" name="comment" rows="4" cols="50" style="resize: none; margin: 80px auto"></textarea>
                    <button type="submit" class="btn btn-primary" style="margin-top: 20px;">Leave Review</button>
                </form>
            </div>
        </div>
    </div>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
</body>