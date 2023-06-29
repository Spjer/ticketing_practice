<?php

namespace App\Http\Controllers;
use App\Models\Comment;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


use Illuminate\Http\Request;
use App\Http\Requests\StoreCommentRequest;

class CommentController extends Controller
{
    //- 
    // Functions relating to comments 
    // view comments
    public function show(Ticket $param){ // param ==> ticket u ovom slucaju, zbog resourcea
        $this->authorize('view', $param);
        return view('user.view_comments')->with('ticket', $param);
        
    }
    
    // Store comment //create comment removed
    public function store(StoreCommentRequest $request)
    {

        Comment::query()->create($request->all());
        
        return redirect()->back();  // vrati na my_tickets

    }

    public function destroy(Comment $param){ //deleteComment // param => comment
       
        $ticket = $param->all_tickets;
        $param->delete();
        
        return redirect()->back();
    }

    /*
     public function show($id){
        
        $ticket = Ticket::findOrFail($id);
        if(Auth::user()->id == $ticket->user_id){
            return view('user.view_comments')->with('ticket', $ticket);
        }

        return redirect()->route('user.home');
    }
    */

    /*public function createComment($id){
        $ticket = Ticket::find($id);

        if(Auth::user()->id == $ticket->user_id){
            return view('user.create_comment')->with('ticket', $ticket);
        }

        return redirect()->route('user.home');
    }*/
}
