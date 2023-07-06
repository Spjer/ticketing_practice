@extends('layout.master')
 
@section('title', 'Home')
 
@yield('navbar')
    

 


@section('content')
<main>
    <h1>Hello User</h1>
    Name: {{ Auth::user()->name }} <br>
    Role:{{ Auth::user()->role }} <br>
    <li class="nav-item dropdown" style="align-text:left">
            <a id="navbarDropdown" class="nav-link " href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                <i class="fa fa-bell"></i>
                <span class="badge badge-light bg-success badge-xs">{{auth()->user()->unreadNotifications->count()}}</span>
            </a>
            <ul class="dropdown-menu">
                @if (auth()->user()->unreadNotifications)
                <li class="d-flex justify-content-end mx-1 my-2">
                    <a href="#" class="btn btn-success btn-sm">Mark All as Read</a>
                </li>
                @endif
               
            </ul>
        </li>
            
   
</main>




@stop