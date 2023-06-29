<?php

namespace App\Providers;
use App\Models\Ticket;
use App\Models\User;
use App\Policies\TicketPolicy;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
        Ticket::class => TicketPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
        Gate::define('show-assigned', function (User $user, $user_id) {
            return $user->id === $user_id;
        });
        Gate::define('create-by-user', function (User $user, $user_id) {
            return $user->id === $user_id && ($user->role == 'agent' || $user->role == 'admin');
        });
        Gate::define('create-by-client', function ($client, $client_id) {
            return $client->id === $client_id;
        });
        Gate::define('show-owned', function ($client, $client_id) {
            return $client->id === $client_id;
        });
       
    }
}
