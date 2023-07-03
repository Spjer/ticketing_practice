@extends('layout.masterClient')
 
@section('title', 'My tickets')
 
@yield('navbar')

@section('content')
<main>
  <div>
    <div class='card0'>
      <div class='card1-text'>
        Ticket 
      </div>
      <div class='card1-text' >
        Klijent
      </div>
      <div class='card1-text'>
        Status
      </div>
      <div class='card1-text'>
        Datum
      </div>
    </div>

    @foreach($tickets as $ticket)
    <div>
      <div class='card1'>
        <div class='card1-text'>
          <p class='basic' style="white-space: nowrap; text-overflow: ellipsis">{{$ticket->name}} <span style="color:grey">#{{$ticket->id}}</span></p>
        </div>
        <div class='card1-text'>
          <p class='basic'>{{$ticket->client->name}}<span style="color:grey">#{{$ticket->client_id}}</span></p>
        </div>
        <div class='card1-text' style="text-align:center">
        <p class='basic'><span class='status-span' @if($ticket->status_id == '1') style="background-color: blue;" 
          @elseif($ticket->status_id == '2') style="background-color: green;" 
          @else style="background-color: red;" @endif >
          {{$ticket->status->name}}</span></p>
        </div>
        <div class='card1-text'>
          <p class='basic'>{{$ticket->created_at}}</p>
        </div>
      </div>
    </div>
    @endforeach
  </div>
</main>
@stop




  