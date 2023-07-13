@extends('layout.masterClient')
 
@section('title', 'Registration')
 
@yield('navbar')

@section('content')
<main>
    
    <div class="card" style="width: 18rem;">
        <div class="card-header">
            Client Registrations
        </div>
        <div class="card-body" >
            <h5 class="card-title">Input your information</h5><br>
            <form method="POST" action="{{ route('client.custom_login') }}">
            @csrf
                <div>
                    <label for="name">Name:</label><br>
                    <input type="text" class="form-control" placeholder="Name" id="name" name="name" required autofocus>
                        @if ($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                </div>
                <div>
                    <label for="email" class="form-label">Email:</label><br>
                    <input type="text" class="form-control" placeholder="aaaa.aaaaaa@email.aa" id="email" name="email" required autofocus>
                    @if ($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif
                </div>
                <div>
                <label for="phone_number" class="form-label">Phone number:</label><br>
                    <input type="tel" class="form-control" placeholder="xxx-xxx-xxxx" id="phone_number" name="phone_number" pattern="[0-9]{3}-[0-9]{3}-[0-9]{3-4}" required autofocus>
                    @if ($errors->has('phone_number'))
                    <span class="text-danger">{{ $errors->first('phone_number') }}</span>
                    @endif
                </div>
                <div>
                    <label for="password" class="form-label">Password:</label><br>
                    <input type="password" class="form-control" placeholder="********" id="password" name="password" aria-labelledby="passwordHelpBlock" required>
                    <div id="passwordHelpBlock" class="form-text">
                        Your password must be at least 6 characters long.
                    </div>
                    @if ($errors->has('password'))
                        <span class="text-danger">{{ $errors->first('password') }}</span>
                    @endif
                </div>
                <br>            
                <div>
                    <button type="submit" class="btn btn-dark btn-block">Sign Up</button>
                </div>
            </form>
                
        </div>
    </div>
               
</main>
@stop
