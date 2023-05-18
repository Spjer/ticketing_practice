@extends('layout.master')
 
@section('title', 'Home')
 
@yield('navbar')
    

 


@section('content')
<main>
    <h1>Hello User</h1>


            
    @auth
    <a href="{{ route('all_tickets') }}">
        <button type="submit">Svi ticketi</button>
    </a>
    <br>
    <a href="{{ route('user.my_tickets', [Auth::user()->id]) }}">
        <button type="submit">Peuzeti ticketi</button>
    </a>
    <br>
    @if(auth()->user()->id == '1')
    <a href="{{ route('user.view_users') }}">
        <button type="submit">Pregled agenata</button>
    </a>
    <a href="{{ route('user.view_clients') }}">
        <button type="submit">Pregled klijenata</button>
    </a>
    @endif
    <br>
    <a href="{{ route('user.logout') }}">Logout</a>
    <div>{{ Auth::user()->name }}</div>

    @endauth
</main>




@stop