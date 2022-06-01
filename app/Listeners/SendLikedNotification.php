<?php

namespace App\Listeners;

use App\Events\LikedEvent;
use App\Notifications\Liked;

class SendLikedNotification
{
    public function __construct() {}

    public function handle(LikedEvent $event) {
        $event->post->user->notify(new Liked($event->user->username,$event->post->id));
    }
}
