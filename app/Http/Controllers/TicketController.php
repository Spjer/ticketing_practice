<?php

namespace App\Http\Controllers;
use App\Http\Requests;

use Illuminate\Http\Request;
use App\Http\Requests\StoreTicketRequest;
use App\Models\Ticket;
use App\Models\User;
use App\Models\Comment;
use App\Models\Client;
use App\Models\Status;
use Illuminate\Support\Facades\Auth;

use DB;


class TicketController extends Controller
{
    // all_tickets
    public function index(){
        $tickets = Ticket::all();
        $users = User::all();
        
        return view('all_tickets')->with('users', $users)->withDetails($tickets);   

    }

    public function createTicket(Client $client){ 
        
        return view('client.create_ticket')->with('client', $client);
    }

    public function createTicketUser(User $user){ 
        if(Auth::user()->id != $user->id){
            return redirect()->route('user.home');
        }
        return view('user.create_ticket_user')->with('user', $user);
    }


    
    public function store(StoreTicketRequest $request)
    {
        $ticket = Ticket::query()->create($request->all());
        //$ticket = new Ticket();
        //$ticket->client_id = $request->input('client_id');
        //$ticket->user_id = $request->input('user_id');

        //$ticket->status_id = Status::select('id')->where('name','Open')->limit(1)->first()->id;
        //Ticket::query()->create($request->all());
        //$ticket->name = $request->input('name');
        //$ticket->details = $request->input('details');
        //$ticket->save();
       
        if(Auth::guard('web')->check()){
            return redirect()->route('clients.edit', $ticket->id);
        }
        return redirect()->route('client_ticket', $ticket->client_id);

    }

        // My_Tickets
    public function show(User $user){ 
        if(Auth::user()->id != $user->id){
            return redirect()->route('user.home');
        }else{
            return view('user.my_tickets')->with('user', $user);
        }
        
    }
    
    // take on ticket -> ticket goes to my_tickets
    public function takeTicket($id){    
        Ticket::where('id', $id)->update(['user_id'=> Auth::user()->id]);
        return redirect()->route('tickets.index');
    }

    // drop/release ticket -> ticket goes to all_tickets/tickets.index
    public function dropTicket(Ticket $ticket){ 
        
        $admin_id = User::select('id')->where('role','admin')->limit(1)->first()->id;
        if(Auth::user()->id != $ticket->user_id){
            return redirect()->route('user.home');
        }
        Ticket::where('id', $ticket->id)->update(['user_id'=> $admin_id]);
        return redirect()->back();
    }

    public function search(Request $request){
        $name = $request->input( 'name' );
        
        $ticket = Ticket::where('name','LIKE','%'.$name.'%')->get(); 
        if(count($ticket) > 0)
            return view('all_tickets')->withDetails($ticket);
        else return view ('all_tickets');
    }

    public function getTicket(Client $client){
        if(Auth::user()->id != $client->id){
            return redirect()->route('client.home');
        }else{
            //$client = Client::findOrFail($id);
            return view('client.client_ticket') -> with('client', $client);
        }
        
    }
    
}
