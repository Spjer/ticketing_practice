<table class="table" border=1>
                <thead>
                  <tr>
                    <th scope="col">Id ticketa</th>
                    <th scope="col"> Id klijenta</th>
                    <th scope="col"> Naziv</th>
                    <th scope="col">Detaljnije</th>
                    <th scope="col">Status</th>
                    <th scope="col">Klijent</th>
                    
                    
                  </tr>
                </thead>
                <tbody>
                  @foreach($ticket as $ticket) 
                  @if($ticket->user_id == NULL)
                    <tr align="right">
                      <td>{{$ticket->id}}</td>
                      <td>{{$ticket->client_id}}</td>
                      <td>{{$ticket->tic_name}}</td>
                      <td>{{$ticket->details}}</td>
                      <td>{{$ticket->status->status}}</td>
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
                      <a href="{{ route('take_ticket', [$ticket->id]) }}">
                          <button type="button">Preuzmi</button>
                        </a>
                      </td>
                      
                      
                      
                      
                    </tr>
                    @endif
                  @endforeach
                </tbody>
            </table>