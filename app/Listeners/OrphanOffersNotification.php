<?php

namespace App\Listeners;

use App\Events\AdvertPurged;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class OrphanOffersNotification
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
     * @param  \App\Events\AdvertPurged  $event
     * @return void
     */
    public function handle(AdvertPurged $event)
    {
        $data = [];
        $data['advert_id'] = 0;
        foreach ($event->advert->offers as $offer) {
            $offer->delete();
        }
    }
}
