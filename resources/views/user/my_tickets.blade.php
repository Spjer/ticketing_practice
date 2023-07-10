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
    @if(count($tickets))
      @foreach($tickets as $ticket)
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
                  <p class='basic'><a href="{{ route('ticket-clients.edit', [$ticket->id]) }}">
                    <button type="button">Odaberi korisnika</button>
                  </a></p>
                @endif
              @endif
            
          </div>
          <div class='card1-text' style="text-align:center">
            <!--<p class='basic'><span class='status-span' @if($ticket->status_id == '1') style="background-color: blue;" 
              @elseif($ticket->status_id == '2') style="background-color: green;" 
              @else style="background-color: red;" @endif >
              <a href="{{ route('statuses.edit', [$ticket->id]) }}" class='status-a'>
                {{$ticket->status->name}}
              </a></span>
            </p>-->

              <div class="progress" role="progressbar" aria-label="ProgressBar" width="80%" aria-label="Example 20px high"
                @if($ticket->status_id == '1') aria-valuenow="10"
                @elseif($ticket->status_id == '2') aria-valuenow="50"
                @else aria-valuenow="100" @endif aria-valuemin="0" aria-valuemax="100"> 
                <div @if($ticket->status_id == '1') class="progress-bar progress-bar-striped overflow-visible text-dark" style="width: 10%""
                  @elseif($ticket->status_id == '2') class="progress-bar progress-bar-striped bg-success overflow-visible text-dark" style="width: 50%""
                  @else aria-valuenow="100" @endif class="progress-bar progress-bar-striped bg-danger overflow-visible" style="width: 100%">
                  @if($ticket->status->name == "Closed")
                  <a href="{{ route('statuses.edit', [$ticket->id]) }}" class='status-a'>
                    {{$ticket->status->name}}
                  </a>
                  @endif
                </div>
                @if($ticket->status->name != "Closed")
                <a href="{{ route('statuses.edit', [$ticket->id]) }}" class='status-a'>
                    {{$ticket->status->name}}
                </a>
                @endif
              </div>
          </div>
          <div class='card1-text'>
            <p class='basic'>{{$ticket->created_at}}</p>
          </div>
          <div class='gumbi'>
            <p><button type="button" class="btn btn-primary"  onclick="show('{{$ticket->id}}')" title="view more"><i class="fa-sharp fa-solid fa-eye"></i></button></p>
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
                <a href="{{ route('ticket-clients.edit', [$ticket->id]) }}">
                  <button type="button">Odaberi korisnika</button>
                </a>
            @endif
          @endif
        </div>
        <div class ='sp2'> Opis:
          <p class='basic'>{{$ticket->details}}</p>
        </div>
        <div class='sp1'>
          <p><form action="{{ route('statuses.store') }}" method="POST" >
          @csrf
            <input type="hidden" id="ticket_id" name="ticket_id" value="{{$ticket->id}}">
            <select name="new_status_id" id="new_status_id" class="form-select">
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
          <p class='basic'>{{$comment->body}}</p>

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
                <label for="body" class="form-label">Komentar:</label><br>
                <textarea rows="4" cols="40"  id="body" name="body" class="form-control" placeholder="Upišite komentar"></textarea>
            </div>
            
            


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
            <br>
            <form action="{{ route('ticket-users.update', [$ticket->id]) }}" method="POST" >
                        @csrf
                        @method('put')
                        <input type="hidden" id="user_id" name="user_id" value="{{\App\Models\User::where('role', 'admin')->first()->id}}"></input>
                        <button type="submit" class="btn btn-danger mt-3">Otpusti</button>
                      </form>
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

    {{$tickets->links('pagination::bootstrap-5')}}
      
  </div>
</main>
@stop