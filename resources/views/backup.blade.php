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






@extends('layout.master')
 
@section('title', 'Tickets list')
 
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
      <div class='card1-text'>
        Više
      </div>
    </div>
  </div>


  @foreach($tickets as $ticket)
  
    <div class='card1'>
      
      <div class='card1-text'>
        <p style="white-space: nowrap; text-overflow: ellipsis">{{$ticket->tic_name}} <span style="color:grey">#{{$ticket->id}}</span></p>
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
                <a href="{{ route('clients.edit', [$ticket->id]) }}">
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
          @if(Auth::user()->role == 'admin') 
          <a href="{{ route('clients.edit', [$ticket->id]) }}">
            <button type="button">Promijeni korisnika</button>
          </a>
          <a href="{{ route('users.edit', [$ticket->id]) }}">
            <button type="button">Promijeni agenta</button>
          </a>
          @elseif($ticket->user_id == 1)
          <p><a href="{{ route('take_ticket', [$ticket->id]) }}">
                <button type="button" class="take-btn">Preuzmi</button>
              </a></p>
          @endif

          
        </div>
        <div class='sp1'>
           <!-- Napravit da se moze promijenit status i otpustit ticket -->
            <!-- drop ticket = otpusti ticket -->
            
            
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










  @foreach($tickets as $ticket)
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
                <a href="{{ route('clients.edit', [$ticket->id]) }}">
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




@extends('layout.master')
 
@section('title', 'Tickets list')
 
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
      <div class='card1-text'>
        Više
      </div>
    </div>
  </div>


  @foreach($tickets as $ticket)
  
    <div class='card1'>
      
      <div class='card1-text'>
        <p style="white-space: nowrap; text-overflow: ellipsis">{{$ticket->tic_name}} <span style="color:grey">#{{$ticket->id}}</span></p>
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
                <a href="{{ route('clients.edit', [$ticket->id]) }}">
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
          @if(Auth::user()->role == 'admin') 
          <a href="{{ route('clients.edit', [$ticket->id]) }}">
            <button type="button">Promijeni korisnika</button>
          </a>
          <a href="{{ route('users.edit', [$ticket->id]) }}">
            <button type="button">Promijeni agenta</button>
          </a>
          @elseif($ticket->user_id == 1)
          <p><a href="{{ route('take_ticket', [$ticket->id]) }}">
                <button type="button" class="take-btn">Preuzmi</button>
              </a></p>
          @endif

          
        </div>
        <div class='sp1'>
           <!-- Napravit da se moze promijenit status i otpustit ticket -->
            <!-- drop ticket = otpusti ticket -->
            
            
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

</main>
@stop











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
            <p class='basic' style="white-space: nowrap; text-overflow: ellipsis">{{$ticket->tic_name}} <span style="color:grey">#{{$ticket->id}}</span></p>
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
                {{$ticket->status->status}}
              </a></span>
            </p>
          </div>
          <div class='card1-text'>
            <p class='basic'>{{$ticket->created_at}}</p>
          </div>
          <div class='gumbi'>
             <!-- Napravit da se moze promijenit status i otpustit ticket -->
            <!-- drop ticket = otpusti ticket -->
            <p >
            @if(Auth::user()->role != 'admin')
            <a href="{{ route('drop_ticket', [$ticket->id]) }}">
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
            <!-- drop ticket = otpusti ticket -->
             <!-- view comments, add comments-->
             <a href="{{ route('comments.show', [$ticket->id]) }}">
              <button type="button">Komentari</button>
            </a>
            @if(Auth::user()->role != 'admin')
            <a href="{{ route('drop_ticket', [$ticket->id]) }}">
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



///ticket validacija
/// SJETI se napravit validaciju 
        //$validateData = $request->validate([
        //    'tic_name' => ['required', 'max:40'],
        //    'details' => ['required', 'max:400'],
        //]);

//Comment
        $validateData = $request->validate([
            'ticket_id' => ['required', 'numeric'],
            'comm' =>  ['required', 'max:400'],
        ]);



        TicketController
        <?php
/*
namespace App\Http\Controllers;
use App\Http\Requests;

use Illuminate\Http\Request;
use App\Http\Requests\StoreTicketRequest;
use App\Models\Ticket;
use App\Models\User;
use App\Models\Comment;
use App\Models\Client;
use App\Models\Status;
use Illuminate\Support\Facades\Auth;

use DB;


class TicketController extends Controller
{
    // all_tickets
    public function index(){
        $tickets = Ticket::all();
        $users = User::all();
        
        return view('all_tickets')->with('users', $users)->withDetails($tickets)->withQuery ( " " );   

    }

    public function createTicket(Client $client){ 
        
        return view('client.create_ticket')->with('client', $client);
    }

    public function createTicketUser(User $user){ 
        if(Auth::user()->id != $user->id){
            return redirect()->route('user.home');
        }
        return view('user.create_ticket_user')->with('user', $user);
    }


    
    public function store(StoreTicketRequest $request)
    {

        $ticket = new Ticket();
        //if(Auth::guard('web')->check()){
            
        //    $ticket->client_id = Client::select('id')->where('email','temp.tmp@mail.com')->limit(1)->first()->id;
        //    $ticket->user_id = $request->input('user_id');
        //}else{
        //    $ticket->client_id = $request->input('client_id');
        //    $ticket->user_id = User::select('id')->where('role','admin')->limit(1)->first()->id;
            
        //}
        $ticket->client_id = $request->input('client_id');
        $ticket->user_id = $request->input('user_id');

        $ticket->status_id = Status::select('id')->where('name','Open')->limit(1)->first()->id;
        //Ticket::query()->create($request->all());
        $ticket->name = $request->input('name');
        $ticket->details = $request->input('details');
        $ticket->save();
       
        if(Auth::guard('web')->check()){
            return redirect()->route('clients.edit', $ticket->id);
        }
        //$client_id = $request->input('client_id');
        return redirect()->route('client_ticket', $ticket->client_id);

    }

        // My_Tickets
    public function show(User $user){ 
        if(Auth::user()->id != $user->id){
            return redirect()->route('user.home');
        }else{
            //$user = User::findOrFail($id);
            return view('user.my_tickets')->with('user', $user);
        }
        
    }
    
    // take on ticket -> ticket goes to my_tickets
    public function takeTicket($id){    
        Ticket::where('id', $id)->update(['user_id'=> Auth::user()->id]);
        return redirect()->route('tickets.index');
    }

    // drop/release ticket -> ticket goes to all_tickets/tickets.index
    public function dropTicket(Ticket $ticket){ 
        
        $admin_id = User::select('id')->where('role','admin')->limit(1)->first()->id;
        if(Auth::user()->id != $ticket->user_id){
            return redirect()->route('user.home');
        }
        Ticket::where('id', $ticket->id)->update(['user_id'=> $admin_id]);
        return redirect()->back();
    }

    public function search(Request $request){
        $name = $request->input( 'name' );
        
        $ticket = Ticket::where('name','LIKE','%'.$name.'%')->get(); //->orWhere('client','LIKE','%'.$q.'%')
        if(count($ticket) > 0)
            return view('all_tickets')->withDetails($ticket)->withQuery ( $name );
        else return view ('all_tickets');
    }
    
}*/
