<?php

namespace App\Providers;

use App\Events\CommentedEvent;
use App\Events\FollowedEvent;
use App\Events\LikedEvent;
use App\Events\TweetedEvent;
use App\Events\UnfollowedEvent;
use App\Listeners\SendCommentNotification;
use App\Listeners\SendFollowNotification;
use App\Listeners\SendLikedNotification;
use App\Listeners\SendTweetNotification;
use App\Listeners\SendUnfollowNotificaton;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        FollowedEvent::class => [
            SendFollowNotification::class
        ],
        UnfollowedEvent::class => [
            SendUnfollowNotificaton::class
        ],
        TweetedEvent::class=> [
            SendTweetNotification::class
        ],
        LikedEvent::class => [
            SendLikedNotification::class
        ],
        CommentedEvent::class => [
            SendCommentNotification::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
