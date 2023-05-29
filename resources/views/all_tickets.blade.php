
@extends('layout.master')
 
@section('title', 'Ticket list')
 
@yield('navbar')

@section('content')
<main>
 

@if(Auth::user()->role == 'admin')
  @foreach($ticket as $ticket)
  
    <div class='card'>
      
      <div class='card-text'>
        <p>{{$ticket->tic_name}} <span style="color:grey">#{{$ticket->id}}</span></p>
      </div>
      <div class='card-text'>
        <p>{{$ticket->client->name}} <span style="color:grey">#{{$ticket->client_id}}</span></p>
      </div>
      <div class='card-text' style="text-align:center">
        <p><span class='status-span' id=statusId>{{$ticket->status->status}}</span></p>
      </div>
      <div class='card-text'>
        <p>{{$ticket->created_at}}</p>
      </div>
      <div class='gumbi'>
       
        @if($ticket->status_id == '3' && Auth::user()->role == 'admin') 
          <p><a href="{{ route('delete_ticket', [$ticket->id]) }}">
            <button type="button" class="take-btn">Završi</button>
          </a></p>
            
        @endif
      </div>
      
    </div>
    @endforeach

@else
  @foreach($ticket as $ticket)
  @if($ticket->user_id == 1) 
    <div class='card'>
      <div class='card-text'>
        <p>{{$ticket->tic_name}} <span style="color:grey">#{{$ticket->id}}</span></p>
      </div>
      <div class='card-text'>
        <p>{{$ticket->client->name}} <span style="color:grey">#{{$ticket->client_id}}</span></p>
      </div>
      <div class='card-text' style="text-align:center">
        <p><span class='status-span'>{{$ticket->status->status}}</span></p>
      </div>
      <div class='card-text'>
        <p>{{$ticket->created_at}}</p>
      </div>
      <div class='gumbi'>
        @if($ticket->user_id == 1 && Auth::user()->role != 'admin')
          <p><a href="{{ route('take_ticket', [$ticket->id]) }}">
            <button type="button" class="take-btn">Preuzmi</button>
          </a></p>
        @endif
       
        
        
      </div>

    </div>
  @endif
  @endforeach
@endif
</main>
@stop



