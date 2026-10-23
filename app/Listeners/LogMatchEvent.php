<?php

namespace App\Listeners;

use App\Events\MatchEventCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class LogMatchEvent
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(MatchEventCreated $event): void
    {
        Log::info('Match event created', [
            'match_event_id' => $event->matchEvent->id,
            'fixture_id' => $event->matchEvent->fixture_id,
            'player_id' => $event->matchEvent->player_id,
            'type' => $event->matchEvent->type,
            'team' => $event->matchEvent->team,
            'minute' => $event->matchEvent->minute,
        ]);
    }
}
