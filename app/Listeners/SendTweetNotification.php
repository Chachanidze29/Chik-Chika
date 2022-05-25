<?php

namespace App\Listeners;

use App\Events\TweetedEvent;
use App\Notifications\Tweeted;
use Illuminate\Support\Facades\Notification;

class SendTweetNotification
{
    public function __construct()
    {
        //
    }

    public function handle(TweetedEvent $event) {
        $username = $event->user->username;
        Notification::send($event->user->followers,new Tweeted($username,$event->postId));
    }
}
