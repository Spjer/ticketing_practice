<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UserLoginRequest;
use Hash;
use Session;
use App\Models\User;
use App\Models\Ticket;
use App\Models\Status;
use Notification;
use App\Notifications\MailNotification;
use Illuminate\Support\Facades\Auth;


class UserAuthController extends Controller
{
    //

    public function login()
    {
        return view('user.login');
    } 

    public function customLogin(UserLoginRequest $request)
    {
        
        //logout of client
        if(Auth::guard('webclient')){
            Auth::guard('webclient')->logout();
        }
            
        if(Auth::attempt(
            $request->only(['name', 'password'])
        ))
        {
           
            return redirect()->route('user.home')->with('flash_message', 'Successfully logged in')
            ->with('flash_type', 'alert-success');
        }

        return redirect()->back()->withErrors(['msg' => 'Unsuccessful login attempt']);
        ;
            
    }


    public function logout() {
        //Session::flush();
        
        Auth::logout();
  
        return redirect()
            ->route('user.login');
    }


    public function registration()
    {
        return view('user.registration');
    }
      

    public function customRegistration(StoreUserRequest $request)
    {  
           
        //$data = $request->all();
        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');
        $user = new User();
        $user->name = $name;
        $user->email = $email;
        $user->password = Hash::make($password);
        $user->role = 'agent';
        $user->save();

        //$data =[
        //    'subject' => 'TestNotif',
        //    'body' => 'Your registranion was completed successfully.'
        //];
        //$user->notify( new MailNotification($data));

        //Notification::send($user, new MailNotification($data));
         
        return Redirect()->route('user.login');
    }

    //  user main page
    public function index()
    {
        /*$tickets = Ticket::where('user_id', Auth::user()->id)->get();
        $open = 0; $inProgress = 0; $closed = 0;
        //dd($tickets->status->name);
        foreach($tickets as $ticket){
            if($ticket->status->name == 'Open'){
                $open += 1;
            } else if($ticket->status->name == 'In Progress'){
                $inProgress += 1;
            } else{
                $closed += 1;
            }
        }
        $all_tickets = Ticket::all()->count();
        $all_open = 0; $all_inProgress = 0; $all_closed = 0;
        foreach(Ticket::all() as $ticket){
            if($ticket->status->name == 'Open'){
                $all_open += 1;
            } else if($ticket->status->name == 'In Progress'){
                $all_inProgress += 1;
            } else{
                $all_closed += 1;
            }
        }
        $all_tickets = $all_tickets / User::all()->count();
        $all_open = $all_open / User::all()->count();
        $all_inProgress = $all_inProgress / User::all()->count();
        $all_closed = $all_closed / User::all()->count();*/

        $tickets = Ticket::with('status')->where('user_id', Auth::user()->id)->get();

        $ticketCounts = $tickets->groupBy('status.name')->map->count();
        $open = $ticketCounts->get('Open', 0);
        $inProgress = $ticketCounts->get('In Progress', 0);
        $closed = $ticketCounts->get('Closed', 0);
//dd($closed);
        $tickets_all = Ticket::all();
        $ticketCounts_all = $tickets_all->groupBy('status.name')->map->count();

        $all_tickets = $tickets_all->count();
        $all_open = $ticketCounts_all->get('Open', 0);
        $all_inProgress = $ticketCounts_all->get('In Progress', 0);
        $all_closed = $ticketCounts_all->get('Closed', 0);

        $userCount = User::count();
        $all_tickets = $all_tickets / $userCount;
        $all_open = $all_open / $userCount;
        $all_inProgress = $all_inProgress / $userCount;
        $all_closed = $all_closed / $userCount;
        


        return view('user.home',compact('open', 'inProgress', 'closed', 'all_tickets', 'all_open', 'all_inProgress', 'all_closed'))
            ->with('tickets', $tickets);
    } 

    


}


