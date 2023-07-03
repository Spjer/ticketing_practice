<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="<?php echo asset('css/css1.css')?>" type="text/css"> 


    <title>@yield('title')</title>
</head>
<body>
@section('navbar')
    <div class='navbar1'>
        <ul class='navbar1'>
            <li class='navbar1'><a href="{{ route('opening') }}">Opening Page</a></li>
            <li class='navbar1'><a href="{{ route('user.home') }}">Home</a></li>
            @auth
                <li class='navbar1'><a href="{{ route('user.logout') }}">Logout</a></li>
                @else
                <li class='navbar1'><a href="{{ route('user.login') }}">Login</a></li>
                <li class='navbar1'><a href="{{ route('user.register') }}">Register</a></li>
            @endauth
        </ul>
    </div>
    
@show
@section('sidebar')
<div class='sidebar'>     
        @auth
        <a href="{{ route('tickets.index') }}">
            Ticketi
        </a>
        <br>
        <a href="{{ route('tickets.show', [Auth::user()->id]) }}">
            Peuzeti ticketi
        </a>
        <br>
        @if(auth()->user()->role == 'admin')
        <a href="{{ route('users.index') }}">
           Pregled agenata
        </a>
        <br>
        <a href="{{ route('clients.index') }}">
            Pregled klijenata
        </a>
        <br>
        @endif
        
        <a href="{{ route('tickets.create') }}">
            Otvori ticket
        </a>
        <br>
        
        
    
        <!--<br>
        <a href="{{ route('user.logout') }}">Logout</a>-->
        &nbsp<span style='color: gray'>{{ Auth::user()->name }}</span>
        @endauth
</div>
@show
    <div class='container'>
        @yield('content')
    </div>
</body>
</html>