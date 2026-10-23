<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateMatch_eventRequest;
use App\Http\Services\Match_eventService;
use App\Models\Fixture;
use Illuminate\Http\Request;

class Match_eventsController extends Controller
{
    public function __construct(
        protected Match_eventService $matchEventService
    ) {}

    public function store(CreateMatch_eventRequest $request, Fixture $fixture)
    {
        $validated = $request->validated();
        $matchEvent = $this->matchEventService->create($validated, $fixture);

        return response()->json([
            'message' => 'event added',
            'match event' => $matchEvent
        ], 200);
    }
}
