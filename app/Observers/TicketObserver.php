<?php

namespace App\Observers;

use App\Models\Ticket;
use App\Models\Status;
use App\Notifications\MailNotification;
use Illuminate\Support\Facades\Notification;

class TicketObserver
{
    /**
     * Handle the Ticket "created" event.
     */
    public function creating(Ticket $ticket): void
    {
        //
        $status_id = Status::select('id')->where('name','Open')->first()->id;
        $ticket->status_id = $status_id;
    }

    /**
     * Handle the Ticket "updated" event.
     */
    public function updated(Ticket $ticket): void
    {
        //
        $data =[
            'subject' => 'AssignedNotif',
            'body' => 'You were assigned ticket: #'.$ticket->id. '-'. $ticket->name,
        ];
        $ticket->user->notify( new MailNotification($data));
        

    }

    /**
     * Handle the Ticket "deleted" event.
     */
    public function deleted(Ticket $ticket): void
    {
        //
    }

    /**
     * Handle the Ticket "restored" event.
     */
    public function restored(Ticket $ticket): void
    {
        //
    }

    /**
     * Handle the Ticket "force deleted" event.
     */
    public function forceDeleted(Ticket $ticket): void
    {
        //
    }
}
