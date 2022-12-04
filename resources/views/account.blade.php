@extends('layouts.app')

@section('title', 'Account Details')

<div class ="account">
    @if(! auth()->user()->two_factor_secret)
        <p>You have not enabled 2fa</p>
        <form method="POST" action="{{ url('user/two-factor-authentication') }}">
        @csrf
            <button type="submit">Enable</button>
        </form>
    @else
        <form method="POST" action="{{ url('user/two-factor-authentication') }}">
            @csrf
            @method('DELETE')
                <p>You have enabled 2fa</p>
                <button type="submit">Disable</button>
                <p>You have enabled two factor authentication, please scan the following QR code into your phones authenticator application.</p>
                {!! auth()->user()->twoFactorQrCodeSvg() !!}

                <h2>Recovery Codes</h2>
                @foreach(auth()->user()->recoveryCodes() as $code )
                <li>{{ $code }}</li>
                @endforeach
            </form>
    @endif
</div>