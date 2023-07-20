<?php

use Illuminate\Support\Facades\Broadcast;
use App\Models\Ticket;
use App\Models\User;
use App\Models\Client;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('App.Models.Client.{id}', function ($client, $id) {
    //return (int) $user->id === (int) $id;
    return (int) $client->id === (int) $id;
    //return true;
},['guards'=>['webclient']]);

Broadcast::channel('users.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
    //return true;
    //return (int) $user->id;
});

Broadcast::channel('assignement.{id}', function ($user, $userId) {
    return (int) $user->id === (int) $userId;
    //return (int) $user->id === (int) $userId;
    //return true;
});


Broadcast::channel('private.chat.{id}', function ($user, $id) {
    //return (int) $user->id === (int) $id;
    return true;
    //return (int) $user->id;
});