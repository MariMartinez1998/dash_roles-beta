<?php

namespace App\Events;
use App\Models\User;
use App\Models\Blog;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MailBlogRegistroEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $producto;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user,Blog $producto)
    {
        $this->user = $user;
        $this->producto = $producto;
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
