<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fixture extends Model
{
    protected $fillable = [
        'opponent',
        'match_date',
        'home_score',
        'away_score',
        'status',
        'result',
        'league'
    ];

    protected $casts = [
        'match_date'
    ];

    public function match_events()
    {
        return $this->hasMany(Match_events::class);
    }
}
