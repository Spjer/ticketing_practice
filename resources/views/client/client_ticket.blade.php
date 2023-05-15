@extends('layout.masterClient')
 
@section('title', 'My tickets')
 
@yield('navbar')

@section('content')
<table class="table" border=1>
<tbody>
                  @foreach($client->tickets as $ticket) 
                    <tr align="right">
                      <td>{{$ticket->id}}</td>
                      <td>{{$ticket->client_id}}</td>
                      <td>{{$ticket->tic_name}}</td>
                      <td>{{$ticket->details}}</td>
                      <!--<td>{{$ticket->status}}</td>-->
                      <td>{{$ticket->status->status}}</td>
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
@stop