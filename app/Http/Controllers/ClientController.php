<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    //
    public function index(){
        if(Auth::check()){
            if(Auth::user()->role == 'admin'){
                $client= Client::all();
                return view('user.view_clients')->with('client', $client);
            }
            else{
                return view('user.home');
            }
        }
        else{
            return view('opening');
        }

    }

    public function store(Request $request)
    {  
        $request->validate([
            'name' => ['required', 'max:30'],
            'email' => ['required', 'email', 'max:40', 'unique:clients,email'],
            'phone_number' =>  ['required', 'min:11', 'max:12', 'regex:/^([0-9]){3}-([0-9]){3}-([0-9])/'],

        ]);
           
        Client::query()->create($request->all());
         
        return Redirect()->back();
    }
}
