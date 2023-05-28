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

class NewOrder implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $category_id,$order_id,$operation,$order;
    public function __construct($category_id,$order_id,$operation,$order)
    {
        $this->category_id = $category_id;
        $this->order_id = $order_id;
        $this->operation = $operation;
        $this->order = $order;
    }

    public function broadcastOn()
    {
        return new Channel('category');
    }
    public function broadcastWith(){
        return ['order_id'=>$this->order_id,'operation'=>$this->operation,
    'order'=>$this->order,'cat_id'=>(string)$this->category_id];
    }
    public function broadcastAs(){
        return 'order';
    }
}
