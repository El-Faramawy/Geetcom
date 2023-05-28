<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
class NewOffer implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $order_id,$offer;
    public function __construct($order_id,$offer)
    {
        $this->order_id = $order_id;
        $this->offer = $offer;
    }

    public function broadcastOn()
    {
        return new Channel('order_'.(string)$this->order_id);
    }
    public function broadcastWith(){
        return ['order_id'=>$this->order_id,
    'offer'=>$this->offer];
    }
    public function broadcastAs(){
        return 'offer';
    }
}
