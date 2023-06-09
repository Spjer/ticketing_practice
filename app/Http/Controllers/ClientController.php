<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\User;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    //
    // List of clients
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

    //  Store client created by agent
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

    // Choose a client for a created ticket 
    public function edit($id){ //pickClient
        $ticket = Ticket::find($id);
        $client = Client::all();
        if(Auth::user()->id == $ticket->user_id || Auth::user()->role == 'admin'){
            return view('user.pick_client') -> with('client', $client) ->with('ticket', $ticket);

        }
        return redirect()->route('user.home');

    }
    // Update/Store client chosen for a ticket   
    public function update(Request $request, $ticket_id){  //updatePick
        //$ticket_id = $request->input('ticket_id');
        $new_client_id = $request->input('new_client_id');
    
        Ticket::where('id', $ticket_id)->update(['client_id'=> $new_client_id]);
    
        return view('user.home');
        
    }
}
