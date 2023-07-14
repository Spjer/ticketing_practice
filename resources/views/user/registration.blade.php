@extends('layout.master')
 
@section('title', 'Registration')
 
@yield('navbar')

@section('content')

<main>

    <div class="card" style="width: 24rem; left: 40%;" >
        <div class="card-header">
            <h4>User Registration</h4>
        </div><br>
        <div class="card-body" >
            <h5 class="card-title">Input your information</h5><br>
            <form action="{{ route('user.custom_registration') }}" method="POST">
                @csrf
                <div>
                    <label for="name" class="form-label">Name:</label><br>
                    <input type="text" class="form-control form-control-lg" placeholder="Name" id="name" name="name" required autofocus>
                        @if ($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                </div>

                <div>
                    <label for="email" class="form-label">Email:</label><br>
                    <input type="text" class="form-control form-control-lg" placeholder="email" id="email" name="email" required autofocus>
                        @if ($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                </div>
                            
                <div>
                    <label for="password" class="form-label">Lozinka:</label><br>
                    <input type="password" class="form-control form-control-lg" placeholder="Password" id="password" name="password" aria-labelledby="passwordHelpBlock" required autofocus>
                    <div id="passwordHelpBlock" class="form-text">
                        Your password must be at least 6 characters long.
                    </div>
                    @if ($errors->has('password'))
                        <span class="text-danger">{{ $errors->first('password') }}</span>
                    @endif
                </div>
                <br>
                <div>
                    <button type="submit" class="btn btn-lg btn-dark btn-block">Sign Up</button>
                </div>
            </form>
            
        </div>
    </div>

</main>
@stop
