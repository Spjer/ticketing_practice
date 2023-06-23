<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreClientRegisterRequest;
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
            return redirect()->route('client.home');
        }

        return redirect()->back();
           
    }

    public function logout() {
        
        Auth::guard('webclient')->logout();
  
        return Redirect()->route('client.login');
    }

    public function registration()
    {
        return view('client.registration');
    }
      
    public function customRegistration(StoreClientRegisterRequest $request)
    {  
        
        //$password = $request->input('password');
        //$client->password = Hash::make($password);
        //Client::query()->create($request->only(['name', 'email', 'phone_number' ]));
        
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

        $data =[
            'subject' => 'TestNotifClient',
            'body' => $client->name,
        ];
        
        //$client->notify( new MailNotification($data));
        Notification::route('mail', $client->email)->notify(new MailNotification($data));

        

        return Redirect()->route('client.login');
    }
    


    // premjestit
    public function getTicket($id){
        if(Auth::user()->id != $id){
            return redirect()->route('client.home');
        }else{
            $client = Client::findOrFail($id);
            return view('client.client_ticket') -> with('client', $client);
        }
        
    }
    
    
}
