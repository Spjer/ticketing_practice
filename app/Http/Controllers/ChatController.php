<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use App\Events\PublicChatMessage;
use App\Events\PrivateChatMessage;
use App\Http\Requests\ChatMessageRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests;


class ChatController extends Controller
{
    public function store(ChatMessageRequest $request){
        //dd($request);
        //$message = Message::query()->create($request->all());  
        //Message::query()->create($request->all());
 
        
        $message = new Message();
        $message->username = $request->input('username');
        $message->reciever_id = $request->input('reciever_id');
        $message->sender_id = $request->input('sender_id');
        $message->body = $request->input('body');
        $message->save();
        event(new PrivateChatMessage($message->reciever_id));


        //event(new PrivateChatMessage($reciever_id));

        //return back();//event(new PublicChatMessage($username, $request->input('message')));
        
    }
    
    public function sendMessage(Request $request){
       
        $username = Auth::user()->name;
    

        event(new PublicChatMessage($username, $request->input('message')));
        
    }

    public function index(){
        return view('user.chat_public')->with('users', User::where('id', '!=', Auth::user()->id)->get());
    }

    public function show($param){
        //$reciever_id = $param;
        //$reciever_name = User::where('id', $reciever_id)->value('name');
        $reciever = User::where('id', $param)->first();
        $sender_id = Auth::user()->id;
        $messages = Message::where('sender_id', $sender_id)->where('reciever_id', $param)->orWhere('sender_id', $param)->where('reciever_id', $sender_id)->get();
        $users = User::where('id', '!=', Auth::user()->id)->get();
        return view('user.chat_show')->with('users', $users)->with('reciever', $reciever)->/*->with('reciever_id', $reciever_id)->with('reciever_name', $reciever_name)->*/with('messages', $messages);
    }

   
}
