<table class="table" border=1>
                <thead>
                  <tr>
                    <th scope="col">Id ticketa</th>
                    <th scope="col"> Id klijenta</th>
                    <th scope="col"> Naziv</th>
                    <th scope="col">Detaljnije</th>
                    <th scope="col">Status</th>
                    <th scope="col">Status</th>
                    
                    
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
                      <td>{{$ticket->status}}</td>
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
                         <!-- nije jos route napravljena - add comments -->
                        
                      </td>
                      
                      
                      
                      
                    </tr>
                   
                  @endforeach
                  @endif
                </tbody>
            </table>