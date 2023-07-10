@extends('layout.master')
 
@section('title', 'Adding Comments')
 
@yield('navbar')

@section('content')
<main>
    <h2>Dodavanje komentara</h2>
        <br>
        <form action="{{route('comments.store')}}" method="POST" >
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
            <input type="hidden" id="ticket_id" name="ticket_id" class="form-label" value="{{$ticket->id}}">
            
            <div>
                <label for="body">Komentar:</label>
                <input type="text" id="body" name="body" placeholder="Upišite komentar" class="form-control" width=500 col="10" row="10">
            </div>
            <br>
            


            <button type="submit">Dodaj komentar</button>
        </form>
</main>
@stop