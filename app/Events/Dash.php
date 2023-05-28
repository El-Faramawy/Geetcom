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
class Dash implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $title;
    public function __construct($title)
    {
        $this->title = $title;
    }

    public function broadcastOn()
    {
        return new Channel('dash');
    }
    public function broadcastWith(){
        return ['dash'=>$this->title];
    }
    public function broadcastAs(){
        return 'dash';
    }
}
