@extends('layouts.app')

@section('title', 'Shopping Homepage')

@if ($message = Session::get('success'))

<div class="alert-success">
    <p><u>{{ $message }}</u></p>
</div>
@endif
