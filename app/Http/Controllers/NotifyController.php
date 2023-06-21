<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use Notification;
use App\Notifications\MailNotification;
use Illuminate\Notifications\Notifiable;

class NotifyController extends Controller
{
    public function store(Request $request){

    }
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $client->notify(new MailNotification($announcement));
    }
    public function send(){
        $client = Client::first();
        $data =[
            'subject' => 'TestNotif'
        ];
        $client->notify( new MailNotification($data));
    }
}
