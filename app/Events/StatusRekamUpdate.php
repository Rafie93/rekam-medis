<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class StatusRekamUpdate implements ShouldBroadcast
{
	use Dispatchable, InteractsWithSockets, SerializesModels;
    public $user_id;
    public $no_rekam;
	public $message;
    public $link;
    public $created_at;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($user_id,$no_rekam,$message,$link,$created_at)
    {
        $this->user_id = $user_id;
        $this->no_rekam= $no_rekam;
		$this->message  = $message;
        $this->link  = $link;
        $this->created_at  = $created_at;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        // return new Channel('status-rekam-updated');
        return new Channel('status-rekam-updated-'.$this->user_id);
        // return new PrivateChannel('status-rekam-update-'.$this->user_id);
        // return ['status-rekam-updated'];
    }
}
