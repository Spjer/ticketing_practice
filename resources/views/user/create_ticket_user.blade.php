
@extends('layout.master')
 
@section('title', 'Create support ticket')
 
@yield('navbar')

@section('content')
<main>
<div class = "forms">
    <h2>Open a Ticket</h2>
        <br>
        
        <form action="{{route('tickets.store')}}" method="POST" >
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
            <input type="hidden" id="user_id" name="user_id" value="{{$user->id}}">
           <!-- <input type="hidden" id="client_id" name="client_id" value="{{\App\Models\Client::where('email', 'temp.tmp@mail.com')->first()->id}}">-->
            <!--<input type="hidden" id="status_id" name="status_id" value="{{\App\Models\Status::where('name', 'Open')->first()->id}}">-->
            

            <div>
                <label for="name" class="form-label">Name</label>
                <input type="text" id="name" name="name" class="form-control" placeholder="Upišite naziv">
            </div>
            <br>
            <div>
                <label for="details" class="form-label">Description</label><br>
                <textarea rows="4" cols="50"  id="details" name="details" class="form-control" placeholder="Opišite problem"></textarea>
            </div>

            <br>
            <div>            
                <select name="client_id" id="client_id" class="form-select">
                    @foreach($clients as $client)
                    <option value="{{$client->id}}">{{$client->name}} - {{$client->email}}</option>
                    @endforeach
                </select><br>

                <button type="button" class="btn btn-dark btn-block" onclick="show()">Add new client</button>
            <br><br>
            </div>
            <br>

            


            <button type="submit" class="btn btn-primary mt-3">Send</button>
        </form>
    </div>
    <!--SIDE PANNEL-->
    <div class='side-pnl2' id='sd_pnl'>
        <form action="{{ route('clients.store') }}" method="POST" >
            @csrf
            <input type="hidden" id="password" name="password" value=" ">
            <div>
            
                <label for="name" class="form-label">Name:</label><br>
                <input type="text" placeholder="Name" id="name" name="name" class="form-control" value="{{ old('name')}}" required autofocus>
                @if ($errors->has('name'))
                <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
            </div>
            
            <div>
                <label for="email" class="form-label">Email:</label><br>
                <input type="text" placeholder="email" id="email" name="email" class="form-control" value="{{ old('email')}}" required autofocus>
                @if ($errors->has('email'))
                <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
            </div>
            
            <div>
                <label for="phone_number" class="form-label">Phone number:</label><br>
                <input type="tel" placeholder="xxx-xxx-xxxx" id="phone_number" name="phone_number" class="form-control" value="{{ old('phone_number')}}" pattern="[0-9]{3}-[0-9]{3}-[0-9]{3-4}" required autofocus>
                @if ($errors->has('phone_number'))
                <span class="text-danger">{{ $errors->first('phone_number') }}</span>
                @endif
            </div>
    
            <div>
                <button type="submit" class="btn btn-primary mt-3">Add client</button>
            </div>
        </form>
    </div>
        <script>
            function show() {
                if (sd_pnl.style.display === "none") {
                    sd_pnl.style.display = "block";
                } else {
                    sd_pnl.style.display = "none";
                }
            }
        </script>

    </div>

</main>
        @stop