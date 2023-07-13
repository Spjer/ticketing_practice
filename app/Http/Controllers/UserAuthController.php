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
    //  user main page
    public function index()
    {
        $tickets = Ticket::where('user_id', Auth::user()->id)->get();
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
        //dd($open);
        //$open = $tickets->statuses()->where('name', 'Open')->count();
        //$inProgress = $tickets->statuses()->where('name', 'In Progress')->count();
        //$closed = $tickets->statuses()->where('name', 'Closed')->count();


        return view('user.home',compact('open', 'inProgress', 'closed'))->with('tickets', $tickets);
    } 

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
            ->with('flash_type', 'alert-success');;
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


}


