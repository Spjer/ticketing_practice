@extends('layout.masterClient')
 
@section('title', 'Home')
 
@yield('navbar')

@section('content')
<h1>Hello Client</h1>
@auth
@if (auth()->guard('webclient'))
<a href="{{ route('client_ticket', [Auth::user()->id]) }}">
    <button type="button"> Moji ticketi</button>
</a>
<br>
<a href="{{ route('create_ticket', [Auth::user()->id]) }}">
    <button type="button"> Prijavi problem</button>
</a>
<br>

<a href="{{ route('client.logout') }}">Logout</a>
@endif
@endauth





@stop