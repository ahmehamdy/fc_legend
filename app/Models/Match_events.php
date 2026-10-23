<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Match_events extends Model
{
    protected $fillable = [
        'fixture_id',
        'player_id',
        'related_player_id',
        'minute',
        'type',
        'team',
    ];

    public function fixture()
    {
        return $this->belongsTo(Fixture::class);
    }
    public function player()
    {
        return $this->belongsTo(Player::class);
    }
    public function related_player()
    {
        return $this->belongsTo(Player::class,'related_player_id');
    }
}
