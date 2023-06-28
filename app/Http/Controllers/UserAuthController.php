<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UserLoginRequest;
use Hash;
use Session;
use App\Models\User;
use Notification;
use App\Notifications\MailNotification;
use Illuminate\Support\Facades\Auth;


class UserAuthController extends Controller
{
    //
    //  user main page
    public function index()
    {
        return view('user.home');
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
            return redirect()->route('user.home');
        }

        return redirect()->back();
            
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


/*
use Notification;
use App\Notifications\MailNotification;
//use App\Models\Announcement;
use Illuminate\Support\Facades\Route;*/
 //Notification::send($client, new MailNotification($order));

        //Route::get('send', [NotifyController::class, 'send']);