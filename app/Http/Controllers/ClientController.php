<?php

namespace App\Http\Controllers;
use App\Models\Client;
use App\Models\Ticket;

use Illuminate\Http\Request;

class ClientController extends Controller
{
    //

    public function createClient($id){
        $ticket = Ticket::find($id);

        return view('user.create_client')->with('ticket', $ticket);
    }

    public function storeClient(Request $request)
    {
        /// SJETI se napravit validaciju
        $validateData = $request->validate([
            'ticket_id' => ['required', 'numeric'],
            'name' =>  ['required', 'max:30'],
            'email' =>  ['required',  'email', 'max:40'],
            'phone_number' =>  ['required','numeric', 'digits:10'],
        ]);
        $ticket_id = $request->input('ticket_id');
        $name = $request ->input('name');
        $email = $request->input('email');
        $phone_number = $request->input('phone_number');

        
        $client= new Client();
        $client->ticket_id = $ticket_id;
        $client->name = $name;
        $client->email = $email;
        $client->phone_number = $phone_number;
        $client->save();
        return redirect()->route('user.home'); // probat namjestit da vrati na my_tickets

    }
}
