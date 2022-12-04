@extends('layouts.app')
@section('title', 'Login')

@if (Auth::guest()) 
    <div class="userForm">
        <form action="{{ url('/login') }}" method="POST">
            @csrf
            <label for ="email">Email:</label>
            <input type="text" name="email" id="email" class="p-2 bg-gray-200 @error('email') is-invalid @enderror" />
            @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <label for="password">Password:</label>
            <input name="password" id="password" class="p-2 bg-gray-200 @error('password') is-invalid @enderror" />
            @error('password')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <button type="submit" class="btn btn-blue">Login</button>
        </form>
    </div>
@else
    <p>You are already logged in!</p>
@endif
