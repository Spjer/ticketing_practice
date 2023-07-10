@extends('layout.master')
 
@section('title', 'Registration')
 
@yield('navbar')

@section('content')

<main>
    <h3>Registracija Korisnika</h3>
    <div>
        <form action="{{ route('user.custom_registration') }}" method="POST">
            @csrf
            <div>
                <label for="name" class="form-label">Ime:</label><br>
                <input type="text" placeholder="Name" id="name" name="name" required autofocus>
                    @if ($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
            </div>

            <div>
                <label for="email" class="form-label">Email:</label><br>
                <input type="text" placeholder="email" id="email" name="email" required autofocus>
                    @if ($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif
            </div>
                           
            <div>
                <label for="password" class="form-label">Lozinka:</label><br>
                <input type="password" placeholder="Password" id="password" name="password" required autofocus>
                @if ($errors->has('password'))
                    <span class="text-danger">{{ $errors->first('password') }}</span>
                @endif
            </div>
            
            <div>
                <button type="submit" class="btn btn-dark btn-block">Sign Up</button>
            </div>
        </form>
    </div>
</main>
@stop
