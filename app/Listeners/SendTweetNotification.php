<?php

namespace App\Listeners;

use App\Events\TweetedEvent;
use App\Notifications\Tweeted;
use App\Services\UserService;
use Illuminate\Support\Facades\Notification;

class SendTweetNotification
{
    public function __construct(protected UserService $userService){}

    public function handle(TweetedEvent $event) {
        $user = $this->userService->getUserById($event->user_id);
        Notification::send($user->followers,new Tweeted($user->username,$event->postId));
    }
}
