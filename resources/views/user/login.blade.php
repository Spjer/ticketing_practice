@extends('layout.master')
 
@section('title', 'LogIn')
 
@yield('navbar')

@section('content')
<main>
    <h3>Log In</h3>
    <form method="POST" action="{{ route('user.customLogin') }}">
        @csrf
        <div >
            <label for="name">Ime:</label><br>
            <input type="text" placeholder="name" id="name" name="name" required autofocus>
            @if ($errors->has('name'))
                <span>{{ $errors->first('name') }}</span>
            @endif
        </div>
        <div >
            <label for="password">Lozinka:</label><br>
            <input type="password" placeholder="Password" id="password" name="password" required>
            @if ($errors->has('password'))
                <span>{{ $errors->first('password') }}</span>
            @endif
        </div>
                            
        <div>
            <button type="submit">Log In</button>
        </div>
    </form>
</main>
                    



            
            
@stop