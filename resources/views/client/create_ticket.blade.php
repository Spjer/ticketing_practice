
@extends('layout.masterClient')
 
@section('title', 'Create support ticket')
 
@yield('navbar')

@section('content')
<h2>Slanje ticketa</h2>
        <br>
        <form action="{{route('store_ticket')}}" method="POST" >
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
            <input type="hidden" id="client_id" name="client_id" value="{{$client->id}}">
            <input type="hidden" id="user_id" name="user_id" value="1">
            <input type="hidden" id="status_id" name="status_id" value="1">


            <div>
                <label for="tic_name">Naziv</label>
                <input type="text" id="tic_name" name="tic_name" placeholder="Upišite naziv">
            </div>
            <br>
            <div>
                <label for="details">Detaljnije</label>
                <input type="text"  id="details" name="details"  placeholder="Opišite problem">
            </div>

            <br>
            <!--<input type="hidden" id="status" name="status" value=open>-->
            <br>

            


            <button type="submit" class="btn btn-primary mt-3">Pošalji ticket</button>
        </form>
        @stop