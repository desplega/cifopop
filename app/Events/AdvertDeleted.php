<?php

namespace App\Events;

use App\Models\Advert;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AdvertDeleted
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $advert;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Advert $advert)
    {
        $this->advert = $advert;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}