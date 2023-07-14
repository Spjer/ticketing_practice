
@extends('layout.master')
 
@section('title', 'Tickets list')
 
@yield('navbar')

@section('content')
<main>
  <form action="#" method="GET" role="search">
    @csrf
    <div class="input-group">
        <input type="text" class="form-control" name="name"
            placeholder="Search tickets" default=" " style="width: 100%"> 
          <span class="input-group-btn">
            <button type="submit" class="btn btn-default">
                <span class="glyphicon glyphicon-search"></span>
            </button>
          </span>
        </input>
    </div>
  </form>
  <div>
    <div class='card0'>
          
      <div class='card1-text'>
        Ticket
      </div>
      <div class='card1-text' >
        Client
      </div>
      <div class='card1-text'>
        Status
      </div>
      <div class='card1-text'>
        Date
      </div>
      <div class='card1-text'>
        More
      </div>
    </div>
  </div>


  <div>
   
    
            @foreach($tickets as $ticket)
            @if($ticket->user_id == 1 || Auth::user()->role == 'admin' )
            <div class='card1'>
      
              <div class='card1-text'>
                <p style="white-space: nowrap; text-overflow: ellipsis">{{$ticket->name}} <span style="color:grey">#{{$ticket->id}}</span></p>
              </div>
              <div class='card1-text'>
                <p>{{$ticket->client->name}} <span style="color:grey">#{{$ticket->client_id}}</span></p>
              </div>
              <div class='card1-text' style="text-align:center">
                <p><span class='status-span' id=statusId  @if($ticket->status_id == '1') style="background-color: blue;" 
                @elseif($ticket->status_id == '2') style="background-color: green;" @else style="background-color: red;" @endif >{{$ticket->status->name}}</span></p>
              </div>
              <div class='card1-text'>
                <p>{{$ticket->created_at}}</p>
              </div>
              <div class='gumbi'>
                <p><button type="button" class="btn btn-primary" onclick="show('{{$ticket->id}}')" title="view more"><i class="fa-sharp fa-solid fa-eye"></i></button></p>

              </div>
              <!--SIDE PANNEL-->
              <div class='side-pnl' id='{{$ticket->id}}'>
                <button type="button" class="btn-close"  onclick="show('{{$ticket->id}}')" title="close" style="float: right"></button>

                <div class ='sp1'> Client:
                  @if(isset($ticket->client))
                    @if($ticket->client_id != '1')
                      <p>NAME: {{$ticket->client->name}}<span style="color:grey">#{{$ticket->client_id}}</span><br>
                        EMAIL: {{$ticket->client->email}}<br>
                        PHONE NUMBER: {{$ticket->client->phone_number}}</p>
                    @else
                      <a href="{{ route('ticket-clients.edit', [$ticket->id]) }}">
                        <button type="button" class="btn btn-dark btn-block">Assign client</button>
                      </a>
                    @endif
                  @endif
                  <br>
                    Agent:
                    <p>{{$ticket->user->name}}</p>
          
                </div>
                <div class ='sp2'> Description:
                  <p>{{$ticket->details}}</p>
                </div>
                <div class ='sp1'> Comments:
                  @foreach($ticket->comments as $comment)
                  <div class='sp2'>
                    <span style="color:grey">#{{$comment->id}}</span> {{$comment->created_at}}
                    <p>{{$comment->body}}</p>

                  </div>
                  @endforeach
                </div>



                <div class ='sp1'>
                  @if(Auth::user()->role == 'admin') 
                    <a href="{{ route('ticket-clients.edit', [$ticket->id]) }}">
                      <button type="button">Promijeni klijenta</button>
                    </a>
                    <a href="{{ route('ticket-users.edit', [$ticket->id]) }}">
                      <button type="button">Promijeni agenta</button>
                    </a>
                    @elseif($ticket->user->role == 'admin')
                      <form action="{{ route('ticket-users.update', [$ticket->id]) }}" method="POST" >
                        @csrf
                        @method('put')
                        <input type="hidden" id="user_id" name="user_id" value="{{Auth::user()->id}}">
                        <button type="submit" class="btn btn-primary mt-3">Preuzmi</button>
                      </form>
                    @endif

          
                </div>
                <div class='sp1'>
            
            
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

  
    
</div>
    

</main>
@stop





