<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Client;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    //l List of users
    public function index(){  ///viewUser
        
        $this->authorize('viewAny', Ticket::class);
        $user= User::all();
        return view('user.view_users')->with('user', $user);
           
    }
    // As admin assign ticket to agent(user)
    //public function edit(Ticket $ticket){ ///pickUser
    //    $this->authorize('update', Ticket::class);
    //    $users = User::all();
    //    //if(Auth::user()->id == $ticket->user_id || Auth::user()->role == 'admin'){
    //    return view('user.pick_user')->with('users', $users)->with('ticket', $ticket);

        //}
        //return redirect()->route('user.home');

    //}
    //  Store user assigned to ticket (by admin)
    //public function update(Request $request, $ticket_id){  //updateUser
    //    $new_user_id = $request->input('new_user_id');
    
    //    Ticket::where('id', $ticket_id)->update(['user_id'=> $new_user_id]);
    //    $tickets = Ticket::all();
    //    //return view('all_tickets')->with('tickets', $tickets);
    //    return redirect()->route('tickets.index');
    //}
        
    
}
