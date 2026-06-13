<?php

namespace App\Http\Services;

use App\Http\Requests\CreatePlayerRequest;
use App\Http\Requests\UpdatePlayerRequest;
use App\Models\Player;
use Exception;
use Illuminate\Support\Facades\Storage;

class PlayerService
{

    public function create(CreatePlayerRequest $request, array $validated)
    {
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $imagePath = $request->file('image')->storeAs('players', $imageName, 'public');

            $validated['image'] = $imagePath;
        }
        try {

            $player = Player::create($validated);
        } catch (Exception $e) {

            return $e->getMessage();
        }
        return $player;
    }

    public function update(UpdatePlayerRequest $request,Player $player,array $validated)
    {
         if ($request->hasFile('image')) {

            if ($player->image && Storage::exists($player->image)) {
                Storage::disk('public')->delete($player->image);
            }

            $imageName = time() . "." . $request->image->extension();
            $imagePath = $request->file('image')->storeAs('player', $imageName, 'public');
            $validated['image'] = $imagePath;
        }
        $player->update($validated);

        return $player;
    }

    public function delete(Player $player)
    {
        if ($player->image && Storage::disk('public')->exists($player->image)) {
            Storage::disk('public')->delete($player->image);
        }

        $player->delete();
    }
}
