<table class="table" border=1>
                <thead>
                  <tr>
                    <th scope="col">Id ticketa</th>
                    <th scope="col"> Id komentara</th>
                    <th scope="col"> Komentar</th>
                    <th scope="col"> </th>
                  </tr>
                </thead>
                <tbody>
                @if(count($ticket->comments))
                  @foreach($ticket->comments as $comment) 
                  
                    <tr align="right">
                      <td>{{$ticket->id}}</td>
                      <td>{{$comment->id}}</td>
                      <td>{{$comment->comm}}</td>
                      <td>
                       <!-- dodat delete comment -->
                       <a href="{{ route('delete_comment', [$comment->id]) }}">
                          <button type="button">Izbiši komentar</button>
                        </a>
                      </td>
                      
                      
                      
                      
                    </tr>
                    
                  @endforeach
                @endif
                </tbody>
            </table>