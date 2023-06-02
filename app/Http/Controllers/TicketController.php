<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\User;
use App\Models\comment;
use App\Models\Client;
use App\Models\Status;
use Illuminate\Support\Facades\Auth;
use DB;

class TicketController extends Controller
{
    // all_tickets
    public function index(){
        $ticket = Ticket::all();
        $user = User::all();
        
        return view('all_tickets')->with('user', $user)->with('ticket', $ticket);

    }

    public function createTicket($id){
        $client = Client::find($id);
        return view('client.create_ticket') -> with('client', $client);
    }

    public function createTicketUser($id){
        $user = User::find($id);
        if(Auth::user()->id != $id){
            return redirect()->route('user.home');
        }
        return view('user.create_ticket_user') -> with('user', $user);
    }

    public function store(Request $request)
    {
        /// SJETI se napravit validaciju
        $validateData = $request->validate([
            'tic_name' => ['required', 'max:40'],
            'details' => ['required', 'max:400'],
        ]);
        $ticket = new Ticket();
        //// TREBA RAZRADIT DA NISU NAMJESTENI BROJEVI////////////////////////////////
        if(Auth::guard('web')->check()){
            
            $ticket->client_id = Client::select('id')->where('email','temp.tmp@mail.com')->limit(1)->first()->id;
            $ticket->user_id = $request->input('user_id');
        }else{
            $ticket->client_id = $request->input('client_id');
            $ticket->user_id = User::select('id')->where('role','admin')->limit(1)->first()->id;
            
            
        }
        $ticket->status_id = Status::select('id')->where('status','Open')->limit(1)->first()->id;

        //Ticket::query()->create($request->all());
        
        $ticket->tic_name = $request->input('tic_name');
        $ticket->details = $request->input('details');
        $ticket->save();
       
        
        if(Auth::guard('web')->check()){
            return redirect()->route('pick_client', $ticket->id);
        }
        $client_id = $request->input('client_id');
        return redirect()->route('client_ticket', $client_id);

    }


    // delete ticket after status set to closed   // deleteTicket
    public function deleteTicket($id){ //osigurat///////////////////////////////////////////
        if(Auth::guard('webclient')->check() || Auth::guard('web')->check()){
            Ticket::find($id)->delete();
            return redirect()->back();
            

        }
        return redirect()->route('opening');
    }

        // My_Tickets
    public function show($id){
        if(Auth::user()->id != $id){
            return redirect()->route('user.home');
        }else{
            $user = User::find($id);
        return view('user.my_tickets')->with('user', $user);
        }
        
    }
    
    // take on ticket -> ticket goes to my_tickets
    public function takeTicket($id){
        Ticket::where('id', $id)->update(['user_id'=> Auth::user()->id]);
        return redirect()->route('tickets.index');
    }
    // drop/release ticket -> ticket goes to all_tickets/tickets.index
    public function dropTicket($id){
        $tmp= Ticket::find($id);
        if(Auth::user()->id != $tmp->user_id){
            return redirect()->route('user.home');
        }
        Ticket::where('id', $id)->update(['user_id'=> 1]);
        return redirect()->back();
    }

    //nova verzija

    public function pickClient($id){
        $ticket = Ticket::find($id);
        $client = Client::all();
        if(Auth::user()->id == $ticket->user_id || Auth::user()->role == 'admin'){
            return view('user.pick_client') -> with('client', $client) ->with('ticket', $ticket);

        }
        return redirect()->route('user.home');

    }
    public function updatePick(Request $request){
        $ticket_id = $request->input('ticket_id');
        $new_client_id = $request->input('new_client_id');
    
        Ticket::where('id', $ticket_id)->update(['client_id'=> $new_client_id]);
    
        return view('user.home');
        
    }

    public function pickUser($id){
        $ticket = Ticket::find($id);
        $user = User::all();
        if(Auth::user()->id == $ticket->user_id || Auth::user()->role == 'admin'){
            return view('user.pick_user') -> with('user', $user) ->with('ticket', $ticket);

        }
        return redirect()->route('user.home');

    }

    public function updateUser(Request $request){
        $ticket_id = $request->input('ticket_id');
        $new_user_id = $request->input('new_user_id');
    
        Ticket::where('id', $ticket_id)->update(['user_id'=> $new_user_id]);
        $ticket = Ticket::all();
        return view('all_tickets')->with('ticket', $ticket);
        
    }
   
    
   

}
