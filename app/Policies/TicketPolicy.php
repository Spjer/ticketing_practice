<?php

namespace App\Policies;

use App\Models\Ticket;
use App\Models\User;
use App\Models\ClientS;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

class TicketPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Ticket $ticket): bool
    {
        //
        return $user->id === $ticket->user_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
        return $user->role === 'agent';
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Ticket $ticket): bool
    {
        //
        return $user->id === $ticket->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Ticket $ticket): bool
    {
        //
        return $user->role == 'admin';
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Ticket $ticket): bool
    {
        //
        return $user->role == 'admin';
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Ticket $ticket): bool
    {
        //
        return $user->role == 'admin';
    }

    public function assigned(User $user, $amogus): bool
    {
        //
        return $user->id === $amogus;
        
    }
    public function owned(User $user, Client $client): bool{
        return $user->id === $client->id;
    }
}
