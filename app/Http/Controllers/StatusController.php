<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Status;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;

class StatusController extends Controller
{
    //
     // switch status page -> unnecessary
    public function edit(Ticket $ticket){ // param => ticket
   
        //if(Auth::user()->id != $param->user_id){
            //return redirect()->route('user.home');
        //}
        $this->authorize('update', $ticket);
        return view('user.edit_status') -> with('ticket', $ticket);
    }

    // store status function
    public function store(Request $request){
        $ticket_id = $request->input('ticket_id');
        $new_status_id = $request->input('new_status_id');

        Ticket::where('id', $ticket_id)->update(['status_id'=> $new_status_id]);

        return redirect()->route('tickets.show', Auth::user()->id);
    }
}
