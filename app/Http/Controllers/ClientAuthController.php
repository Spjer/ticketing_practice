<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ClientRegisterRequest;
use App\Http\Requests\ClientLoginRequest;
use Hash;
use Session;
use App\Models\Client;
use App\Models\User;
use Notification;
use App\Notifications\MailNotification;
use Illuminate\Support\Facades\Auth;

class ClientAuthController extends Controller
{
    //
    public function index()
    {
        return view('client.home');
    } 

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
        
        $name = $request->input('name');
        $email = $request->input('email');
        $phone_number = $request->input('phone_number');
        $password = $request->input('password');
        $client = new Client();
        $client->name = $name;
        $client->email = $email;
        $client->phone_number = $phone_number;
        $client->password = Hash::make($password);
        $client->save();

        //$data =[
        //    'subject' => 'TestNotifClient',
        //    'body' => $client->name,
        //];
        
        //$client->notify( new MailNotification($data));
        //Notification::route('mail', $client->email)->notify(new MailNotification($data));

        

        return Redirect()->route('client.login');
    }
    
}
