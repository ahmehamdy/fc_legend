<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePlayerRequest;
use App\Http\Requests\UpdatePlayerRequest;
use App\Http\Services\PlayerService;
use App\Models\Player;
use Illuminate\Http\Request;

class PlayerController extends Controller
{

    public function __construct(
        private  PlayerService $playerService
    ) {}
    public function index()
    {
        $players = Player::where('is_legend', 0)->paginate(5);

        return response()->json([
            'message' => 'all player',
            'players' => $players
        ], 200);
    }

    public function show(Player $player)
    {
        return response()->json([
            'player'=>$player
        ]);

    }

    public function store(CreatePlayerRequest $request)
    {
        $validated = $request->validated();
        $player = $this->playerService->create($request, $validated);

        return response()->json([
            'meaasge' => 'Player created successfully',
            'player' => $player
        ], 201);
    }

    public function update(UpdatePlayerRequest $request, Player $player)
    {
        $validated = $request->validated();
        $player = $this->playerService->update($request, $player, $validated);

        return response()->json([
            'message' => 'Player updated successfully',
            'player' => $player
        ]);
    }

    public function delete(Player $player)
    {
        $this->playerService->delete($player);

        return response()->json([
            'message' => 'Player deleted successfully',
        ]);
    }
}
