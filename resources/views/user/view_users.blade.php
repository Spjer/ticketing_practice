@extends('layout.master')
 
@section('title', 'User list')
 
@yield('navbar')
    

 


@section('content')
<main>
    <table class="table" border=1>
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Ime</th>
                <th scope="col">Tickets</th>

             
               
            </tr>
        </thead>
            <tbody>
                @foreach($user as $user) 
                
                <tr align="right">
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->tickets->count()}}</td>
                </tr>
                   
                    
                  @endforeach
            </tbody>
        </table>
</main>




@stop