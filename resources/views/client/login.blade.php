@extends('layout.masterClient')
 
@section('title', 'LogIn')
 
@yield('navbar')

@section('content')


<main>
<form action="{{ route('client.customLogin') }}" method="POST">
    @csrf
    <div>
        <label for="email">Email:</label><br>
        <input type="text"  placeholder="aaaa.aaaaaa@email.aa" id="email" name="email" required/>
        @if ($errors->has('email'))
            <span>{{ $errors->first('email') }}</span>
        @endif
    </div>
    <div>
        <label for="password">Lozinka:</label><br>
        <input type="password" name="password" name="id" placeholder="********" required/>
        @if ($errors->has('password'))
            <span>{{ $errors->first('password') }}</span>
        @endif
    </div>
    <div>
        <button type="submit">Log in</button>
    </div>
</form>
</main>
@stop