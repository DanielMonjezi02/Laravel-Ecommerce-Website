@extends('layouts.app')

@section('title', 'Security')

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
                <a class="btn btn-primary" href="{{ route('orders') }}" role="button">Orders</a>
            </div>
            <div class="col-md-8" style="margin: 100px auto;">
            @if(! auth()->user()->two_factor_secret)
                <h2>You have not enabled two factor authentication</h2>
                <form method="POST" action="{{ url('user/two-factor-authentication') }}">
                    @csrf
                    <button type="submit">Enable</button>
                </form>
            @else
                <form method="POST" action="{{ url('user/two-factor-authentication') }}">
                @csrf
                @method('DELETE')
                    <h2>You have enabled two factor authentication</h2>
                    <button type="submit">Disable</button>
                    <p>You have enabled two factor authentication, please scan the following QR code into your phones authenticator application.</p>
                        {!! auth()->user()->twoFactorQrCodeSvg() !!}

                    <h3>Recovery Codes</h3>
                        @foreach(auth()->user()->recoveryCodes() as $code )
                    <li>{{ $code }}</li>
                @endforeach
            </form>
            @endif
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
</body>