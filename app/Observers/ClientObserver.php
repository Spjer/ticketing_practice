<?php

namespace App\Observers;

use App\Models\Client;

use App\Notifications\MailNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Mail;


class ClientObserver
{
    /**
     * Handle the Client "created" event.
     */
    public function created(Client $client): void
    {
        //
        $data =[
            'subject' => 'TestNotifClient',
            'body' => $client->name,
        ];
        //Notification::send($client, new MailNotification($data));
        $client->notify( new MailNotification($data));
    }

    /**
     * Handle the Client "updated" event.
     */
    public function updated(Client $client): void
    {
        //
        //$data =[
        //    'subject' => 'AssignedNotif',
        //    'body' => 'You were assigned to ticket: ',
        //];
        //Notification::route('mail', $client->email)->notify(new MailNotification($data));

    }

    /**
     * Handle the Client "deleted" event.
     */
    public function deleted(Client $client): void
    {
        //
    }

    /**
     * Handle the Client "restored" event.
     */
    public function restored(Client $client): void
    {
        //
    }

    /**
     * Handle the Client "force deleted" event.
     */
    public function forceDeleted(Client $client): void
    {
        //
    }
}
