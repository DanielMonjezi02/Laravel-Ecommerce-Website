@extends('layouts.app')

@section('title', 'Account Details')

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
                <a class="btn btn-primary" href="{{ url('/account/orders') }}" role="button">Orders</a>
            </div>
            <div class="col-md-8" style="margin: 100px auto;">
                <h1>Personal Info</h1>
                </h2>Username:</h2>
                <input name="name" id="name" value="{{ $user->username }}" type="text" readonly>
                <div class="w-100" style="margin: 20px auto;"></div>
                </h2>Email:</h2>
                <input name="name" id="name" value="{{ $user->email }}" type="text" readonly>
                <div class="w-100" style="margin: 20px auto;"></div>
                </h2>Birthday:</h2>
                <input name="name" id="name" value="{{ $user->dob }}" type="text" readonly>
                <div class="w-100" style="margin: 20px auto;"></div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
</body>