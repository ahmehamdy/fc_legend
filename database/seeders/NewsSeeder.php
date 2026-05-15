<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NewsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('news')->insert([
            [
                'title' => 'Dynamo signs new striker',
                'content' => 'The club has signed a world-class striker from Brazil.',
                'image' => 'news1.jpg',
            ],
            [
                'title' => 'Big derby win',
                'content' => 'A massive 3-1 win in the derby.',
                'image' => 'news2.jpg',
            ],
            [
                'title' => 'Young talent shines',
                'content' => 'Academy player makes debut.',
                'image' => 'news3.jpg',
            ],
        ]);
    }
}
