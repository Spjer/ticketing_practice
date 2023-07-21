<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\User;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class TicketClientController extends Controller
{
    //
     // Choose a client for a created ticket 
     public function edit(Ticket $param){ //pickClient
        $this->authorize('update', $param);

        $clients = Client::all();
        return view('user.pick_client')->with('clients', $clients)->with('ticket', $param);
    }
    // Update/Store client chosen for a ticket   
    public function update(Request $request, $param){  //updatePick
        
        $new_client_id = $request->input('new_client_id');
        $ticket = Ticket::where('id', $param)->update(['client_id'=> $new_client_id]);
        return redirect()->route('tickets.show', [Auth::user()->id]);//view('user.home');
        
    }

    public function create(Client $client){ 
        if ( !Gate::allows('create-by-client',Auth::user()->id, $client->id)) {
            abort(403);
        }
        
        return view('client.create_ticket')->with('client', $client);
    }

    public function show(Client $client){
  
        $tickets = Ticket::where('client_id', Auth::user()->id)->get();
        return view('client.client_ticket') ->with('tickets', $tickets);
        
        

        
    }
}
