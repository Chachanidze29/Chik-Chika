<?php

namespace App\Notifications;

use App\Events\Tweeted;

class SendTweetNotification
{
    public function __construct()
    {
        //
    }

    public function handle(Tweeted $event) {

    }
}
