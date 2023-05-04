@extends('layout.base') 


@section('content')
<h1>Hello </h1>
@auth
@if (auth()->guard('webclient'))
<a href="{{ route('client_ticket', [Auth::user()->id]) }}">
    <button type="button"> Moji ticketi</button>
</a>
<br>
<a href="{{ route('create_ticket', [Auth::user()->id]) }}">
    <button type="button"> Napravi ticket</button>
</a>
<br>

<a href="{{ route('client.logout') }}">Logout</a>
@endif
@endauth






@endsection