<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlayerSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('players')->insert([
            [
                'name' => 'E. Rodriguez',
                'age' => 27,
                'position' => 'Forward',
                'number' => 9,
                'status' => 'active',
                'nationality' =>'Brazil',
                'image'=>'https://randomuser.me/api/portraits/men/42.jpg',
                'bio' => 'Top striker and goal machine.',
                'is_legend' => false,
            ],
            [
                'name' => 'M. Tanaka',
                'age' => 25,
                'position' => 'Midfielder',
                'number' => 8,
                'status' => 'active',
                'nationality' =>'Brazil',
                'image'=>'https://randomuser.me/api/portraits/men/42.jpg',
                'bio' => 'Creative playmaker.',
                'is_legend' => false,
            ],
            [
                'name' => 'L. Costa',
                'age' => 30,
                'position' => 'Defender',
                'number' => 4,
                'status' => 'injured',
                'nationality' =>'Brazil',
                'image'=>'https://randomuser.me/api/portraits/men/42.jpg',
                'bio' => 'Solid center-back.',
                'is_legend' => false,
            ],
            [
                'name' => 'J. van Dijk',
                'age' => 32,
                'position' => 'Goalkeeper',
                'number' => 1,
                'status' => 'active',
                'nationality' =>'Brazil',
                'image'=>'https://randomuser.me/api/portraits/men/42.jpg',
                'bio' => 'Legendary goalkeeper.',
                'is_legend' => true,
            ],
        ]);
    }
}
