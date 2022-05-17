<?php

namespace App\Listeners;

use App\Events\CommentedEvent;
use App\Notifications\Commented;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendCommentNotification
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
    public function handle(CommentedEvent $event)
    {
        $event->user->notify(new Commented($event->user->username,$event->postId,$event->commentId));
    }
}
