<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="<?php echo asset('css/css1.css')?>" type="text/css"> 

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>@yield('title')</title>
</head>
<body>
@section('navbar')
    <div class='navbar1'>
        <ul class='navbar1'>
            <li class='navbar1'><a href="{{ route('opening') }}">Opening Page</a></li>
            <li class='navbar1'><a href="{{ route('client.home') }}"><i class="fa-solid fa-house-user"></i> <i>Home</i></a></li>
            @if(Auth::guard('webclient')->check())
                <li class='navbar1'><a href="{{ route('client.logout') }}"><i class="fa-solid fa-power-off"></i> <i>Logout</i></a></li>
                @else
                <li class='navbar1'><a href="{{ route('client.login') }}">Login</a></li>
                <li class='navbar1'><a href="{{ route('client.register') }}">Register</a></li>
            @endauth
        </ul>
    </div>
    
@show
    <div class='container'>
        @yield('content')
    </div>
</body>
</html>