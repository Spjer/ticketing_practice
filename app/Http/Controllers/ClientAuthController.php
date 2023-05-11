<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Hash;
use Session;
use App\Models\Client;
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

    public function customLogin(Request $req)
    {
        if(Auth::guard('webclient')
            ->attempt($req->only(['email', 'password'])))
        {
            return redirect()->route('client.home');
        }

        return redirect()
            ->back()
            ->with('error', 'Invalid Credentials');
    }

    public function logout() {
        //Session::flush();
        
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
            'name' => ['required'],
            'email' => ['required'],
            'password' => ['required','min:6'],
        ]);
           
        $data = $request->all();
        $check = $this->create($data);
         
        return Redirect()->route('client.login');
    }

    public function create(array $data)
    {
      return Client::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password'])
      ]);
    }

    //mozda premjestit
    public function getTicket($id){
        $client = Client::find($id);
        return view('client.client_ticket') -> with('client', $client);
    }

    public function createTicket($id){
        $client = Client::find($id);
        return view('client.create_ticket') -> with('client', $client);
    }
    
    
}
