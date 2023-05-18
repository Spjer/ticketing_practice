<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?php echo asset('css/css1.css')?>" type="text/css"> 

    <title>@yield('title')</title>
</head>
<body>
@section('navbar')
    <div class='navbar'>
        <ul class='navbar'>
            <li class='navbar'><a href="{{ route('opening') }}">Opening Page</a></li>
            <li class='navbar'><a href="{{ route('client.home') }}">Home</a></li>
            @auth
                <li class='navbar'><a href="{{ route('client.logout') }}">Logout</a></li>
                @else
                <li class='navbar'><a href="{{ route('client.login') }}">Login</a></li>
                <li class='navbar'><a href="{{ route('client.register') }}">Register</a></li>
            @endauth
        </ul>
    </div>
    
@show
    <div class='container'>
        @yield('content')
    </div>
</body>
</html>