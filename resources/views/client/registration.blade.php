@extends('layout.masterClient')
 
@section('title', 'Registration')
 
@yield('navbar')

@section('content')
<main>
    <h3>Registracija Korisnika</h3>
    <div>
        <form action="{{ route('client.custom_registration') }}" method="POST">
            @csrf
            <div>
                <label for="name">Ime:</label><br>
                <input type="text" placeholder="Name" id="name" name="name" required autofocus>
                    @if ($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                     @endif
            </div>
            
            <div>
                <label for="email">Email:</label><br>
                <input type="text" placeholder="email" id="email" name="email" required autofocus>
                    @if ($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif
            </div>
            
            <div>
                <label for="phone_number">Broj telefona:</label><br>
                <input type="tel" placeholder="xxx-xxx-xxxx" id="phone_number" name="phone_number" pattern="[0-9]{3}-[0-9]{3}-[0-9]{3-4}" required autofocus>
                    @if ($errors->has('phone_number'))
                    <span class="text-danger">{{ $errors->first('phone_number') }}</span>
                    @endif
            </div>
            
            <div>
                <label for="password">Lozinka:</label><br>
                <input type="password" placeholder="********" id="password" name="password" required>
                    @if ($errors->has('password'))
                    <span class="text-danger">{{ $errors->first('password') }}</span>
                    @endif
            </div>
    
            <div>
                <button type="submit">Sign Up</button>
            </div>
        </form>
    </div>
               
</main>
@stop
