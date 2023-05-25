<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Hash;
use Session;
use App\Models\Client;
use App\Models\User;
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
         
        return Redirect()->route('client.login');
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

   


        // Skratit i mozda premjestit
    public function viewClient(){
        if(Auth::check()){
            if(Auth::user()->role == 'admin'){
                $client= Client::all();
                return view('user.view_clients')->with('client', $client);
            }
            else{
                return view('user.home');
            }
        }
        else{
            return view('opening');
        }

    }
    
    
}
