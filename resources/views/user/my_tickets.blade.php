@extends('layout.master')
 
@section('title', 'My tickets')
 
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
        <th scope="col">Komentari</th>
        <th scope="col">Datum</th>
        <th scope="col">Klijent</th>
      </tr>
    </thead>
    <tbody>
    @if(count($user->tickets))
      @foreach($user->tickets as $ticket) 
        <tr align="right">
          <td>{{$ticket->id}}</td>
          <td>{{$ticket->client_id}}</td>
          <td>{{$ticket->tic_name}}</td>
          <td>{{$ticket->details}}</td>
          <td>{{$ticket->status->status}}<br>
              <a href="{{ route('edit_status', [$ticket->id]) }}">
                <button type="button">Promijeni status</button>
              </a>
          </td>
          <td>
            <!-- Napravit da se moze promijenit status i otpustit ticket -->
            <!-- drop ticket = otpusti ticket -->
            <a href="{{ route('drop_ticket', [$ticket->id]) }}">
              <button type="button">Odbaci</button>
            </a>
                     
              <!-- view comments, add comments-->
            <a href="{{ route('view_comments', [$ticket->id]) }}">
              <button type="button">Komentari</button>
            </a>
            <a href="{{ route('create_comment', [$ticket->id]) }}">
              <button type="button">Dodaj komentar</button>
            </a>
          </td>
          <td>{{$ticket->created_at}}</td>
          <td>
            <div>
              @if(isset($ticket->client))
                @if($ticket->client_id != '1')
                  {{$ticket->client->id}}-{{$ticket->client->name}}<br>
                  {{$ticket->client->email}}<br>
                  {{$ticket->client->phone_number}}<br>
                @else
                  <a href="{{ route('pick_client', [$ticket->id]) }}">
                    <button type="button">Odaberi korisnika</button>
                  </a>
                @endif
              @endif
            </div>
                  
          </tr>
      @endforeach
    @endif
    </tbody>
  </table>
</main>
@stop