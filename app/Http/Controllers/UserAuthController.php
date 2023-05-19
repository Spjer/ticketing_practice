<?php

namespace App\Http\Controllers;
namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Hash;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserAuthController extends Controller
{
    //
    public function index()
    {
        return view('user.home');
    } 

    public function login()
    {
        return view('user.login');
    } 

    public function customLogin(Request $req)
    {
        if(Auth::attempt(
            $req->only(['name', 'password'])
        ))
        {
            return redirect()->route('user.home');
        }

        return redirect()
            ->back()
            ->with('error', 'Invalid Credentials');
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
      
    public function customRegistration(Request $request)
    {  
        $request->validate([
            'name' => ['required', 'unique:users,name'],
            'password' => ['required','min:6'],
        ]);
           
        $data = $request->all();
        $check = $this->create($data);
         
        return Redirect()->route('user.login');
    }

    public function create(array $data)
    {
      return User::create([
        'name' => $data['name'],
        'password' => Hash::make($data['password'])
      ]);
    }

    public function myTickets($id){
        $user = User::find($id);
        return view('user.my_tickets')->with('user', $user);
    }

        // Skratit i mozda premjestit
        public function viewUser(){
            if(Auth::check()){
                if(Auth::user()->id == 1){
                    $user= User::all();
                    return view('user.view_users')->with('user', $user);
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
