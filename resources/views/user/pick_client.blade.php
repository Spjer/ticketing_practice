@extends('layout.master')
 
@section('title', 'Pick Client')
 
@yield('navbar')
    

 


@section('content')
<main>
    <div class="forms">
    <form action="{{ route('ticket-clients.update', [$ticket->id]) }}" method="POST" >
    @csrf
    @method('PUT')

    
        <input type="hidden" id="ticket_id" name="ticket_id" value="{{$ticket->id}}">
        <select name="new_client_id" id="new_client_id">
            @foreach($clients as $client)
            <option value="{{$client->id}}">{{$client->name}} - {{$client->email}}</option>
            @endforeach
            
        </select><br>
        <button type="submit" class="btn btn-primary mt-3">Promijeni Klijenta</button>
    </form>
    
    <br><br>

    <form action="{{ route('clients.store') }}" method="POST" >
    @csrf
        <input type="hidden" id="password" name="password" value=" ">
        <div>
            
            <label for="name" class="form-label">Ime:</label><br>
            <input type="text" placeholder="Name" id="name" name="name" value="{{ old('name')}}" required autofocus>
                @if ($errors->has('name'))
                <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
        </div>
            
        <div>
            <label for="email" class="form-label">Email:</label><br>
            <input type="text" placeholder="email" id="email" name="email" value="{{ old('email')}}" required autofocus>
                @if ($errors->has('email'))
                <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
        </div>
            
        <div>
            <label for="phone_number" class="form-label">Broj telefona:</label><br>
            <input type="tel" placeholder="xxx-xxx-xxxx" id="phone_number" name="phone_number" value="{{ old('phone_number')}}" pattern="[0-9]{3}-[0-9]{3}-[0-9]{3-4}" required autofocus>
                @if ($errors->has('phone_number'))
                <span class="text-danger">{{ $errors->first('phone_number') }}</span>
                @endif
        </div>
    
        <div>
            <button type="submit" class="btn btn-primary mt-3">Dodaj novog klijenta</button>
        </div>
    </form>
    </div>
    
</main>




@stop