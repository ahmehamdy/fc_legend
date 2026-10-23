<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FixtureSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('fixtures')->insert([
            [
                'match_date' => '2025-04-12',
                'opponent' => 'FC Northside',
                'result' => null,
                'status' => 'upcoming',
                'league' => 'Premier League',
            ],
            [
                'match_date' => '2025-04-01',
                'opponent' => 'AFC Rangers',
                'result' => 'win',
                'status' => 'finished',
                'league' => 'Cup',
            ],
            [
                'match_date' => '2025-04-20',
                'opponent' => 'City Warriors',
                'result' => null,
                'status' => 'upcoming',
                'league' => 'Premier League',
            ],
        ]);
    }
}
