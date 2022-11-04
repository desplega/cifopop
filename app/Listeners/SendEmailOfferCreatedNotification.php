<?php

namespace App\Listeners;

use App\Events\OfferCreated;
use App\Mail\AdvertOfferEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class SendEmailOfferCreatedNotification
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
    public function handle(OfferCreated $event)
    {
        // Get advert user
        $advert_user = User::find($event->offer->advert->user_id);

        // Send email to offer creator
        $msg = new \stdClass();
        $msg->subject = __('New offer created');
        $msg->name = $advert_user->name;
        $msg->email = $advert_user->email;
        $msg->message = __('Advert details') . ': ' . $event->offer->advert->title . ' (' . $event->offer->advert->price . ' €) ---> ';
        $msg->message .= __('Offer amount') . ': ' . str_replace('.', ',', $event->offer->amount) . ' €';

        Mail::to($event->user->email)->send(new AdvertOfferEmail($msg));

        // Send email to advert owner
        $msg->subject = __('Has recibido una oferta');
        $msg->name = $event->user->name;
        $msg->email = $event->user->email;

        Mail::to($advert_user->email)->send(new AdvertOfferEmail($msg));
    }
}
