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

class chatReal implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $fId,$uId,$message,$orderId,$status,$id;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($fId,$uId,$message,$orderId,$status,$id)
    {
        $this->fId = $fId;
        $this->uId = $uId;
        $this->message = $message;
        $this->orderId = $orderId;
        $this->status = $status;
        $this->id = $id;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('chat');
    }
    public function broadcastWith(){
        
        return ['user_id'=>$this->uId,'free_id'=>$this->fId,
    'message'=>$this->message,'status'=>$this->status,'id'=>$this->id,
    "order_id"=>(string)$this->orderId
    ];
        //dd(['name'=>'hamza123','id'=>'1']);
    }
    public function broadcastAs(){
        return 's-chat';
    }
}
