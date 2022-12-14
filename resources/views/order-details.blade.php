@extends('layouts.app')

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
                <a class="btn btn-primary" href="{{ url('/account/security') }}" role="button">Security</a>
                <a class="btn btn-primary" href="{{ route('orders')) }}" role="button">Orders</a>
            </div>
            <div class="col-md-4" style="margin: 100px auto;">
                <div class="row">
                    <h2>Order: {{$order->id}} ({{ ucfirst($order->status) }})</h2>
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        <b><u><p>Product Name</p></u></b>
                        @foreach ($orderItems as $orderItem)
                            @if($order->status == 'paid')
                                <p>{{ucfirst($orderItem->product->name) }} - Review Product</p>
                            @else
                                <p>{{ucfirst($orderItem->product->name) }}</p>
                            @endif
                        @endforeach
                    </div>
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        <b><u><p>Quantity</p></u></b>
                        @foreach ($orderItems as $orderItem)
                            <p>{{ $orderItem->quantity }}</p>
                        @endforeach
                    </div>
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        <b><u><p>Price Per Unit</p></u></b>
                        @foreach ($orderItems as $orderItem)
                            <p>£{{ $orderItem->product->price }}</p>
                        @endforeach
                    </div>
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        <b><u><p>Total Product Price</p></u></b>
                        @foreach ($orderItems as $orderItem)
                            <p>£{{ (($orderItem->product->price)*($orderItem->quantity)) }}</p>
                        @endforeach
                        <b><p>Order Total: £{{ $order->total_price }}</p></b>
                        @if($order->status == 'paid')
                            <b><p>Amount Paid: £{{ $order->total_price }}</p></b>
                        @else
                            <b><p>Amount Paid: £0.00</p></b>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
</body>