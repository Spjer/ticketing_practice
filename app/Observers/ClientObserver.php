<?php

namespace App\Observers;

use App\Models\Client;

use App\Notifications\MailNotification;
use Illuminate\Support\Facades\Notification;


class ClientObserver
{
    /**
     * Handle the Client "created" event.
     */
    public function created(Client $client): void
    {
        //
        //$this->sendMailable($client, MailNotification::class);

        $data =[
            'subject' => 'TestNotifClient',
            'body' => $client->name,
        ];
        //Notification::send($client, new MailNotification($data));
        Notification::route('mail', $client->email)->notify(new MailNotification($data));
        //$client->notify( new MailNotification($data));
    }

    /**
     * Handle the Client "updated" event.
     */
    public function updated(Client $client): void
    {
        //
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
