<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateAdminRequest;
use App\Http\Requests\UpdateAdminRequest;
use App\Models\User;
use Illuminate\Http\Request;

class JournalistController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', User::class);

        $jours = User::role('journalist')->paginate(5);

        return response()->json([
            'massege' => 'All Journalists',
            'journalists' => $jours
        ]);
    }

    public function show(User $jour)
    {
        $this->authorize('view',$jour);
        if ($jour || $jour->hasRole('journalist')) {
            return response()->json([
                'jour' => $jour->load('roles')
            ]);
        }

        return response()->json([
            'message' => 'not found'
        ], 404);
    }

    public function store(CreateAdminRequest $request)
    {
        $this->authorize('create', User::class);
        $validated = $request->validated();

        $user = User::create(
            collect($validated)->except('role')->toArray()
        );

        $user->assignRole('journalist');

        return response()->json([
            'message' => 'journalist created succssfully',
            'journalist' => $user
        ], 201);
    }

    public function update(UpdateAdminRequest $request, User $jour)
    {
        $this->authorize('update', $jour);
        $validated = $request->validated();

        $jour->update(
            collect($validated)->except('role')->toArray()
        );

        if (isset($validated['role'])) {
            $jour->syncRoles($validated['role']);
        }

        return response()->json([
            'message' => 'journalist updated succssfully',
            'jour' => $jour->load('roles')
        ], 200);
    }

    public function delete(User $jour)
    {
        $this->authorize('delete', $jour);
        $jour->removeRole('journalist');
        $jour->delete();

        return response()->json([
            'message' => 'journalist deleted succssfully'
        ]);
    }
}
