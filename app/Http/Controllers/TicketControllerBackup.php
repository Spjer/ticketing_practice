<?php

namespace App\Http\Controllers;
use App\Http\Requests;

use Illuminate\Http\Request;
use App\Http\Requests\StoreTicket;
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
        
        return view('all_tickets')->with('users', $users)->withDetails($tickets)->withQuery ( " " );   

    }

    public function createTicket(Client $client){ 
        //$client = Client::findOrFail($id);
        return view('client.create_ticket')->with('client', $client);
    }

    public function createTicketUser(User $user){ 
        //$user = User::findOrFail($id);
        if(Auth::user()->id != $user->id){
            return redirect()->route('user.home');
        }
        return view('user.create_ticket_user')->with('user', $user);
    }


    
    public function store(StoreTicket $request)
    {

        Ticket::query()->create($request->validated());
        $ticket = new Ticket();
        
        $ticket->status_id = Status::query()->where('name','Open')->get()->id;
        
       
        if(Auth::guard('web')->check()){
            return redirect()->route('clients.edit', $ticket->id);
        }
        $client_id = $request->input('client_id');
        return redirect()->route('client_ticket', $client_id);

    }


    // delete ticket after status set to closed   // Nije koristeno
    /*public function delete($id){ //osigurat/////////////////////////////////////////// /////deleteTicket
        if(Auth::guard('webclient')->check() || Auth::guard('web')->check()){
            Ticket::find($id)->delete();
            return redirect()->back();
            

        }
        return redirect()->route('opening');
    }*/

        // My_Tickets
    public function show(User $user){ 
        if(Auth::user()->id != $user->id){
            return redirect()->route('user.home');
        }else{
            //$user = User::findOrFail($id);
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
        $name = $request->input('name'); 
        
        $tickets = Ticket::where('name','LIKE','%'.$name.'%')->get(); //->orWhere('client','LIKE','%'.$q.'%')
        
        return view('all_tickets', $tickets);
    }

    public function getTicket($id){
        if(Auth::user()->id != $id){
            return redirect()->route('client.home');
        }else{
            $client = Client::findOrFail($id);
            return view('client.client_ticket') -> with('client', $client);
        }
        
    }
    
}
