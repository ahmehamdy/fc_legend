<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateFixtureRequest;
use App\Http\Requests\UpdateFixtureRequest;
use App\Models\Fixture;

class FixtureController extends Controller
{
    public function index()
    {
        $fixture = Fixture::latest()->paginate(5);
        return response()->json([
            'message' => 'All fixture',
            'fixture' => $fixture
        ]);
    }

    public function show(Fixture $fixture)
    {
        return response()->json([
            'fixture' => $fixture
        ]);
    }

    public function store(CreateFixtureRequest $request)
    {
        $validated = $request->validated();
        $fixture = Fixture::create($validated);
        return response()->json([
            'message' => 'Fixture created successfully',
            'fixture' => $fixture
        ], 201);
    }

    public function updateUpcomingFixture(UpdateFixtureRequest $request, Fixture $fixture)
    {
        $validated = $request->validated();

        if ($fixture->status !== 'upcoming') {
            return response()->json([
                'message' => 'This match cannot be edited.'
            ], 403);
        }

        $fixture->update($validated);

        return response()->json([
            'message' => 'match updated.',
            'fixture' => $fixture
        ]);
    }

    public function start(Fixture $fixture)
    {
        if ($fixture->status != 'upcoming') {
            return response()->json([
                'message' => 'match already started'
            ]);
        }

        $fixture->update(['status' => 'live']);

        return response()->json([
            'message' => 'match started'
        ]);
    }

    public function finish(Fixture $fixture)
    {
        if ($fixture->status != 'live') {
            return response()->json([
                'message' => 'match is not live'
            ]);
        }

        $result = null;
        if ($fixture->home_score > $fixture->away_score) {
            $result = 'win';
        } elseif ($fixture->home_score < $fixture->away_score) {
            $result = 'loss';
        } elseif ($fixture->home_score = $fixture->away_score) {
            $result = 'draw';
        }

        $fixture->update([
            'status' => 'finished',
            'result'=>$result
        ]);

        return response()->json([
            'message' => 'match finished'
        ]);
    }
}
