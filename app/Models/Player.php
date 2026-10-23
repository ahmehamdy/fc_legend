<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $fillable = [
        'name',
        'image',
        'age',
        'position',
        'number',
        'status',
        'nationality',
        'bio',
        'height',
        'weight',
        'is_legend'
    ];

    public function match_events()
    {
        return $this->hasMany(Match_events::class);
    }
}
