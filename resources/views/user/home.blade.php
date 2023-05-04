@extends('layout.base') 


@section('content')


<h1>Hello User</h1>


            
@auth
<a href="{{ route('all_tickets') }}">
    <button type="submit">Svi ticketi</button>
</a>
<br>
<a href="{{ route('user.my_tickets', [Auth::user()->id]) }}">
    <button type="submit">Peuzeti ticketi</button>
</a>
<br>
<a href="{{ route('user.logout') }}">Logout</a>
<div>{{ Auth::user()->name }}</div>

@endauth




@endsection