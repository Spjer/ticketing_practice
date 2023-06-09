@extends('layout.master')
 
@section('title', 'Home')
 
@yield('navbar')
    

 


@section('content')
<main>
    <h1>Hello User</h1>
    Name: {{ Auth::user()->name }} <br>
    Role:{{ Auth::user()->role }}
            
   
</main>




@stop