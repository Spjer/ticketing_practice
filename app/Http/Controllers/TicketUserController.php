<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Http\Requests\StoreClientRequest;
use App\Models\User;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class TicketUserController extends Controller
{
    //
    public function edit(Ticket $ticket){ ///pickUser
        $this->authorize('update', $ticket);

        $users = User::all();
        return view('user.pick_user')->with('users', $users)->with('ticket', $ticket);
    }
    
    // assign ticket 
    public function update(Request $request, Ticket $ticket){    
        $this->authorize('updateUser', $ticket);

        $user_id = $request->input('user_id');
        $ticket->update(['user_id'=> $user_id]);
        return redirect()->route('tickets.index');
        
    }

    // release ticket --- koristit update/assign umjesto
    //public function releaseTicket(Ticket $ticket){ 
    //    $this->authorize('update', $ticket);
        
    //    $admin_id = User::select('id')->where('role','admin')->limit(1)->first()->id;
    //    Ticket::where('id', $ticket->id)->update(['user_id'=> $admin_id]);
    //    return redirect()->back();
    //}
}
