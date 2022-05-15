<?php

namespace App\Providers;

use App\Events\Followed;
use App\Events\Liked;
use App\Events\Tweeted;
use App\Events\Unfollowed;
use App\Listeners\SendFollowNotification;
use App\Listeners\SendUnfollowNotificaton;
use App\Notifications\SendLikedNotification;
use App\Notifications\SendTweetNotification;
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
        Followed::class => [
            SendFollowNotification::class
        ],
        Unfollowed::class => [
            SendUnfollowNotificaton::class
        ],
        Tweeted::class=> [
            SendTweetNotification::class
        ],
        Liked::class => [
            SendLikedNotification::class
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
