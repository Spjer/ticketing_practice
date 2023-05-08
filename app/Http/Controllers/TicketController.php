<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\User;
use App\Models\comment;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    //
    public function all_tickets(){
        $ticket = Ticket::all();
        return view('all_tickets')->with('ticket', $ticket);

    }

    public function storeTicket(Request $request)
    {
        /// SJETI se napravit validaciju
        $client_id = $request->input('client_id');
        $tic_name = $request->input('tic_name');
        $details = $request->input('details');

        $status = 'open';
        $user_id = 0;
       // $user_id = $request->input('user_id');
        

        $ticket = new Ticket();
        $ticket->client_id = $client_id;
        $ticket->tic_name = $tic_name;
        $ticket->details = $details;

        $ticket->status = $status;
        $ticket->user_id = $user_id;
        $ticket->save();
        return redirect()->route('client.home');

    }
    
    // take on ticket -> ticket goes to my_tickets
    public function takeTicket($id){
        //Ticket::find($id)->user_id = Auth::user()->id;
        Ticket::where('id', $id)->update(['user_id'=> Auth::user()->id]);
        return redirect()->route('all_tickets');
    }
    // drop/release ticket -> ticket goes to all_tickets
    public function dropTicket($id){
        //Ticket::find($id)->user_id = Auth::user()->id;
        Ticket::where('id', $id)->update(['user_id'=> 0]);
        return redirect()->back();
    }

    // view comments
    public function viewComments($id){
        $ticket = Ticket::find($id);

        return view('user.view_comments')->with('ticket', $ticket);
    }
}
