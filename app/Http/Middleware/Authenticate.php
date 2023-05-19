<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {

        ////// TREBA POPRAVIT --privremeno rjesenje
        if(! $request->expectsJson()){
            if($request->is('webclient')){
                //return route('client.login');
                return route('opening');
            }
            //return route('user.login');
            return route('opening');

        }
        //return $request->expectsJson() ? null : route('login');
    }
}
