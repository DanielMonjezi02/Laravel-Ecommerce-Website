@extends('layouts.app')
@section('title', 'Login')

<div class="userForm">
    <form action="{{ url('/two-factor-challenge') }}" method="POST">
        @csrf
        <label for ="code">Two Factor Code:</label>
        <input type="text" name="code" id="code"/>
        <p style="font-size: 14px;"><a href="{{ route('recoveryLogin') }}">Don't have access to authenticator?</a></p>
        <button type="submit" class="btn btn-blue">Submit</button>

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        @endif
    </form>
</div>