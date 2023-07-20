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
      
      <div class='card1-text'>
        Status
      </div>
      <div class='card1-text'>
        Date
      </div>
    </div>

    @foreach($tickets as $ticket)
    <div>
      <div class='card1'>
        <div class='card1-text'>
          <p class='basic' style="white-space: nowrap; text-overflow: ellipsis">{{$ticket->name}} <span style="color:grey">#{{$ticket->id}}</span></p>
        </div>
        
        <div class='card1-text' style="text-align:center">
        <!--<p class='basic'><span class='status-span' @if($ticket->status_id == '1') style="background-color: blue;" 
          @elseif($ticket->status_id == '2') style="background-color: green;" 
          @else style="background-color: red;" @endif >
          {{$ticket->status->name}}</span></p>-->

          <div class="progress" role="progressbar" aria-label="ProgressBar" width="80%" aria-label="Example 20px high"
                @if($ticket->status_id == '1') aria-valuenow="10"
                @elseif($ticket->status_id == '2') aria-valuenow="50"
                @else aria-valuenow="100" @endif aria-valuemin="0" aria-valuemax="100"> 
                <div @if($ticket->status_id == '1') class="progress-bar progress-bar-striped overflow-visible text-dark" style="width: 10%""
                  @elseif($ticket->status_id == '2') class="progress-bar progress-bar-striped bg-success overflow-visible text-dark" style="width: 50%""
                  @else aria-valuenow="100" @endif class="progress-bar progress-bar-striped bg-danger overflow-visible" style="width: 100%">
                  @if($ticket->status->name == "Closed")
                    {{$ticket->status->name}}
                  @endif
                </div>
                @if($ticket->status->name != "Closed")
                    {{$ticket->status->name}}
                @endif
              </div>
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




  