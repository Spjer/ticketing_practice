@extends('layout.master')
 
@section('title', 'Pick user')
 
@yield('navbar')
    

 


@section('content')
<main>
    
    <form action="{{ route('ticket-users.update', [$ticket->id]) }}" method="POST" >
    @csrf
    @method('put')
        <select name="user_id" id="user_id">
            @foreach($users as $user)
            <option value="{{$user->id}}">{{$user->id}} - {{$user->name}}</option>
            @endforeach
            
        </select>
        <button type="submit" class="btn btn-primary mt-3">Promijeni Agenta</button>
    </form>
    
</main>




@stop