<?php

namespace App\Events;

use App\Models\Match_events;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MatchEventCreated implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(
        public Match_events $matchEvent
    ) {}

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('fixture.' . $this->matchEvent->fixture_id),
        ];
    }

    public function broadcastAs(): string
    {
        return 'match.event.created';
    }

    public function broadcastWith(): array
    {
        return [
            'id' => $this->matchEvent->id,
            'fixture_id' => $this->matchEvent->fixture_id,
            'type' => $this->matchEvent->type,
            'team' => $this->matchEvent->team,
            'minute' => $this->matchEvent->minute,
            'player' => $this->matchEvent->player
                ? [
                    'id' => $this->matchEvent->player->id,
                    'name' => $this->matchEvent->player->name,
                ]
                : null,
            'related_player' => $this->matchEvent->related_player_id
                ? [
                    'id' => $this->matchEvent->related_player_id,
                    'name' => $this->matchEvent->related_player->name,
                ]
                : null,
        ];
    }
}
