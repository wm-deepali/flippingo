<?php

use Illuminate\Support\Facades\Broadcast;

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


Broadcast::routes(['middleware' => ['web', 'auth:customer']]); // customer guard

Broadcast::channel('chat.{type}.{id}', function ($user, $type, $id) {
    // Auth logic
    if (auth('customer')->check()) {
        return auth('customer')->id() == $id;
    }
    if (auth()->check()) { // admin
        return true;
    }
    return false;
});



Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
