<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Ticket;
use App\Models\User;

class TicketAssignedUser implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user_id;
    /**
     * Create a new event instance.
     */
    public function __construct($user_id)
    {
        //
        $this->user_id = $user_id;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return  \Illuminate\Broadcasting\PrivateChannel
     */
    public function broadcastOn(): array
    {
        return [
        //new Channel('TicketMessage'/*.$this->ticket_id*/),
        new PrivateChannel('TicketMessage.'.$this->$user_id),
        ];
    }

    /**
     * Broadcast event ticket assigned to user.
     *
     * @return void
     */
    public function broadcastAs()
    {
        return 'assigned-ticket';
    }
}
