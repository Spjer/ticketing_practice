@extends('layout.masterClient')
 
@section('title', 'LogIn')
 
@yield('navbar')

@section('content')

@if(session('error'))
    <p>{{ session('error') }}</p>
@endif

<form action="{{ route('client.customLogin') }}" method="POST">
    @csrf
    <input type="text" name="email" />
    <input type="password" name="password" />
    <button type="submit">Log in</button>
</form>





@stop