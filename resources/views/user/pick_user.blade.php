@extends('layout.master')
 
@section('title', 'Pick user')
 
@yield('navbar')
    

 


@section('content')
<main>
    <form action="{{ route('users.update', [$ticket->id]) }}" method="POST" >
    @csrf
    @method('PUT')
        <input type="hidden" id="ticket_id" name="ticket_id" value="{{$ticket->id}}">
        <select name="new_user_id" id="new_user_id">
            @foreach($user as $user)
            <option value="{{$user->id}}">{{$user->id}} - {{$user->name}}</option>
            @endforeach
            
        </select>
        <button type="submit" class="btn btn-primary mt-3">Promijeni Agenta</button>
    </form>
    
</main>




@stop