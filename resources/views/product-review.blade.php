@extends('layouts.app')

@section('title', 'Security')

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('product-review.css') }}" >
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
                <form action="{{ url('/add-rating') }}" method="">
                    <h1>Rate: {{ $products->name }}</h1>
                    <div class="rating-css">
                        <div class="star-icon">
                            <input type="radio" value="1" name="product_rating" checked id="rating1">
                            <label for="rating1" class="fa fa-star"></label>
                            <input type="radio" value="2" name="product_rating" id="rating2">
                            <label for="rating2" class="fa fa-star"></label>
                            <input type="radio" value="3" name="product_rating" id="rating3">
                            <label for="rating3" class="fa fa-star"></label>
                            <input type="radio" value="4" name="product_rating" id="rating4">
                            <label for="rating4" class="fa fa-star"></label>
                            <input type="radio" value="5" name="product_rating" id="rating5">
                            <label for="rating5" class="fa fa-star"></label>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
</body>