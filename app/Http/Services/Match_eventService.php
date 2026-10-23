<?php

namespace App\Http\Services;

use App\Events\MatchEventCreated;
use App\Models\Fixture;
use Illuminate\Support\Facades\DB;

class Match_eventService
{
    public function create(array $data, Fixture $fixture)
    {
        if ($fixture->status != 'live') {
            return response()->json([
                'message' => 'Match event can not be added'
            ], 403);
        }
        return DB::transaction(function () use ($data, $fixture) {

            if ($data['type'] == 'goal') {
                if ($data['team'] == 'home') {
                    $fixture->increment('home_score');
                } else {
                    $fixture->increment('away_score');
                }
            }
            $matchEvent =  $fixture->match_events()->create($data);

            $matchEvent->load([
                'player',
                'related_player'
            ]);

            MatchEventCreated::dispatch($matchEvent);

            return $matchEvent;
        });
    }
}
