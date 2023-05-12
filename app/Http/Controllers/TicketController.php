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
        $validateData = $request->validate([
            'tic_name' => ['required', 'max:40'],
            'details' => ['required', 'max:400'],
            //'status' => ['required', 'max:12']
        ]);
        $client_id = $request->input('client_id');
        $tic_name = $request->input('tic_name');
        $details = $request->input('details');

        //$status = 'open';
        $status_id = 1;
        $user_id = 0;
       // $user_id = $request->input('user_id');
        

        $ticket = new Ticket();
        $ticket->client_id = $client_id;
        $ticket->tic_name = $tic_name;
        $ticket->details = $details;

        //$ticket->status = $status;
        $ticket->status_id = $status_id;
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
    // switch status -> probat nac ljepsi nacin
    public function editStatus($id){
        $ticket = Ticket::find($id);

        return view('user.edit_status') -> with('ticket', $ticket);
    }

    //namjestit store status funkciju
    public function storeStatus(Request $request){
        $ticket_id = $request->input('ticket_id');
        $new_status_id = $request->input('new_status_id');

        Ticket::where('id', $ticket_id)->update(['status_id'=> $new_status_id]);

        return view('user.home');
    }
    
   

}
