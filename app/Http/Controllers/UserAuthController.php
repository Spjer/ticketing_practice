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
    //  user main page
    public function index()
    {
        return view('user.home');
    } 

    public function login()
    {
        return view('user.login');
    } 

    public function customLogin(Request $request)
    {
        //logout of client
        if(Auth::guard('webclient')){
            Auth::guard('webclient')
            ->logout();
        }
        //
        $request->validate([
            'name' => 'required',
            'password' => 'required', 'min:6',
        ]);
            
        if(Auth::attempt(
            $request->only(['name', 'password'])
        ))
        {
            return redirect()->route('user.home');
        }

        return redirect()
            ->back();
            //->with('error', 'Invalid Credentials');
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
           
        //$data = $request->all();
        $name = $request->input('name');
        $password = $request->input('password');
        $user = new User();
        $user->name = $name;
        $user->password = Hash::make($password);
        $user->role = 'agent';
        $user->save();

        //$check = $this->create($data);
         
        return Redirect()->route('user.login');
    }


}
