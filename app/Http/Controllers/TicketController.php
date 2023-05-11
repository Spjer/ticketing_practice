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
        $user = User::find($id);
        return view('user.create_ticket') -> with('user', $user);
    }

    public function storeTicket(Request $request)
    {
        /// SJETI se napravit validaciju
        $validateData = $request->validate([
            'tic_name' => ['required', 'max:40'],
            'details' => ['required', 'max:400'],
            'status' => ['required', 'max:12']
        ]);
        $user_id = $request->input('user_id');
        $tic_name = $request->input('tic_name');
        $details = $request->input('details');

        //$status_id = '1';
        $status = 'Open';
       // $user_id = $request->input('user_id');
        

        $ticket = new Ticket();
        $ticket->user_id = $user_id;
        $ticket->tic_name = $tic_name;
        $ticket->details = $details;

       // $ticket->status_id = $status_id;
        $ticket->status = $status;
        $ticket->save();
        return redirect()->route('user.home');

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





    // Functions relating to comments - nesto bi mogao premjestit u CommmentController
    // view comments
    /*public function viewComments($id){
        $ticket = Ticket::find($id);

        return view('user.view_comments')->with('ticket', $ticket);
    }

    public function createComment($id){
        $ticket = Ticket::find($id);

        return view('user.create_comment')->with('ticket', $ticket);
    }

    public function storeComment(Request $request)
    {
        /// SJETI se napravit validaciju
        $ticket_id = $request->input('ticket_id');
        $comm = $request->input('comm');
        
        $comment= new comment();
        $comment->ticket_id = $ticket_id;
        $comment->comm = $comm;
        $comment->save();
        return redirect()->route('user.home'); // probat namjestit da vrati na my_tickets

    }

    public function deleteComment($id){
        $comment = comment::find($id);
        $ticket = $comment->all_tickets;
        $comment->delete();

        return redirect()->back();
    }*/
}
