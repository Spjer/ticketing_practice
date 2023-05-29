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
        if(Auth::user()->id == $ticket->user_id){
            return view('user.view_comments')->with('ticket', $ticket);
        }

        return redirect()->route('user.home');
    }

    public function createComment($id){
        $ticket = Ticket::find($id);

        if(Auth::user()->id == $ticket->user_id){
            return view('user.create_comment')->with('ticket', $ticket);
        }

        return redirect()->route('user.home');
    }

    public function storeComment(Request $request)
    {
        /// SJETI se napravit validaciju
        $validateData = $request->validate([
            'ticket_id' => ['required', 'numeric'],
            'comm' =>  ['required', 'max:400'],
        ]);

        comment::query()->create($request->all());
        
        return redirect()->route('user.my_tickets', [Auth::user()->id]); // vrati na my_tickets

    }

    public function deleteComment($id){
        $comment = comment::find($id);
        $ticket = $comment->all_tickets;
        $comment->delete();
        

        return redirect()->back();
    }
}
