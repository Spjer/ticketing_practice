@extends('layout.masterClient')
 
@section('title', 'Home')
 
@yield('navbar')

@section('content')

@if ( Session::has('flash_message') )

        <span class="alert alert-success alert-block" style="left: 50%">
            {{ Session::get('flash_message') }}
        </span>

@endif

<h1>Hello Client</h1>
@auth
@if (auth()->guard('webclient'))
<a href="{{ route('ticket-clients.show', [Auth::user()->id]) }}">
    <button type="button"> Moji ticketi</button>
</a>
<br>
<a href="{{ route('ticket-clients.create', [Auth::user()->id]) }}">
    <button type="button"> Prijavi problem</button>
</a>
<br>

<a href="{{ route('client.logout') }}">Logout</a>
{{auth()->guard('webclient')->user()->name}}
@endif
@endauth





@stop