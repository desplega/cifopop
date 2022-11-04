<?php

namespace App\Listeners;

use App\Events\AdvertCreated;
use App\Mail\AdvertOfferEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendEmailAdvertCreatedNotification
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
     * @param  \App\Events\AdvertCreated  $event
     * @return void
     */
    public function handle(AdvertCreated $event)
    {
        $msg = new \stdClass();
        $msg->name = $event->user->name;
        $msg->subject = __('New advert created');
        $msg->email = $event->user->email;
        $msg->message = __('Advert title') . ': ' . $event->advert->title;

        Mail::to($event->user->email)->send(new AdvertOfferEmail($msg));
    }
}
