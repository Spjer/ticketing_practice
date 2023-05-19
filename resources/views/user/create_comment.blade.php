@extends('layout.master')
 
@section('title', 'Adding Comments')
 
@yield('navbar')

@section('content')
<main>
    <h2>Dodavanje komentara</h2>
        <br>
        <form action="{{route('store_comment')}}" method="POST" >
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
            <input type="hidden" id="ticket_id" name="ticket_id" value="{{$ticket->id}}">
            
            <div>
                <label for="comm">Komentar:</label>
                <input type="text" id="comm" name="comm" placeholder="Upišite komentar" width=500 col="10" row="10">
            </div>
            <br>
            


            <button type="submit">Dodaj komentar</button>
        </form>
</main>
@stop