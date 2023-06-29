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
        //$tickets = Ticket::all();
        //if(request('name')){
        //    $tickets = Ticket::where('name','LIKE','%'. request('name') .'%')->get();
        //}
        //dd(request('name'));
        return view('all_tickets')->with('tickets', Ticket::latest()->filter(request(['name']))->get());   

    }

    public function createTicket(Client $client){ 
        if ( !Gate::allows('create-by-client', $client->id)) {
            abort(403);
        }
        return view('client.create_ticket')->with('client', $client);
    }

    public function create(User $user){ 
        //if(Auth::user()->id != $user->id){
        //    return redirect()->route('user.home');    
        //}
        if (! Gate::allows('create-by-user', $user->id)) {
            abort(403);
        }
        $clients = Client::all();
        return view('user.create_ticket_user')->with('user', $user)->with('clients', $clients);
    }
    
    public function store(StoreTicketRequest $request)
    {
        $ticket = Ticket::query()->create($request->validated());   
        //$ticket = new Ticket();
        //$ticket->client_id = $request->input('client_id');
        //$ticket->user_id = $request->input('user_id');

        //$ticket->status_id = Status::select('id')->where('name','Open')->limit(1)->first()->id;
        //Ticket::query()->create($request->all());
        //$ticket->name = $request->input('name');
        //$ticket->details = $request->input('details');
        //$ticket->save();
       
        if(Auth::guard('web')->check()){
            return redirect()->route('tickets.show', $ticket->user_id);
        }
        return redirect()->route('client-ticket', $ticket->client_id);

    }

        // My_Tickets
    public function show(User $user){ 
        if (! Gate::allows('show-assigned', $user->id)) {
            abort(403);
        }
        return view('user.my_tickets')->with('user', $user);
    }
    
    // take on ticket -> ticket goes to my_tickets
    public function assignTicket(Ticket $ticket){    
        $ticket->update(['user_id'=> Auth::user()->id]);
        return redirect()->route('tickets.index');
    }

    // drop/release ticket -> ticket goes to all_tickets/tickets.index
    public function releaseTicket(Ticket $ticket){ 
        $this->authorize('update', $ticket);
        $admin_id = User::select('id')->where('role','admin')->limit(1)->first()->id;
        Ticket::where('id', $ticket->id)->update(['user_id'=> $admin_id]);
        return redirect()->back();
    }

    public function ownedTickets(Client $client){
        //dd(Auth::user()->id);
        if (! Gate::allows('show-owned', $client->id)) {
            abort(403);
        }
        //if(Auth::user()->id != $client->id){
        //    return redirect()->route('client.home');
        //}else{
        $tickets = Ticket::where('client_id', $client->id)->get();
        return view('client.client_ticket') -> with('tickets', $tickets);
        //}
        

        
    }

    /*public function create($id){ 
        //if(Auth::user()->id != $user->id){
        //    return redirect()->route('user.home');    
        //}
        if(Auth::guard('webclient')->check()){
            $client = Client::findOrFail($id);
            if ( Gate::allows('create-by-client', $client->id)) {
                return view('client.create-ticket')->with('client', $client);
            }
        }
        else if(Auth::guard('web')->check()){
            $user = User::findOrFail($id);
            if ( Gate::allows('create-by-user', $user->id)) {
                $clients = Client::all();
                return view('user.create_ticket_user')->with('user', $user)->with('clients', $clients);
            }
        }
        //$clients = Client::all();
        //return view('user.create_ticket_user')->with('user', $user)->with('clients', $clients); 
        abort(403);
    }*/
    
}
