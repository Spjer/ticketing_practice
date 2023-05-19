@extends('layout.masterClient')
 
@section('title', 'My tickets')
 
@yield('navbar')

@section('content')
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
@stop