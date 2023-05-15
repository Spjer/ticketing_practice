@extends('layout.master')
 
@section('title', 'LogIn')
 
@yield('navbar')

@section('content')
<h3>Log In</hr>
<form method="POST" action="{{ route('user.customLogin') }}">
    @csrf
    <div >
        <input type="text" placeholder="name" id="name" name="name" required autofocus>
        @if ($errors->has('name'))
            <span>{{ $errors->first('name') }}</span>
            @endif
    </div>
    <div >
        <input type="password" placeholder="Password" id="password" name="password" required>
        @if ($errors->has('password'))
        <span>{{ $errors->first('password') }}</span>
        @endif
    </div>
                            
    <div>
        <button type="submit" class="btn btn-dark btn-block">Sign In</button>
    </div>
</form>
                    



            
            
@stop