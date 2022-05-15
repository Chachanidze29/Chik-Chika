<?php

namespace App\Listeners;

use App\Events\FollowedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendFollowNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(FollowedEvent $event)
    {
        $event->user->notify(new \App\Notifications\Followed($event->username));
    }
}
