<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Status;
use App\Models\Ticket;

class StatusController extends Controller
{
    //
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
