@extends('layouts.app')

@section('title', 'Orders')

@if ($message = Session::get('alert'))
    <div class="alert-success">
        <p><u>{{ $message }}</u></p>
    </div>
@endif

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('account.css') }}" >
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <img src="https://i.imgur.com/k5wmPtf.jpg" />
                <h2>{{ $user->username }}</h2>
                <a class="btn btn-primary" href="{{ url('/account') }}" role="button">Account</a>
                <a class="btn btn-primary" href="{{ ('/account/security') }}" role="button">Security</a>
                <a class="btn btn-primary" href="{{ route('orders') }}" role="button">Orders</a>
            </div>
            @if(count($orders) > 0)
                <div class="col-md-4" style="margin: 100px auto;">
                    <div class="row">
                        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                            <b><u><p>Order Number</p></u></b>
                            @foreach ($orders as $order)
                                <a href ="{{ route('orderDetails', $order) }}">{{ $order->id }}</a>
                                <div class="w-100" style="margin: 10px auto;"></div>
                            @endforeach
                        </div>
                        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                            <b><u><p>Date</p></u></b>
                            @foreach ($orders as $order)
                                <p>{{ date('d-M-y', strtotime($order->created_at)) }}</p>
                            @endforeach
                        </div>
                        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                            <b><u><p>Price</p></u></b>
                            @foreach ($orders as $order)
                                <p>£{{ $order->total_price }}</p>
                            @endforeach
                        </div>
                        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                            <b><u><p>Status</p></u></b>
                            @foreach ($orders as $order)
                                <p>{{ucfirst ($order->status)}}</p>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
</body>