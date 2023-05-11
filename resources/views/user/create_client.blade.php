<h2>Dodavanje komentara</h2>
        <br>
        <form action="{{route('store_client')}}" method="POST" >
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
                <input type="text" id="name" name="name" placeholder="ime klijenta">
            </div>
            <br>
            <div>
                <input type="text" id="email" name="email" placeholder="email">
            </div>
            <br>
            <div>
                <input type="text" id="phone_number" name="phone_number" placeholder="phone_number">
            </div>
            <br>

            <button type="submit" class="btn btn-primary mt-3">Dodaj klijenta</button>
        </form>