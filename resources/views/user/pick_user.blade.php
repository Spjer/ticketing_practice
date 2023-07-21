@extends('layout.master')
 
@section('title', 'Pick user')
 
@yield('navbar')
    

 


@section('content')
<main>
    
    
    <div class="card" style="width: 40%; padding: 5px">
        <form action="{{ route('ticket-users.update', [$ticket->id]) }}" method="POST" >
        @csrf
        @method('put')
            <p><select name="user_id" id="user_id">
                @foreach($users as $user)
                <option value="{{$user->id}}">{{$user->id}} - {{$user->name}}</option>
                @endforeach
                
            </select>
            <button type="submit" class="btn btn-primary mt-3">Promijeni Agenta</button></p>
        </form>
    </div>
</main>




@stop