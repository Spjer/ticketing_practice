<table class="table" border=1>
                <thead>
                  <tr>
                    <th scope="col">Id ticketa</th>
                    <th scope="col">Naziv</th>
                    <th scope="col">Detaljnije</th>
                    <th scope="col">Status</th>
                    <th scope="col">Klijents</th>
                  
                    
                  </tr>
                </thead>
                <tbody>
                    @if(count($user->tickets))
                  @foreach($user->tickets as $ticket) 
                  
                    <tr align="right">
                      <td>{{$ticket->id}}</td>
                      <td>{{$ticket->tic_name}}</td>
                      <td>{{$ticket->details}}</td>
                      <td>{{$ticket->status}}</td>
                      <td>Klijent</tb>
                      <td>
                      <!-- Napravit da se moze promijenit status i otpustit ticket -->
                      <!-- drop ticket = otpusti ticket -->
                        <a href="{{ route('drop_ticket', [$ticket->id]) }}">
                          <button type="button">Odbaci</button>
                        </a>
                     
                      <!-- view comments, add comments, delete comment-->
                        <a href="{{ route('view_comments', [$ticket->id]) }}">
                          <button type="button">Komentari</button>
                        </a>
                        <a href="{{ route('create_comment', [$ticket->id]) }}">
                          <button type="button">Dodaj komentar</button>
                        </a>
                         <!-- nije jos route napravljena - add client  ////////////////////napravljeno-->
                         
                        
                      </td>
                      <td>
                        <div>
                          @if(isset($ticket->client))
                          {{$ticket->client->id}}-{{$ticket->client->name}}<br>
                            {{$ticket->client->email}}<br>
                            {{$ticket->client->phone_number}}
                            @else
                              <a href="{{ route('create_client', [$ticket->id]) }}">
                                <button type="button">Dodaj klijenta</button>
                              </a>
                          @endif
                        </div>
                      
                      

                      </td>
                      
                      
                      
                      
                    </tr>
                   
                  @endforeach
                  @endif
                </tbody>
            </table>