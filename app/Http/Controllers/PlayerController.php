<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Player;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PlayerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $players = Player::where('is_legend', 0)->paginate(5);
        return view('admin.players', compact('players'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.players-create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|numeric|max:45|min:16',
            'number' => 'required|numeric|max:99|min:1',
            'position' => 'required|string|max:255',
            'nationality' => 'required|string|max:255',
            'bio' => 'required|string',
            'height' => 'nullable|numeric',
            'weight' => 'nullable|numeric',
            'image' => 'image|mimes:jpg,jpeg,png|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $imagePath = $request->file('image')->storeAs('players', $imageName, 'public');

            $validated['image'] = $imagePath;
        }
        try {

            Player::create($validated);
        } catch (Exception $e) {

            return $e->getMessage();
        }

        return redirect()->route('admin.players');
    }

    /**
     * Display the specified resource.
     */
    public function show(Player $player)
    {
        return view('admin.player-show',compact('player'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Player $player)
    {
        return view('admin.players-edit', compact('player'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Player $player)
    {
        $validated = $request->validate([
            'name' => 'string|max:255',
            'age' => 'numeric|max:45|min:16',
            'number' => 'numeric|max:99|min:1',
            'position' => 'string|max:255',
            'nationality' => 'string|max:255',
            'bio' => 'string',
            'height' => 'numeric',
            'weight' => 'numeric',
            'image' => 'image|mimes:jpg,jpeg,png|max:2048'
        ]);

        if ($request->hasFile('image')) {

            if ($player->image && Storage::exists($player->image)) {
                Storage::disk('public')->delete($player->image);
            }

            $imageName = time() . "." . $request->image->extension();
            $imagePath = $request->file('image')->storeAs('player', $imageName, 'public');
            $validated['image'] = $imagePath;
        }

        $player->update($validated);

        return redirect()->route('admin.players.show',$player);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( Player $player)
    {
        if($player->image && Storage::disk('public')->exists($player->image)){
            Storage::disk('public')->delete($player->image);
        }

        $player->delete();

        return redirect()->route('admin.players')->with('success','Player deleted successfully');

    }
}
