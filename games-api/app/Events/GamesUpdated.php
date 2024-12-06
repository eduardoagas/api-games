<?php

namespace App\Events;

use App\Models\Games;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class GamesUpdated implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $games;

    /**
     * Create a new event instance.
     */
    public function __construct()
    {
        $this->games = Games::withCount('users as player_count')->get();
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('games'),
        ];
    }

    public function broadcastWith(): array
    {
        return ['games' => $this->games];
    }
}
