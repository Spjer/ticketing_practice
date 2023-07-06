@extends('layout.master')
 
@section('title', Notifications')
 
@yield('navbar')
    

 


@section('content')
<main>
    <table class="table" border=1>
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Ime</th>
                <th scope="col">Role</th>
                <th scope="col">Tickets</th>

             
               
            </tr>
        </thead>
            <tbody>
                
            </tbody>
        </table>
    <div>
    

        @foreach($notifications as $notification)
        @if(isset($notification))
        {{$notification  ->data['title']}}
        @endif
    
    </div>

</main>




@stop