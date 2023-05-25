@extends('layout.master')
 
@section('title', 'Ticket list')
 
@yield('navbar')

@section('content')
<main>
  <table class="table" border=1>
    <thead>
      <tr>
        <th scope="col">Id ticketa</th>
        <th scope="col"> Id klijenta</th>
        <th scope="col"> Naziv</th>
        <th scope="col">Detaljnije</th>
        <th scope="col">Status</th>
        <th scope="col">Datum</th>                    
        <th scope="col">Klijent</th>
        @if(Auth::user()->role == 'admin')
          <th scope="col">Agent</th>
        @endif
      </tr>
    </thead>
    <tbody>
    @if(Auth::user()->role == 'admin')
      @foreach($ticket as $ticket) 
        
          <tr align="right">
            <td>{{$ticket->id}}</td>
            <td>{{$ticket->client_id}}</td>
            <td>{{$ticket->tic_name}}</td>
            <td>{{$ticket->details}}</td>
            <td>{{$ticket->status->status}}</td>
            <td>{{$ticket->created_at}}</td>
            <td>
              <div>
                @if(isset($ticket->client))
                  {{$ticket->client->name}}
                @else
                  Nema
                @endif
              </div>
            </td>
            <td>
              <div>
                @if(isset($ticket->user))
                  {{$ticket->user->name}}
                @else
                  Nema
                @endif
              </div>
            </td>
            <td>
              @if($ticket->status_id == '3')
                <a href="{{ route('delete_ticket', [$ticket->id]) }}">
                  <button type="button">Potvrdite izvršenje</button>
                </a>
              @endif
            </td>
          </tr>
        
      @endforeach
    @else
      @foreach($ticket as $ticket) 
        @if($ticket->user_id == 1)
          <tr align="right">
            <td>{{$ticket->id}}</td>
            <td>{{$ticket->client_id}}</td>
            <td>{{$ticket->tic_name}}</td>
            <td>{{$ticket->details}}</td>
            <td>{{$ticket->status->status}}</td>
            <td>{{$ticket->created_at}}</td>
            <td>
              <div>
                @if(isset($ticket->client))
                  {{$ticket->client->name}}
                @else
                  Nema
                @endif
              </div>
            </td>
            @if( Auth::user()->role != 'admin')
            <td>
              <a href="{{ route('take_ticket', [$ticket->id]) }}">
                <button type="button">Preuzmi</button>
              </a>
            </td>
            @endif
          </tr>
        @endif
      @endforeach
    @endif
    </tbody>
  </table>
</main>
@stop