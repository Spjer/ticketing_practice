
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
                      
                    </tr>
                  @endforeach
</tbody>
</table>