<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\User;
use App\Models\comment;
use App\Models\Client;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    //
    public function all_tickets(){
        $ticket = Ticket::all();
        return view('all_tickets')->with('ticket', $ticket);

    }

    public function createTicket($id){
        $client = Client::find($id);
        return view('client.create_ticket') -> with('client', $client);
    }

    public function createTicketUser($id){
        $user = User::find($id);
        return view('user.create_ticket_user') -> with('user', $user);
    }

    public function storeTicket(Request $request)
    {
        /// SJETI se napravit validaciju
        $validateData = $request->validate([
            'tic_name' => ['required', 'max:40'],
            'details' => ['required', 'max:400'],
        ]);
        if(Auth::guard('web')->check()){
            
            $client_id = 1;
            $user_id = $request->input('user_id');
        }else{
            $client_id = $request->input('client_id');
            $user_id = 1;
            
            
        }
       
        $tic_name = $request->input('tic_name');
        $details = $request->input('details');

        $status_id = 1;
       // $user_id = 1;        

        $ticket = new Ticket();
        $ticket->client_id = $client_id;
        $ticket->tic_name = $tic_name;
        $ticket->details = $details;

        $ticket->status_id = $status_id;
        $ticket->user_id = $user_id;
        $ticket->created_at = now();

        $ticket->save();
        if(Auth::guard('web')->check()){
            return redirect()->route('user.my_tickets', $user_id);
        }
        return redirect()->route('client_ticket', $client_id);

    }
    // delete ticket after status set to closed
    public function deleteTicket($id){ //osigurat///////////////////////////////////////////
        if(Auth::guard('webclient')->check() || Auth::guard('web')->check()){
            Ticket::find($id)->delete();
            return redirect()->back();
            

        }
        return redirect()->route('opening');
    }
    
    // take on ticket -> ticket goes to my_tickets
    public function takeTicket($id){
        Ticket::where('id', $id)->update(['user_id'=> Auth::user()->id]);
        return redirect()->route('all_tickets');
    }
    // drop/release ticket -> ticket goes to all_tickets
    public function dropTicket($id){
        Ticket::where('id', $id)->update(['user_id'=> 1]);
        return redirect()->back();
    }

    //nova verzija

    public function pickClient($id){
        $ticket = Ticket::find($id);
        $client = Client::all();

        return view('user.pick_client') -> with('client', $client) ->with('ticket', $ticket);

    }
    public function updatePick(Request $request){
        $ticket_id = $request->input('ticket_id');
        $new_client_id = $request->input('new_client_id');
    
        Ticket::where('id', $ticket_id)->update(['client_id'=> $new_client_id]);
    
        return view('user.home');
        
    }
   
    
   

}
