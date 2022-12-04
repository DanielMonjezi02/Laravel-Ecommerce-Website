@extends('layouts.app')
@section('title', 'Login')

<div class="userForm">
    <form action="{{ url('/login') }}" method="POST">
        @csrf
        <label for ="email">Email:</label>
        <input type="text" name="email" id="email" />
        <label for="password">Password:</label>
        <input name="password" id="password" />
        <button type="submit" class="btn btn-blue">Login</button>

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        @endif
    </form>
</div>
