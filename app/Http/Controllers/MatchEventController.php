<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Http\Requests\CreateMatch_eventRequest;
use App\Http\Services\Match_eventService;
use App\Models\Fixture;
use Illuminate\Http\Request;

class MatchEventController extends Controller
{
    public function __construct(
        protected Match_eventService $matchEventService
    ) {}

    public function create(Fixture $fixture)
    {
        return view('admin.add-match-event',compact('fixture'));
    }
    public function store(CreateMatch_eventRequest $request, Fixture $fixture)
    {
        $validated = $request->validated();
        $matchEvent = $this->matchEventService->create($validated, $fixture);

        return view('match-detail',compact('matchEvent'));
    }
}
