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
use Illuminate\Support\Facades\Gate;

use DB;


class TicketController extends Controller
{
    // all_tickets
    public function index(){
        
        return view('all_tickets')->with('tickets', Ticket::latest()->filter(request(['name']))->get());   

    }

    public function create(){ 
        $clients = Client::all();
        return view('user.create_ticket_user')->with('user', Auth::user())->with('clients', $clients);
    }
    
    public function store(StoreTicketRequest $request)
    {
        $ticket = Ticket::query()->create($request->validated());   
       
       
        if(Auth::guard('web')->check()){
            return redirect()->route('tickets.show', $ticket->user_id);
        }
        return redirect()->route('ticket-clients.show', $ticket->client_id);

    }

        // My_Tickets
    public function show(User $param){ 
        if (! Gate::allows('show-assigned', $param->id)) {
            abort(403);
        }
        return view('user.my_tickets')->with('user', $param);
    }

    //public function edit(Ticket $param){ ///pickUser
    //    $this->authorize('update', $param);

    //    $users = User::all();
    //    return view('user.pick_user')->with('users', $users)->with('ticket', $param);

       
    //}
    
    // take on ticket -> ticket goes to my_tickets
    /*public function assignTicket(Request $request, Ticket $ticket){    
        $this->authorize('update', $ticket);

        $user_id = $request->input('user_id');
        $ticket->update(['user_id'=> $user_id]);
        return redirect()->route('tickets.index');
        
    }

    // drop/release ticket -> ticket goes to all_tickets/tickets.index
    public function releaseTicket(Ticket $ticket){ 
        $this->authorize('update', $ticket);

        $admin_id = User::select('id')->where('role','admin')->limit(1)->first()->id;
        Ticket::where('id', $ticket->id)->update(['user_id'=> $admin_id]);
        return redirect()->back();
    }*/


   
     
    
}
