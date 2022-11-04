<?php

namespace App\Listeners;

use App\Events\AdvertDeleted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class RejectOffersNotification
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
     * @param  \App\Events\AdvertDeleted  $event
     * @return void
     */
    public function handle(AdvertDeleted $event)
    {
        // Reject all offers related to the advert if not sold
        if (!$event->advert->sold()) {
            $data = [];
            $data['rejected'] = date('Y-m-d H:i:s');
            foreach ($event->advert->offers as $offer) {
                $offer->update($data);
            }
        }
    }
}
