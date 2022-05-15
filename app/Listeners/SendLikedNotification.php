<?php

namespace App\Listeners;

use App\Events\LikedEvent;

class SendLikedNotification
{
    public function __construct() {

    }

    public function handle(LikedEvent $event) {
        $event->post->user->notify(new \App\Notifications\Liked($event->user->username));
    }
}
