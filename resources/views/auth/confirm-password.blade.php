@extends('layouts.app')
@section('title', 'Login')

<div class="userForm">
    <form action="{{ url('/user/confirm-password') }}" method="POST">
        @csrf
        <label for ="password">Enter your password:</label>
        <input type="text" name="password" id="password"/>
        <button type="submit" class="btn btn-blue">Submit</button>
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        @endif
    </form>
</div>