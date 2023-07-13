@extends('layout.masterClient')
 
@section('title', 'LogIn')
 
@yield('navbar')

@section('content')


<main>

    <div class="card" style="width: 18rem;">
        <div class="card-header">
            Log In
        </div>
        <div class="card-body" >
            <h5 class="card-title">Input your information</h5><br>
            <div class="text-danger">
            @if($errors->any())
                {{$errors->first()}}   
            @endif
            </div>
            <form method="POST" action="{{ route('client.custom_login') }}">
            @csrf
                <div>
                    <label for="email" class="form-label">Email:</label><br>
                    <input type="text" class="form-control" placeholder="aaaa.aaaaaa@email.aa" id="email" name="email" required/>
                    @if ($errors->has('email'))
                        <span>{{ $errors->first('email') }}</span>
                    @endif
                </div>
                <div>
                    <label for="password" class="form-label">Password:</label><br>
                    <input type="password" class="form-control" name="password" name="id" placeholder="********" required/>
                    @if ($errors->has('password'))
                        <span>{{ $errors->first('password') }}</span>
                    @endif
                </div>
                <br>            
                <div>
                    <button type="submit" class="btn btn-dark btn-block">Log In</button>
                </div>
            </form>
                
        </div>
    </div>
</main>
@stop