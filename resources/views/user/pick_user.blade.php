@extends('layout.master')
 
@section('title', 'Pick user')
 
@yield('navbar')
    

 


@section('content')
<main>
    <form action="{{ route('update_user') }}" method="POST" >
    @csrf
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