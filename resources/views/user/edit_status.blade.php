@extends('layout.master')
 
@section('title', 'Status')
 
@yield('navbar')

@section('content')
<main>
<form action="{{ route('store_status') }}" method="POST" >
    @csrf
    <input type="hidden" id="ticket_id" name="ticket_id" value="{{$ticket->id}}">
    <select name="new_status_id" id="new_status_id">
        <option value="1">Open</option>
        <option value="2">In progress</option>
        <option value="3">Closed</option>
    </select>
    <button type="submit" class="btn btn-primary mt-3">Promijeni status</button>
</main>
@stop