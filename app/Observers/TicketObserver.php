<?php

namespace App\Observers;

use App\Models\Ticket; 
use App\Models\Status;
use App\Models\User;
use App\Events\TicketAssignedUser;
use App\Events\TicketAssigned;
use App\Notifications\MailNotification;
use App\Notifications\AssignedNotification;
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
       
        if($ticket->wasChanged('user_id')){
            $data =[
                'name' => $ticket->name,
                'subject' => 'AssignedNotif - '. $ticket->name,
                'body' => 'You were assigned ticket: #'.$ticket->id. '-'. $ticket->name,
            ];
            $ticket->user->notify( new AssignedNotification($data));
            $ticket->user->notify( new MailNotification($data));
            $user = User::where('id', $ticket->user_id)->first();

            //dd($user);
            
            //event(new TicketAssigned($user));
          }
          

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
