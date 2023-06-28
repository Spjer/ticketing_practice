@extends('layout.master')
 
@section('title', 'My tickets')
 
@yield('navbar')

@section('content')
<main>

  <div>
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
        <div class='card1-text'>
          Više
        </div>
      </div>
    </div>
    @if(count($user->tickets))
      @foreach($user->tickets as $ticket)
      <div>
        <div class='card1'>
          <div class='card1-text'>
            <p class='basic' style="white-space: nowrap; text-overflow: ellipsis">{{$ticket->name}} <span style="color:grey">#{{$ticket->id}}</span></p>
          </div>
          <div class='card1-text'>
          @if(isset($ticket->client))
                @if($ticket->client_id != '1')
                  <p class='basic'>{{$ticket->client->name}}<span style="color:grey">#{{$ticket->client_id}}</span></p>
                @else
                  <p class='basic'><a href="{{ route('clients.edit', [$ticket->id]) }}">
                    <button type="button">Odaberi korisnika</button>
                  </a></p>
                @endif
              @endif
            
          </div>
          <div class='card1-text' style="text-align:center">
            <p class='basic'><span class='status-span' @if($ticket->status_id == '1') style="background-color: blue;" 
              @elseif($ticket->status_id == '2') style="background-color: green;" 
              @else style="background-color: red;" @endif 
              ><a href="{{ route('statuses.edit', [$ticket->id]) }}" class='status-a'>
                {{$ticket->status->name}}
              </a></span>
            </p>
          </div>
          <div class='card1-text'>
            <p class='basic'>{{$ticket->created_at}}</p>
          </div>
          <div class='gumbi'>
             <!-- Napravit da se moze promijenit status i otpustit ticket -->
            <!-- release ticket = otpusti ticket -->
            <p >
            @if(Auth::user()->role != 'admin')
            <a href="{{ route('release_ticket', [$ticket->id]) }}">
              <button type="button" class="btn btn-danger">Odbaci</button>
            </a>
            @endif
                     
              
            <button type="button" class="btn btn-primary"  onclick="show('{{$ticket->id}}')">Više</button></p>
          </div>
        </div>
      </div>

      <!--SIDE PANNEL-->
      <div class='side-pnl' id='{{$ticket->id}}'>
        <div class ='sp1'> Klijent:
          @if(isset($ticket->client))
            @if($ticket->client_id != '1')
              <p class='basic'>IME: {{$ticket->client->name}}<span style="color:grey">#{{$ticket->client_id}}</span><br>
                EMAIL: {{$ticket->client->email}}<br>
                BROJ TELEFONA: {{$ticket->client->phone_number}}</p>
              @else
                <a href="{{ route('clients.edit', [$ticket->id]) }}">
                  <button type="button">Odaberi korisnika</button>
                </a>
            @endif
          @endif
        </div>
        <div class ='sp1'> Opis:
          <p class='basic'>{{$ticket->details}}</p>
        </div>
        <div class='sp1'>
          <p><form action="{{ route('statuses.store') }}" method="POST" >
          @csrf
            <input type="hidden" id="ticket_id" name="ticket_id" value="{{$ticket->id}}">
            <select name="new_status_id" id="new_status_id">
              <option value="1" @if($ticket->status_id == '1') {{'selected'}} @endif >Open</option>
              <option value="2" @if($ticket->status_id == '2') {{'selected'}} @endif >In progress</option>
              <option value="3" @if($ticket->status_id == '3') {{'selected'}} @endif >Closed</option>
            </select>
            <button type="submit" class="btn btn-primary mt-3">Promijeni status</button>
          </form></p>

        </div>
        <div class ='sp1'> Komentari:
          @foreach($ticket->comments as $comment)
          <div class='sp2'>
          <span style="color:grey">#{{$comment->id}}</span> {{$comment->created_at}}
          <p class='basic'>{{$comment->comm}}</p>

          </div>
          @endforeach
        </div>
        
        <div class='sp1'>
          <form action="{{route('comments.store')}}" method="POST" >
            @if ($errors->any())
              <div>
                  <ul>
                    @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                  </ul>
              </div>
            @endif


            @csrf
            <input type="hidden" id="ticket_id" name="ticket_id" value="{{$ticket->id}}">
            
            <div>
                <label for="comm">Komentar:</label><br>
                <textarea rows="4" cols="40"  id="comm" name="comm"  placeholder="Upišite komentar"></textarea>
            </div>
            <br>
            


            <button type="submit">Dodaj komentar</button>
          </form>
        </div>
        <div class='sp1'>
           <!-- Napravit da se moze promijenit status i otpustit ticket -->
            <!-- release ticket = otpusti ticket -->
             <!-- view comments, add comments-->
             <a href="{{ route('comments.show', [$ticket->id]) }}">
              <button type="button">Komentari</button>
            </a>
            @if(Auth::user()->role != 'admin')
            <a href="{{ route('release_ticket', [$ticket->id]) }}">
              <button type="button">Otpusti</button>
            </a>
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
      @endforeach
      @endif
  </div>
</main>
@stop