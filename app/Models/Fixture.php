<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fixture extends Model
{
    protected $fillable = [
        'opponent',
        'match_date',
        'result',
        'status',
        'league'
    ];
}
