<?php

namespace App\Http\Controllers\Api;

use App\Events\AdminCreated;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateAdminRequest;
use App\Http\Requests\UpdateAdminRequest;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', User::class);
        $admins = User::role('admin')->paginate(5);

        return response()->json([
            'admins' => $admins
        ]);
    }

    public function show(User $admin)
    {
        $this->authorize('view',$admin);
        return response()->json([
            'admin' => $admin->load('roles')
        ]);
    }

    public function store(CreateAdminRequest $request)
    {
         $this->authorize('create', User::class);
        $validated = $request->validated();

        $user = User::create(
            collect($validated)->except('role')->toArray()
        );

        $user->assignRole('admin');

        event(new AdminCreated($user));

        return response()->json([
            'message' => 'Admin created succssfully',
            'admin' => $user
        ], 201);
    }

    public function update(UpdateAdminRequest $request, User $admin)
    {
        $this->authorize('update', $admin);
        $validated = $request->validated();

        $admin->update(
            collect($validated)->except('role')->toArray()
        );

        if (isset($validated['role'])) {
            $admin->syncRoles($validated['role']);
        }

        return response()->json([
            'message' => 'Admin updated succssfully',
            'admin' => $admin->load('roles')
        ], 200);
    }

    public function delete(User $admin)
    {
        $this->authorize('delete', $admin);
        $admin->removeRole('admin');
        $admin->delete();

        return response()->json([
            'message' => 'Admin deleted succssfully'
        ]);
    }
}
