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
    public function markAsRead(){
        Auth::user()->unreadNotifications->markAsRead();
        return redirect()->back();
    }

    public function index(){
        //$notifications = Notifications::all();
        //dd($notifications);
        $user = Auth::user();
        //dd($user);
        $notifications = $user->notifications;
        //dd($notifications);
        return view('user.u_notifications')->with('notifications', $notifications);
    }
    public function show( $id){
        
        $notification_show = Auth::user()->notifications->where('id', $id)->first();
        $notification_show->markAsRead();
        $notifications = Auth::user()->notifications;
        //dd($notification_show);
        return view('user.show_notifications')->with('notifications', $notifications)->with('notification_show', $notification_show);
    }

    public function destroy( $id){
        $notification = Auth::user()->notifications->where('id', $id)->first();

        //dd($notification);
        $notification->delete();
        
        //dd($notification_show);
        return redirect()->route('notifications.index');
    }
}
