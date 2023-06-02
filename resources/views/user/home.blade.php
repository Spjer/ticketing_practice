@extends('layout.master')
 
@section('title', 'Home')
 
@yield('navbar')
    

 


@section('content')
<main>
    <h1>Hello User</h1>


            
    @auth
    <a href="{{ route('tickets.index') }}">
        <button type="submit">Svi ticketi</button>
    </a>
    <br>
    <a href="{{ route('tickets.show', [Auth::user()->id]) }}">
        <button type="submit">Peuzeti ticketi</button>
    </a>
    <br>
    @if(auth()->user()->role == 'admin')
    <a href="{{ route('user.view_users') }}">
        <button type="submit">Pregled agenata</button>
    </a>
    <a href="{{ route('clients.index') }}">
        <button type="submit">Pregled klijenata</button>
    </a>
    @endif
    <br>
    <!--WIP -->
    <a href="{{ route('create_ticket_user', [Auth::user()->id]) }}">
        <button type="button">Otvori ticket</button>
    </a>
    <!--------------------------------------------------------->
    <br>
    <a href="{{ route('user.logout') }}">Logout</a>
    <div>{{ Auth::user()->name }}</div>

    @endauth
</main>




@stop