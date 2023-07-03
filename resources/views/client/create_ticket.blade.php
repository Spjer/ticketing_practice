
@extends('layout.masterClient')
 
@section('title', 'Create support ticket')
 
@yield('navbar')

@section('content')
<div class="forms">
<h2>Slanje ticketa</h2>
    <br>
    <form action="{{route('tickets.store')}}" method="POST" >
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
        <input type="hidden" id="client_id" name="client_id" value="{{Auth::user()->id}}">
        <input type="hidden" id="user_id" name="user_id" value="{{\App\Models\User::where('role', 'admin')->first()->id}}">

        <!--<input type="hidden" id="status_id" name="status_id" value="{{\App\Models\Status::where('name', 'Open')->first()->id}}">-->


        <div>
            <label for="name">Naziv</label>
            <input type="text" id="name" name="name" placeholder="Upišite naziv">
        </div>
        <br>
        <div>
            <label for="details">Detaljnije</label><br>
            <textarea rows="4" cols="50"  id="details" name="details"  placeholder="Opišite problem"></textarea>
        </div>

        <br>
        <br>

            


        <button type="submit" class="btn btn-primary mt-3">Pošalji ticket</button>
    </form>
</div>
@stop