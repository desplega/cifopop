<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Events\AdvertDeleted;
use App\Listeners\RejectOffersNotification;
use App\Events\AdvertCreated;
use App\Listeners\SendEmailAdvertCreatedNotification;
use App\Events\OfferCreated;
use App\Listeners\SendEmailOfferCreatedNotification;

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
        AdvertDeleted::class => [
            RejectOffersNotification::class,
        ],
        AdvertCreated::class => [
            SendEmailAdvertCreatedNotification::class,
        ],
        OfferCreated::class => [
            SendEmailOfferCreatedNotification::class,
        ],
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
