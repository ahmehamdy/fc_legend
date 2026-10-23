<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Fixture;
use App\Models\Match_events;
use Illuminate\Http\Request;

class FixtureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $matches = [
        //     [
        //         'id' => 1,
        //         'home_team' => 'FC Dynamo',
        //         'away_team' => 'City Warriors',
        //         'home_logo' => '🔴',
        //         'away_logo' => '🔵',
        //         'competition' => 'Premier League',
        //         'round' => 'Round 28',
        //         'date' => '2025-04-12',
        //         'time' => '20:00',
        //         'stadium' => 'Dynamo Arena',
        //         'status' => 'live',
        //         'home_score' => 0,
        //         'away_score' => 0,
        //         'result' => null,
        //         'ticket_link' => '#',
        //     ],
        //     [
        //         'id' => 2,
        //         'home_team' => 'FC Dynamo',
        //         'away_team' => 'United Stars',
        //         'home_logo' => '🔴',
        //         'away_logo' => '⭐',
        //         'competition' => 'Champions League',
        //         'round' => 'Quarterfinal',
        //         'date' => '2025-04-19',
        //         'time' => '17:30',
        //         'stadium' => 'Dynamo Arena',
        //         'status' => 'upcoming',
        //         'home_score' => null,
        //         'away_score' => null,
        //         'result' => null,
        //         'ticket_link' => '#',
        //     ],
        //     [
        //         'id' => 3,
        //         'home_team' => 'FC Dynamo',
        //         'away_team' => 'Rovers AFC',
        //         'home_logo' => '🔴',
        //         'away_logo' => '⚫',
        //         'competition' => 'Cup',
        //         'round' => 'Quarterfinal',
        //         'date' => '2025-04-19',
        //         'time' => '20:00',
        //         'stadium' => 'Dynamo Arena',
        //         'status' => 'upcoming',
        //         'home_score' => null,
        //         'away_score' => null,
        //         'result' => null,
        //         'ticket_link' => '#',
        //     ],
        //     [
        //         'id' => 4,
        //         'home_team' => 'Athletic Madrid',
        //         'away_team' => 'FC Dynamo',
        //         'home_logo' => '🏴',
        //         'away_logo' => '🔴',
        //         'competition' => 'Premier League',
        //         'round' => 'Round 27',
        //         'date' => '2025-03-29',
        //         'time' => '20:00',
        //         'stadium' => 'Wanda Metropolitano',
        //         'status' => 'finished',
        //         'home_score' => 1,
        //         'away_score' => 3,
        //         'result' => 'win',
        //         'ticket_link' => null,
        //     ],
        //     [
        //         'id' => 5,
        //         'home_team' => 'North London FC',
        //         'away_team' => 'FC Dynamo',
        //         'home_logo' => '⚪',
        //         'away_logo' => '🔴',
        //         'competition' => 'Premier League',
        //         'round' => 'Round 26',
        //         'date' => '2025-03-22',
        //         'time' => '14:00',
        //         'stadium' => 'Emirates Stadium',
        //         'status' => 'finished',
        //         'home_score' => 0,
        //         'away_score' => 0,
        //         'result' => 'draw',
        //         'ticket_link' => null,
        //     ],
        //     [
        //         'id' => 6,
        //         'home_team' => 'FC Dynamo',
        //         'away_team' => 'Manchester City',
        //         'home_logo' => '🔴',
        //         'away_logo' => '🔵',
        //         'competition' => 'Premier League',
        //         'round' => 'Round 25',
        //         'date' => '2025-03-15',
        //         'time' => '16:30',
        //         'stadium' => 'Dynamo Arena',
        //         'status' => 'finished',
        //         'home_score' => 2,
        //         'away_score' => 1,
        //         'result' => 'win',
        //         'ticket_link' => null,
        //     ],
        //     [
        //         'id' => 7,
        //         'home_team' => 'Liverpool FC',
        //         'away_team' => 'FC Dynamo',
        //         'home_logo' => '🔴',
        //         'away_logo' => '🔴',
        //         'competition' => 'Champions League',
        //         'round' => 'Group Stage',
        //         'date' => '2025-03-10',
        //         'time' => '21:00',
        //         'stadium' => 'Anfield',
        //         'status' => 'finished',
        //         'home_score' => 2,
        //         'away_score' => 2,
        //         'result' => 'draw',
        //         'ticket_link' => null,
        //     ],
        //     [
        //         'id' => 8,
        //         'home_team' => 'FC Dynamo',
        //         'away_team' => 'Chelsea FC',
        //         'home_logo' => '🔴',
        //         'away_logo' => '🔵',
        //         'competition' => 'Premier League',
        //         'round' => 'Round 24',
        //         'date' => '2025-03-05',
        //         'time' => '20:00',
        //         'stadium' => 'Dynamo Arena',
        //         'status' => 'finished',
        //         'home_score' => 3,
        //         'away_score' => 0,
        //         'result' => 'win',
        //         'ticket_link' => null,
        //     ],
        // ];

        $matches = Fixture::latest()->get();
        $stats = [
            'total' => count($matches),
            'won' => collect($matches)->where('result', 'win')->count(),
            'drawn' => collect($matches)->where('result', 'draw')->count(),
            'lost' => collect($matches)->where('result', 'loss')->count(),
            'live' => collect($matches)->where('status', 'live')->count(),
        ];
        return view('matches', compact('matches', 'stats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Fixture $fixture)
    {

        // $event = Match_events::where('fixture_id',$fixture->id)->get();

        $match = [
            'id' => $fixture->id,
            'home_team' => 'FC Dynamo',
            'away_team' => 'City Warriors',
            'home_logo' => '🔴',
            'away_logo' => '🔵',
            'competition' => 'Premier League',
            'round' => 'Round 28',
            'date' => '2025-04-12',
            'time' => '20:00',
            'stadium' => 'Dynamo Arena',
            'status' => 'live',
            'home_score' => $fixture->home_score,
            'away_score' => $fixture->away_score,
            'result' => null,
            'attendance' => 48234,
            'ticket_link' => '/tickets/1',
            'preview' => 'FC Dynamo welcomes City Warriors in what promises to be an exciting Premier League encounter. Both teams are fighting for the top spot, with Dynamo looking to extend their unbeaten run to 10 matches. The home side will rely on their attacking firepower, while City Warriors are known for their resilient defense.',
            'stats' => [
                ['label' => 'Shots', 'home' => 15, 'away' => 8],
                ['label' => 'Shots on Target', 'home' => 7, 'away' => 3],
                ['label' => 'Possession', 'home' => 62, 'away' => 38],
                ['label' => 'Passes', 'home' => 456, 'away' => 324],
                ['label' => 'Tackles', 'home' => 18, 'away' => 22],
                ['label' => 'Fouls', 'home' => 12, 'away' => 15],
                ['label' => 'Corners', 'home' => 6, 'away' => 3],
            ],
            'events' => [
                ['minute' => 12, 'type' => 'goal', 'player' => 'E. Haaland', 'assist' => 'K. De Bruyne'],
                ['minute' => 23, 'type' => 'yellow', 'player' => 'J. Stones', 'description' => 'Professional foul'],
                ['minute' => 34, 'type' => 'goal', 'player' => 'E. Haaland'],
                ['minute' => 45, 'type' => 'goal', 'player' => 'R. Sterling', 'assist' => 'K. Walker', 'description' => 'Away team'],
                ['minute' => 56, 'type' => 'substitution', 'player' => 'P. Foden', 'description' => 'In: P. Foden, Out: J. Grealish'],
                ['minute' => 78, 'type' => 'goal', 'player' => 'Rodri', 'assist' => 'K. De Bruyne'],
                ['minute' => 89, 'type' => 'yellow', 'player' => 'Rodri', 'description' => 'Time wasting'],
            ],
            'lineups' => [
                [
                    'name' => 'FC Dynamo',
                    'logo' => 'teams/dynamo.png',
                    'players' => [
                        ['number' => 1, 'name' => 'A. Becker', 'position' => 'GK'],
                        ['number' => 2, 'name' => 'K. Walker', 'position' => 'RB'],
                        ['number' => 5, 'name' => 'J. Stones', 'position' => 'CB'],
                        ['number' => 3, 'name' => 'R. Dias', 'position' => 'CB'],
                        ['number' => 6, 'name' => 'A. Laporte', 'position' => 'LB'],
                        ['number' => 16, 'name' => 'Rodri', 'position' => 'CDM'],
                        ['number' => 17, 'name' => 'K. De Bruyne', 'position' => 'CM'],
                        ['number' => 8, 'name' => 'I. Gündogan', 'position' => 'CM'],
                        ['number' => 20, 'name' => 'B. Silva', 'position' => 'RW'],
                        ['number' => 9, 'name' => 'E. Haaland', 'position' => 'ST'],
                        ['number' => 10, 'name' => 'J. Grealish', 'position' => 'LW'],
                    ]
                ],
                [
                    'name' => 'City Warriors',
                    'logo' => 'teams/city.png',
                    'players' => [
                        ['number' => 1, 'name' => 'E. Martinez', 'position' => 'GK'],
                        ['number' => 2, 'name' => 'M. Cash', 'position' => 'RB'],
                        ['number' => 4, 'name' => 'E. Konsa', 'position' => 'CB'],
                        ['number' => 5, 'name' => 'T. Mings', 'position' => 'CB'],
                        ['number' => 3, 'name' => 'L. Digne', 'position' => 'LB'],
                        ['number' => 6, 'name' => 'D. Luiz', 'position' => 'CDM'],
                        ['number' => 7, 'name' => 'J. McGinn', 'position' => 'CM'],
                        ['number' => 8, 'name' => 'Y. Tielemans', 'position' => 'CM'],
                        ['number' => 9, 'name' => 'O. Watkins', 'position' => 'ST'],
                        ['number' => 10, 'name' => 'E. Buendia', 'position' => 'RW'],
                        ['number' => 11, 'name' => 'L. Bailey', 'position' => 'LW'],
                    ]
                ]
            ],
            'officials' => [
                ['name' => 'M. Oliver', 'role' => 'Referee'],
                ['name' => 'S. Burt', 'role' => 'Assistant Referee'],
                ['name' => 'D. Cook', 'role' => 'Assistant Referee'],
                ['name' => 'P. Tierney', 'role' => 'Fourth Official'],
            ],
            'h2h' => [
                ['date' => '2024-12-15', 'competition' => 'Premier League', 'home' => 'City Warriors', 'home_score' => 2, 'away' => 'FC Dynamo', 'away_score' => 2, 'result' => 'draw'],
                ['date' => '2024-08-20', 'competition' => 'Premier League', 'home' => 'FC Dynamo', 'home_score' => 3, 'away' => 'City Warriors', 'away_score' => 0, 'result' => 'home'],
                ['date' => '2024-04-10', 'competition' => 'Cup', 'home' => 'City Warriors', 'home_score' => 1, 'away' => 'FC Dynamo', 'away_score' => 2, 'result' => 'away'],
            ]
        ];

        return view('match-detail', compact('match','fixture'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
