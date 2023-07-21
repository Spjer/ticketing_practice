<?php

namespace App\Observers;

use App\Models\User;
use App\Notifications\MailNotification;
use Illuminate\Support\Facades\Notification;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        //
        $data =[
            'subject' => 'Agent Registration',
            'body' => 'Your registranion was completed successfully.',
        ];
        $user->notify( new MailNotification($data));
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void7
    {
        //
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        //
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
