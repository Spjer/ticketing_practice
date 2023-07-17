<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Notifications\StatusNotification;
use Illuminate\Support\Facades\Notification;

class ClientNotificationController extends Controller
{
    //
    public function update(){
        Auth::user()->unreadNotifications->markAsRead();
        return redirect()->back();
    }

    public function index(){
        
        $client = Auth::user();
      
        //$notifications = $user->notifications;           
        return view('client.u_notifications')->with('notifications', $client->notifications()->paginate(15));
    }

    public function show( $id){
        
        $notification_show = Auth::user()->notifications->where('id', $id)->first();
        $notification_show->markAsRead();
        $notifications = Auth::user()->notifications()->paginate(15);
        return view('client.show_notifications')->with('notifications', $notifications)->with('notification_show', $notification_show);
    }

    public function destroy( $id){
        $notification = Auth::user()->notifications->where('id', $id)->first();
        $notification->delete();
        return redirect()->route('client-notifications.index');
    }

    public function indexUnread(){
        
        $client = Auth::user();
        //$notifications = $user->unreadNotifications;
        return view('client.u_notifications')->with('notifications', $client->unreadNotifications()->paginate(15));
    }
}
