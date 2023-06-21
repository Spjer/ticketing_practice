@extends('layout.master')
 
@section('title', 'Client list')
 
@yield('navbar')
    

 


@section('content')
<main>
    <table class="table" border=1>
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Ime</th>
                <th scope="col">Email</th>
                <th scope="col">Broj telefona</th>
               
            </tr>
        </thead>
            <tbody>
                @foreach($clients as $client) 
                
                <tr align="right">
                    <td>{{$client->id}}</td>
                    <td>{{$client->name}}</td>
                    <td>{{$client->email}}</td>
                    <td>{{$client->phone_number}}</td>
                    
                  @endforeach
            </tbody>
        </table>
</main>




@stop