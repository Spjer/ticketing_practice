<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\User;
use App\Models\comment;
use App\Models\Client;
use App\Models\Status;
use Illuminate\Support\Facades\Auth;
use DB;

class TicketController2 extends Controller
{
    //


    /*public function pickClient($id){
        $ticket = Ticket::find($id);
        $client = Client::all();
        if(Auth::user()->id == $ticket->user_id || Auth::user()->role == 'admin'){
            return view('user.pick_client') -> with('client', $client) ->with('ticket', $ticket);

        }
        return redirect()->route('user.home');

    }
    public function updatePick(Request $request, $ticket_id){
        //$ticket_id = $request->input('ticket_id');
        $new_client_id = $request->input('new_client_id');
    
        Ticket::where('id', $ticket_id)->update(['client_id'=> $new_client_id]);
    
        return view('user.home');
        
    }

    public function pickUser($id){
        $ticket = Ticket::find($id);
        $user = User::all();
        if(Auth::user()->id == $ticket->user_id || Auth::user()->role == 'admin'){
            return view('user.pick_user') -> with('user', $user) ->with('ticket', $ticket);

        }
        return redirect()->route('user.home');

    }

    public function updateUser(Request $request){
        $ticket_id = $request->input('ticket_id');
        $new_user_id = $request->input('new_user_id');
    
        Ticket::where('id', $ticket_id)->update(['user_id'=> $new_user_id]);
        $ticket = Ticket::all();
        return view('all_tickets')->with('ticket', $ticket);
        
    }*/
}
