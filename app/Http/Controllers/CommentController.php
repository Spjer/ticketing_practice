<?php

namespace App\Http\Controllers;
use App\Models\comment;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


use Illuminate\Http\Request;

class CommentController extends Controller
{
    //- 
    // Functions relating to comments 
    // view comments
    public function viewComments($id){
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
        $validateData = $request->validate([
            'ticket_id' => ['required', 'numeric'],
            'comm' =>  ['required', 'max:400'],
        ]);
        $ticket_id = $request->input('ticket_id');
        $comm = $request->input('comm');
        
        $comment= new comment();
        $comment->ticket_id = $ticket_id;
        $comment->comm = $comm;
        $comment->created_at = now();
        $comment->save();

        return redirect()->route('user.my_tickets', [Auth::user()->id]); // vrati na my_tickets

    }

    public function deleteComment($id){
        $comment = comment::find($id);
        $ticket = $comment->all_tickets;
        $comment->delete();

        return redirect()->back();
    }
}
