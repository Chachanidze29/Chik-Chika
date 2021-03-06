<?php

namespace App\Listeners;

use App\Events\UnfollowedEvent;
use App\Notifications\Unfollowed;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendUnfollowNotificaton
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
    public function handle(UnfollowedEvent $event)
    {
        $event->user->notify(new Unfollowed($event->username));
    }
}
