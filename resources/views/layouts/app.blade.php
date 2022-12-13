<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title')</title>
        @vite('resources/css/app.css')
    </head>
    <body>
        <div class="container mx-auto">
            <h1 class="header">@yield('title')</h1>
        </div>
        <div class="navbar">
            <ul>
                @if (Auth::guest())
                    <li><a href="/login">Login</a></li>
                    <li><a href="/register">Sign Up</a></li>
                    <li><a href="/products">Products</a></li>
                    <li><a href="/home">Homepage</a></li>
                @else
                    <li><a href="/logout">Logout</a></li>
                    <li><a href="/account">Account</a></li>
                    <li><a href="/cart">Cart</a></li>
                    <li><a href="/products">Products</a></li>
                    <li><a href="/home">Homepage</a></li>
                @endif
            </ul>
        </div>
    </body>
</html>
