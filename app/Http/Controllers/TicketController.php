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
        
        return view('all_tickets')->with('users', $users)->withDetails($tickets)->withQuery ( " " );;   //->with('tickets', $tickets)

    }

    public function createTicket($id){
        $client = Client::find($id);
        return view('client.create_ticket')->with('client', $client);
    }

    public function createTicketUser($id){
        $user = User::find($id);
        if(Auth::user()->id != $id){
            return redirect()->route('user.home');
        }
        return view('user.create_ticket_user')->with('user', $user);
    }


    
    public function store(StoreTicket $request)
    {
        /// SJETI se napravit validaciju
        //$validateData = $request->validate([
        //    'tic_name' => ['required', 'max:40'],
        //    'details' => ['required', 'max:400'],
        //]);
        $ticket = new Ticket();
        if(Auth::guard('web')->check()){
            
            $ticket->client_id = Client::select('id')->where('email','temp.tmp@mail.com')->limit(1)->first()->id;
            $ticket->user_id = $request->input('user_id');
        }else{
            $ticket->client_id = $request->input('client_id');
            $ticket->user_id = User::select('id')->where('role','admin')->limit(1)->first()->id;
            
            
        }
        $ticket->status_id = Status::select('id')->where('name','Open')->limit(1)->first()->id;
        //Ticket::query()->create($request->all());
        $ticket->tic_name = $request->input('tic_name');
        $ticket->details = $request->input('details');
        $ticket->save();
       
        
        if(Auth::guard('web')->check()){
            return redirect()->route('users.edit', $ticket->id);
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
        $admin_id = User::select('id')->where('role','admin')->limit(1)->first()->id;
        if(Auth::user()->id != $tmp->user_id){
            return redirect()->route('user.home');
        }
        Ticket::where('id', $id)->update(['user_id'=> $admin_id]);
        return redirect()->back();
    }

    public function search(Request $request){
        $q = $request->input( 'q' );
        
        //$new_client_id = $request->input('new_client_id')
        $ticket = Ticket::where('tic_name','LIKE','%'.$q.'%')->get(); //->orWhere('client','LIKE','%'.$q.'%')
        if(count($ticket) > 0)
            return view('all_tickets')->withDetails($ticket)->withQuery ( $q );
        else return view ('all_tickets');
    }
    
}
