<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = [
        'title',
        'content',
        'image'
    ];


    public function news_images()
    {
        return $this->hasMany(NewsImage::class);
    }
}
