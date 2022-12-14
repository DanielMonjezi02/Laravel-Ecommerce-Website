@extends('layouts.app')
@section('title', 'Change Password')

<div class="userForm">
    <form action="{{ route('password.update') }}" method="POST">
        @csrf
        <input type="hidden" name="token" value="{{ $request->route('token') }}">
        <label for="email">Email:</label>
        <input type="text" name="email" id="email" class="p-2 bg-gray-200 @error('email') is-invalid @enderror" value="{{ $request->email }}" />
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
        <button type="submit" class="btn btn-blue">Update</button>
    </form>
</div>