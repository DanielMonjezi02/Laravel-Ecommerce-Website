@extends('layouts.app')
@section('title', 'Login')


<div class="userForm">
    <form action="{{ url('/two-factor-challenge') }}" method="POST">
        @csrf
        <label for ="code">Two Recovery Factor Code:</label>
        <input type="text" name="recovery_code" id="code"/>
        <button type="submit" class="btn btn-blue">Submit</button>

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        @endif
    </form>
</div>
