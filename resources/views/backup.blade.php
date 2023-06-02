<!--all_tickets.blade.php -->
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
        <th scope="col">Završi</th>
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
            @if($ticket->status_id == '3') 
            <td>
              <a href="{{ route('delete_ticket', [$ticket->id]) }}">
                <button type="button">Potvrdite izvršenje</button>
              </a>
            </td>
            @endif
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
            <td>
              @if( Auth::user()->role != 'admin')
              <a href="{{ route('take_ticket', [$ticket->id]) }}">
                <button type="button">Preuzmi</button>
              </a>
              @endif
            </td>
          </tr>
        @endif
      @endforeach
    @endif
    </tbody>
  </table>


  
</main>
@stop

<!--my_tickets.blade.php -->

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

<script>
        if(document.getElementById('statusId') == 'Open'){
          document.getElementById('statusId').style.background-color = 'blue';
        }
      </script>












///////client ticket
<main>
<table class="table" border=1>
<thead>
                  <tr>
                    <th scope="col">Id ticketa</th>
                    <th scope="col">Moj id</th>
                    <th scope="col">Naziv</th>
                    <th scope="col">Detaljnije</th>
                    <th scope="col">Status</th>
                    <th scope="col">Datum</th>
                    <th scope="col">Potvrda</th>
                    
                    
                  </tr>
                </thead>
<tbody>
                  @foreach($client->tickets as $ticket) 
                    <tr align="right">
                      <td>{{$ticket->id}}</td>
                      <td>{{$ticket->client_id}}</td>
                      <td>{{$ticket->tic_name}}</td>
                      <td>{{$ticket->details}}</td>
                      <td>{{$ticket->status->status}}</td>
                      <td>{{$ticket->created_at}}</td>
                      <td>
                        @if($ticket->status_id == '3')
                          <a href="{{ route('delete_ticket', [$ticket->id]) }}">
                            <button type="button">Potvrdite izvršenje</button>
                          </a>
                        @endif
                      </td>
                      
                    </tr>
                  @endforeach
</tbody>
</table>
</main>



<main>
<div>
  @foreach($client->tickets as $ticket)
      <div>
        <div class='card1'>
          <div class='card1-text'>
            <p class='basic'>{{$ticket->tic_name}} <span style="color:grey">#{{$ticket->id}}</span></p>
          </div>
          <div class='card1-text'>
         
                  <p>{{$ticket->details}}</p>
            
          </div>
          <div class='card1-text' style="text-align:center">
            <p><span class='status-span' id=statusId  @if($ticket->status_id == '1') style="background-color: blue;" 
            @elseif($ticket->status_id == '2') style="background-color: green;" @else style="background-color: red;" @endif >{{$ticket->status->status}}</span></p>
          </div>
          <div class='card1-text'>
            

          </div>
          <div class='gumbi'>
             
           
              
          </div>
        </div>
      </div>
      @endforeach
</div>
</main>