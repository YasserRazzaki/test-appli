<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class TestEvent implements ShouldBroadcast // <--- Important
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $userId;

    /**
     * Create a new event instance.
     */
    public function __construct($userId) //ajouter au constructeur les paramètres que vous souhaitez envoyer à votre front
    {
        $this->userId = $userId;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     *  @return Array
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('App.Models.User.'.$this->userId)
        ];
    }

    public function broadCastWith()
    {
        return [
            'user' => User::where('id', $this->userId)->first(),
        ];
    }

    public function broadcastAs()
    {
        return 'TestEvent';
    }

}

//@return array<int, \Illuminate\Broadcasting\Channel>