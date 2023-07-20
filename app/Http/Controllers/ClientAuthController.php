<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ClientRegisterRequest;
use App\Http\Requests\ClientLoginRequest;
use Hash;
use Session;
use App\Models\Client;
use App\Models\User;
use App\Models\Ticket;
use Notification;
use App\Notifications\MailNotification;
use Illuminate\Support\Facades\Auth;

class ClientAuthController extends Controller
{
    //
    

    public function login()
    {
        return view('client.login');
    } 

    public function customLogin(ClientLoginRequest $request)
    {
        //logout of user
        if(Auth::guard('web')){
            Auth::guard('web')
            ->logout();
        }

        $request->validate([
            'email' => 'required', 'email',
            'password' => 'required', 'min:6',
        ]);

        

        if(Auth::guard('webclient')
            ->attempt($request->only(['email', 'password'])))
        {
            return redirect()->route('client.home')->with('flash_message', 'Successfully logged in')
            ->with('flash_type', 'alert-success');
        }

        return redirect()->back()->withErrors(['msg' => 'Unsuccessful login attempt']);
           
    }

    public function logout() {
        
        Auth::guard('webclient')->logout();
  
        return Redirect()->route('client.login');
    }

    public function registration()
    {
        return view('client.registration');
    }
      
    public function customRegistration(ClientRegisterRequest $request)
    {  
        
        //$name = $request->input('name');
        //$email = $request->input('email');
        //$phone_number = $request->input('phone_number');
        //$password = $request->input('password');
        $client = new Client();
        $client->name = $request->input('name');
        $client->email = $request->input('email');
        $client->phone_number = $request->input('phone_number');
        $client->password = Hash::make($request->input('password'));
        $client->save();

        //$data =[
        //    'subject' => 'TestNotifClient',
        //    'body' => $client->name,
        //];
        
        //$client->notify( new MailNotification($data));
        //Notification::route('mail', $client->email)->notify(new MailNotification($data));

        

        return Redirect()->route('client.login');
    }

    public function index()
    {
        //return view('client.home');

        $tickets = Ticket::with('status')->where('client_id', Auth::user()->id)->get();

        $ticketCounts = $tickets->groupBy('status.name')->map->count();
        $open = $ticketCounts->get('Open', 0);
        $inProgress = $ticketCounts->get('In Progress', 0);
        $closed = $ticketCounts->get('Closed', 0);
//dd($closed);
        return view('client.home',compact('open', 'inProgress', 'closed', 'ticketCounts'));
    } 
    
}
