@extends('layouts.app')
@section('title', 'Reset Password')

<div class="userForm">
    @if(session('status'))
        <div class="alert alert-danger">{{ session('status') }}</div>
    @endif
    <form action="{{ route('password.request') }}" method="POST">
        @csrf
        <label for="email">Email:</label>
        <input type="text" name="email" id="email" class="p-2 bg-gray-200 @error('email') is-invalid @enderror" />
        @error('email')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <button type="submit" class="btn btn-blue">Submit</button>
    </form>
</div>