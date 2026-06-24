<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = [
        'title',
        'content',
        'user_id'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function news_images()
    {
        return $this->hasMany(NewsImage::class);
    }
}
