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

    public $name;
    /**
     * Create a new event instance.
     */
    public function __construct($name)
    {
        //
        $this->name = $name;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
        new Channel('TicketMessage'/*.$this->ticket_id*/),
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
