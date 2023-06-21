@extends('layout.masterClient')
 
@section('title', 'My tickets')
 
@yield('navbar')

@section('content')
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
                      <td><span class='status-span' id=statusId  @if($ticket->status_id == '1') style="background-color: blue;" 
                          @elseif($ticket->status_id == '2') style="background-color: green;" @else style="background-color: red;" @endif >{{$ticket->status->name}}</span></p>
                      </td>
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
@stop




  