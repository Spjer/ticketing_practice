
@extends('layout.master')
 
@section('title', 'Ticket list')
 
@yield('navbar')

@section('content')
<main>
 

@if(Auth::user()->role == 'admin')
  @foreach($ticket as $ticket)
  
    <div class='card1'>
      
      <div class='card1-text'>
        <p>{{$ticket->tic_name}} <span style="color:grey">#{{$ticket->id}}</span></p>
      </div>
      <div class='card1-text'>
        <p>{{$ticket->client->name}} <span style="color:grey">#{{$ticket->client_id}}</span></p>
      </div>
      <div class='card1-text' style="text-align:center">
        <p><span class='status-span' id=statusId  @if($ticket->status_id == '1') style="background-color: blue;" 
          @elseif($ticket->status_id == '2') style="background-color: green;" @else style="background-color: red;" @endif >{{$ticket->status->status}}</span></p>
      </div>
      <div class='card1-text'>
        <p>{{$ticket->created_at}}</p>
      </div>
      <div class='gumbi'>
        <p><button type="button" class="btn btn-primary" onclick="show('{{$ticket->id}}')">Više</button></p>

      </div>
      <!--SIDE PANNEL-->
      <div class='side-pnl' id='{{$ticket->id}}'>
        <div class ='sp1'> Klijent:
          @if(isset($ticket->client))
            @if($ticket->client_id != '1')
              <p>IME: {{$ticket->client->name}}<span style="color:grey">#{{$ticket->client_id}}</span><br>
                EMAIL: {{$ticket->client->email}}<br>
                BROJ TELEFONA: {{$ticket->client->phone_number}}</p>
              @else
                <a href="{{ route('pick_client', [$ticket->id]) }}">
                  <button type="button">Odaberi korisnika</button>
                </a>
            @endif
          @endif
          <br>
          Agent:
          <p>{{$ticket->user->name}}</p>
          
        </div>
        <div class ='sp1'> Opis:
          <p>{{$ticket->details}}</p>
        </div>
        <div class ='sp1'> Komentari:
          @foreach($ticket->comments as $comment)
          <div class='sp2'>
          <span style="color:grey">#{{$comment->id}}</span> {{$comment->created_at}}
          <p>{{$comment->comm}}</p>

          </div>
          @endforeach
        </div>


        


        <div class ='sp1'> 
          <a href="{{ route('pick_client', [$ticket->id]) }}">
            <button type="button">Promijeni korisnika</button>
          </a>
          <a href="{{ route('pick_user', [$ticket->id]) }}">
            <button type="button">Promijeni agenta</button>
          </a>

          
        </div>
        <div class='sp1'>
           <!-- Napravit da se moze promijenit status i otpustit ticket -->
            <!-- drop ticket = otpusti ticket -->
            @if($ticket->status_id == '3' && Auth::user()->role == 'admin') 
            <p><a href="{{ route('delete_ticket', [$ticket->id]) }}">
              <button type="button" class="take-btn">Završi</button>
            </a></p>
            
        @endif
            
        </div>


      </div>
      <script>
        function show(id) {
          //var y = document.getElementByClassName('side-pnl');
          var x = document.getElementById(id);
          //if(x.id != y.id){
            //y.style.display = 'none';
          //}
          if (x.style.display === "none") {
            x.style.display = "block";
          } else {
            x.style.display = "none";
          }
          }
      </script>
      
      </div>
    @endforeach








@else










  @foreach($ticket as $ticket)
  @if($ticket->user_id == 1)
  <div> 
    <div class='card1'>
      <div class='card1-text'>
        <p>{{$ticket->tic_name}} <span style="color:grey">#{{$ticket->id}}</span></p>
      </div>
      <div class='card1-text'>
        <p>{{$ticket->client->name}} <span style="color:grey">#{{$ticket->client_id}}</span></p>
      </div>
      <div class='card1-text' style="text-align:center">
        <p><span class='status-span' @if($ticket->status_id == '1') style="background-color: blue;" 
          @elseif($ticket->status_id == '2') style="background-color: green;" @else style="background-color: red;" @endif >{{$ticket->status->status}}</span></p>
      </div>
      <div class='card1-text'>
        <p>{{$ticket->created_at}}</p>
      </div>
      <div class='gumbi'>
        
        <p><button type="button" class="btn btn-primary" onclick="show('{{$ticket->id}}')">Više</button></p>
       
        
        
      </div>

    </div>
    <!--SIDE PANNEL-->
    <div class='side-pnl' id='{{$ticket->id}}'>
        <div class ='sp1'> Klijent:
          @if(isset($ticket->client))
            @if($ticket->client_id != '1')
              <p>IME: {{$ticket->client->name}}<span style="color:grey">#{{$ticket->client_id}}</span><br>
                EMAIL: {{$ticket->client->email}}<br>
                BROJ TELEFONA: {{$ticket->client->phone_number}}</p>
              @else
                <a href="{{ route('pick_client', [$ticket->id]) }}">
                  <button type="button">Odaberi korisnika</button>
                </a>
            @endif
          @endif
        </div>
        <div class ='sp1'> Opis:
          <p>{{$ticket->details}}</p>
        </div>
        <div class ='sp1'> Komentari:
          @foreach($ticket->comments as $comment)
          <div class='sp2'>
          <span style="color:grey">#{{$comment->id}}</span> {{$comment->created_at}}
          <p>{{$comment->comm}}</p>

          </div>
          @endforeach
        </div>
        <div class='sp1'>
           <!-- Napravit da se moze promijenit status i otpustit ticket -->
            <!-- drop ticket = otpusti ticket -->
            @if($ticket->user_id == 1 && Auth::user()->role != 'admin')
              <p><a href="{{ route('take_ticket', [$ticket->id]) }}">
                <button type="button" class="take-btn">Preuzmi</button>
              </a></p>
            @endif
            
        </div>


      </div>
      <script>
        function show(id) {
          //var y = document.getElementByClassName('side-pnl');
          var x = document.getElementById(id);
          //if(x.id != y.id){
            //y.style.display = 'none';
          //}
          if (x.style.display === "none") {
            x.style.display = "block";
          } else {
            x.style.display = "none";
          }
          }
      </script>
  </div>
  @endif
  @endforeach
@endif
</main>
@stop



