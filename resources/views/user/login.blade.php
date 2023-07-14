@extends('layout.master')
 
@section('title', 'LogIn')
 
@yield('navbar')

@section('content')
<main>

    <div class="card" style="width: 24rem; left: 40%;">
        <div class="card-header">
            <h4>Log In</h4>
        </div>
        <br>
        <div class="card-body" >
            <h5 class="card-title">Input your information</h5><br>
            <div class="text-danger">
            @if($errors->any())
                {{$errors->first()}}   
            @endif
            </div>
            <br>
            <form method="POST" action="{{ route('user.custom_login') }}">
                @csrf
                <div >
                    <label for="name" class="form-label">Username: </label><br>
                    <input type="text" class="form-control form-control-lg" placeholder="name" id="name" name="name" required autofocus>
                    @if ($errors->has('name'))
                        <span>{{ $errors->first('name') }}</span>
                    @endif
                </div>
                <div >
                    <label for="password" class="form-label">Password:</label><br>
                    <input type="password" class="form-control form-control-lg" placeholder="******" id="password" name="password" required>
                    @if ($errors->has('password'))
                        <span>{{ $errors->first('password') }}</span>
                    @endif
                </div>
                <br>            
                <div>
                    <button type="submit" class="btn btn-lg btn-dark btn-block">Log In</button>
                </div>
            </form>
            
        </div>
    </div>
</main>
                    



            
            
@stop