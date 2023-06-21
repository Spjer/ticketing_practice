<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Hash;
use Session;
use App\Models\Client;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Notification;
use App\Notifications\MailNotification;
use App\Models\Announcement;
use Illuminate\Support\Facades\Route;

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

    public function customLogin(Request $request)
    {
        //logout of user
        if(Auth::guard('web')){
            Auth::guard('web')
            ->logout();
        }
        //

        $request->validate([
            'email' => 'required', 'email',
            'password' => 'required', 'min:6',
        ]);

        if(Auth::guard('webclient')
            ->attempt($request->only(['email', 'password'])))
        {
            return redirect()->route('client.home');
        }

        return redirect()
            ->back();
            //->with('error', 'Invalid Credentials');
    }

    public function logout() {
        
        Auth::guard('webclient')
            ->logout();
  
        return Redirect()
            ->route('client.login');
    }

    public function registration()
    {
        return view('client.registration');
    }
      
    public function customRegistration(Request $request)
    {  
        $request->validate([
            'name' => ['required', 'max:30'],
            'email' => ['required', 'email', 'max:40', 'unique:clients,email'],
            'phone_number' =>  ['required', 'min:11', 'max:12', 'regex:/^([0-9]){3}-([0-9]){3}-([0-9])/'],
            'password' => ['required','min:6'],

        ]);
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
        //Notification::send($client, new MailNotification($order));
        //$annoncement = Announcement::create();
        $data =[
            'subject' => 'TestNotif'
        ];
        $client->notify((new MailNotification($data)));

        //Route::get('send', [NotifyController::class, 'send']);

        

        return Redirect()->route('client.login');
        //return Redirect()->route('send');
    }
    


    //mozda premjestit
    public function getTicket($id){
        if(Auth::user()->id != $id){
            return redirect()->route('client.home');
        }else{
            $client = Client::find($id);
            return view('client.client_ticket') -> with('client', $client);
        }
        
    }



   /* public function send() 
    {
    	$client = Client::first();
  
        $project = [
            'greeting' => 'Hi '.$client->name.',',
            'body' => 'This is the project assigned to you.',
            'thanks' => 'Thank you this is from codeanddeploy.com',
            'actionText' => 'View Project',
            'actionURL' => url('/'),
            'id' => 57
        ];
        Notification::send($client, new MailNotification($invoice));
  
        Notification::send($user, new EmailNotification($project));
   
        dd('Notification sent!');
    }*/
    
    
}
