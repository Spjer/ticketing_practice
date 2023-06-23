<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Http\Requests\StoreClientByAgentRequest;
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
                $clients= Client::all();
                return view('user.view_clients')->with('clients', $clients);
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
    public function store(StoreClientByAgentRequest $request)
    {  
           
        Client::query()->create($request->all());
         
        return Redirect()->back();
    }

    // Choose a client for a created ticket 
    public function edit(Ticket $ticket){ //pickClient
       // $ticket = Ticket::findOrFail($id);
        $clients = Client::all();
        if(Auth::user()->id == $ticket->user_id || Auth::user()->role == 'admin'){
            return view('user.pick_client')->with('clients', $clients)->with('ticket', $ticket);

        }
        return redirect()->route('user.home');

    }
    // Update/Store client chosen for a ticket   
    public function update(Request $request, $ticket_id){  //updatePick
        //$ticket_id = $request->input('ticket_id');
        $new_client_id = $request->input('new_client_id');
    
        Ticket::where('id', $ticket_id)->update(['client_id'=> $new_client_id]);
    
        return redirect()->route('tickets.show', [Auth::user()->id]);//view('user.home');
        
    }
}
