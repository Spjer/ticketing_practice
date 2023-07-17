<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Status;
use App\Models\Ticket;
use App\Notifications\StatusNotification;
use Illuminate\Support\Facades\Auth;

class StatusController extends Controller
{
    //
     // switch status page -> unnecessary
    public function edit(Ticket $ticket){ // param => ticket
   
        $this->authorize('update', $ticket);
        return view('user.edit_status') -> with('ticket', $ticket);
    }

    // store status function
    public function store(Request $request){
        $ticket_id = $request->input('ticket_id');
        $new_status_id = $request->input('new_status_id');

        Ticket::where('id', $ticket_id)->update(['status_id'=> $new_status_id]);
        //return back();
        $ticket = Ticket::where('id', $ticket_id)->first();
        $status = Status::where('id', $new_status_id)->first();
       // dd($status->name);
    
        if($status->name  == 'Closed'){

            
            $data =[
                'name' => $ticket->name,
                'subject' => 'StatusNotif - '. $ticket->name,
                'body' => 'The ticket you sent: #'.$ticket->id. '-'. $ticket->name.', was closed.',
            ];
            //$client = Client::where('id', $ticket->client_id);
            $ticket->client->notify( new StatusNotification($data));
            //$ticket->user->notify( new MailNotification($data));
                
                
                //event(new TicketAssigned($ticket));
        }
        
        return redirect()->route('tickets.show', Auth::user()->id);
    }
}
