@extends('layouts.app')
@section('title', 'Login')

@if (Auth::guest()) 
    <div class="userForm">
        <form action="{{ url('/two-factor-challenge') }}" method="POST">
            @csrf
            <label for ="code">Two Recovery Factor Code:</label>
            <input type="text" name="recovery_code" id="code"/>
            <button type="submit" class="btn btn-blue">Submit</button>
        </form>
    </div>
@else
    <p>You are already logged in!</p>
@endif
