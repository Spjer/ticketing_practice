<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Notifications\AssignedNotification;
use Illuminate\Support\Facades\Notification;

class NotificationController extends Controller
{
    //
    public function update(){
        Auth::user()->unreadNotifications->markAsRead();
        return redirect()->back();
    }

    public function index(){
        
        $user = Auth::user();
        //$notifications = $user->notifications;           
        return view('user.u_notifications')->with('notifications', $user->notifications()->paginate(15));
    }

    public function show( $id){
        
        $notification_show = Auth::user()->notifications->where('id', $id)->first();
        $notification_show->markAsRead();
        $notifications = Auth::user()->notifications()->paginate(15);
        return view('user.show_notifications')->with('notifications', $notifications)->with('notification_show', $notification_show);
    }

    public function destroy( $id){
        $notification = Auth::user()->notifications->where('id', $id)->first();
        $notification->delete();
        return redirect()->route('notifications.index');
    }

    public function indexUnread(){
        
        $user = Auth::user();
        //$notifications = $user->unreadNotifications;
        return view('user.u_notifications')->with('notifications', $user->unreadNotifications()->paginate(15));
    }
}
