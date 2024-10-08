@extends('layouts.app')
@section('title', 'Signup')

@if (Auth::guest())
    <div class="userForm">
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" class="p-2 bg-gray-200 @error('username') is-invalid @enderror" />
            @error('username')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <label for="email">Email:</label>
            <input type="text" name="email" id="email" class="p-2 bg-gray-200 @error('email') is-invalid @enderror" />
            @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <label for="password">Password:</label>
            <input name="password" id="password" class="p-2 bg-gray-200 @error('password') is-invalid @enderror" />
            @error('password')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <label for="password_confirmation">Password Confirm:</label>
            <input name="password_confirmation" id="password_confirmation" class="p-2 bg-gray-200 @error('password_confirmation') is-invalid @enderror" />
            @error('password_confirmation')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <label for="dob">Date of Birth: </label>
            <input name="dob" id="dob" class="p-2 bg-gray-200 @error('dob') is-invalid @enderror" />
            @error('dob')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <button type="submit" class="btn btn-blue">Sign Up</button>
            @if ($message = Session::get('success'))
                <div class="alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif
        </form>
    </div>
@else
    <p>You are already logged in!</p>
@endif
