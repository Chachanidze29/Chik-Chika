<?php

namespace App\Listeners;

use App\Events\TweetedEvent;
use App\Notifications\Tweeted;

class SendTweetNotification
{
    public function __construct()
    {
        //
    }

    public function handle(TweetedEvent $event) {
        $username = $event->user->username;
        foreach ($event->user->followers as $follower) {
            $follower->notify(new Tweeted($username,$event->postId));
        }
    }
}
