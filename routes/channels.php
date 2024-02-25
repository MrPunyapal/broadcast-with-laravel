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

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('test-channel', function () {
    return true;
});

Broadcast::channel('chat', function ($user) {
    return auth()->check();

    // I have just check for auth()
    // you will get id `chatroom/{id}` like this
    // and check if $user->hasChatRoom($id);
});
