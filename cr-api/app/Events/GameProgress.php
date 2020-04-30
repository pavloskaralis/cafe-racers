<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

use App\Game; 

class GameProgress implements ShouldBroacast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $game;

    public function __construct($id)
    {
        $this->game = Game::find($id);
    }

    public function broadcastOn()
    {
        return new Channel('game');
    }
}
