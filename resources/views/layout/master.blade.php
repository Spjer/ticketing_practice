<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">

 
    @vite(['resources/css/app.css', 'resources/js/app.js']) 
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="<?php echo asset('css/css1.css')?>" type="text/css"> 

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>


    <!--<link href="toastr.css" rel="stylesheet"/>
    <script src="toastr.js"></script>-->

    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    @auth()
    <script>
     
        var userId = {{ auth()->user()->id }} ?? 0;
        var clientId = 0;


        
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('e9e597dc697d1a7af7b2', {
            cluster: 'eu',
            authEndpoint: '/broadcast/auth',
        });

    // var channelName = 'private-assigned.2';
    // var privateChannel = pusher.subscribe('assignement.1');
    // privateChannel.bind('TicketAssigned', function(data) {
    // alert(JSON.stringify(data));
    // });

  </script>
  @endauth


    <title>@yield('title')</title>
</head>
<body>
@section('navbar')
    <div class='navbar1'>
        <ul class='navbar1'>
            <li class='navbar1'><a href="{{ route('opening') }}">Opening Page</a></li>
            <li class='navbar1'><a href="{{ route('user.home') }}"><i class="fa-solid fa-house-user"></i> Home</a></li>
            @auth
                <li class='navbar1'><a href="{{ route('user.logout') }}"><i class="fa-solid fa-power-off"></i> Logout</a></li>
                @else
                <li class='navbar1'><a href="{{ route('user.login') }}">Login</a></li>
                <li class='navbar1'><a href="{{ route('user.register') }}">Register</a></li>
            @endauth
        </ul>
        
        @auth
       
            <div class="dropdown-left" style="display: inline-block; z-index: 999;" id="notif-dropdown">
                <a href="#"onclick="myFunction()" class="dropbtn">
                    <i class="fa fa-bell" onclick="myFunction()" style="z-index: 999"></i>

                    @if(auth()->user()->unreadNotifications->count() != '0')
                    <span class="badge badge-light bg-success badge-xs" id="js-count" onclick="myFunction()">{{auth()->user()->unreadNotifications->count()}}</span>
                    @endif
                </a>
                
                <!--<div id="myDropdown" class="dropdown-menu dropdown-menu-dark" style="font-size:12px">-->
                <ul id="myDropdown" class="dropdown-menu dropdown-menu-dark" style="font-size:12px; max-height: 550px; overflow: auto;">
                    @foreach (auth()->user()->unreadNotifications as $notification)
                    <li><a href="{{ route('notifications.show', [$notification->id]) }}" class="dropdown-item"> {{$notification->data['title']}} - {{  $notification->created_at->diffForHumans()}}</li></a>
                    @endforeach

                    
                    <li class="d-flex justify-content-end mx-1 my-2">
                        <a href="{{route('notifications.index')}}" class="btn btn-success btn-sm" style="font-size: 12px; padding:3px;">All notifications</a> &nbsp
                        @if (auth()->user()->unreadNotifications)
                        <a href="{{route('notifications.update')}}" class="btn btn-success btn-sm" style="font-size: 12px; padding:3px;">Mark All as Read</a>
                        @endif
                    </li>
                </ul>
                    
                    
                </div>
            </div>
      
        @endauth
    </div>
    
@show
@section('sidebar')
<div class='sidebar'>     
        @auth
        <a href="{{ route('tickets.index') }}">
        <i class="fa-solid fa-ticket"></i> Tickets
        </a>
        <br>
        <a href="{{ route('tickets.show', [Auth::user()->id]) }}">
            <i class="fa fa-clipboard-list"></i> Working On
        </a>
        <br>
        @if(auth()->user()->role == 'admin')
        <a href="{{ route('users.index') }}">
            <i class="fa-solid fa-helmet-safety"></i> Agents
        </a>
        <br>
        <a href="{{ route('clients.index') }}">
            <i class="fa-solid fa-user"></i> Clients
        </a>
        <br>
        @endif
        
        <a href="{{ route('tickets.create') }}">
            <i class="fa fa-circle-plus"></i> New Ticket
        </a>
        <br>

        <a href="{{ route('chats.index') }}">
            <i class="fa-solid fa-comments"></i> Chats
        </a>
        <br>
        
        
    
        <!--<br>
        <a href="{{ route('user.logout') }}">Logout</a>-->
        &nbsp<span style='color: gray; margin-left: 5px;'> {{ Auth::user()->name }}</span><br>
        &nbsp<span style='color: gray; margin-left: 5px;'> {{ Auth::user()->role }}</span>

        @endauth
</div>
@show
    <div class='container'>
        @yield('content')
    </div>

<script>

    function myFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
    }

    // Close the dropdown if the user clicks outside of it
    window.onclick = function(event) {
        if (!event.target.matches('.dropbtn')) {
            var dropdowns = document.getElementsByClassName("dropdown-menu");
            var i;
            for (i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (openDropdown.classList.contains('show')) {
                    openDropdown.classList.remove('show');
                }
            }
        }
    }
</script>
</body>
</html>