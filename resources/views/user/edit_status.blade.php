@extends('layout.master')
 
@section('title', 'Status')
 
@yield('navbar')

@section('content')
<main>
    <div class="card" style="width: 20%; padding: 5px">
        <form action="{{ route('statuses.store') }}" method="POST" >
            @csrf
            <input type="hidden" id="ticket_id" name="ticket_id" class="form-select" value="{{$ticket->id}}">
            <select name="new_status_id" id="new_status_id" class="form-select">
                <option value="1" @if($ticket->status_id == '1') {{'selected'}} @endif >Open</option>
                <option value="2" @if($ticket->status_id == '2') {{'selected'}} @endif >In progress</option>
                <option value="3" @if($ticket->status_id == '3') {{'selected'}} @endif >Closed</option>
            </select>
            <button type="submit" class="btn btn-primary mt-3">Promijeni status</button>
        </form>
    </div>
</main>
@stop