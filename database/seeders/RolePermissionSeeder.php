<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // permissions
        Permission::create(['name' => 'create news']);
        Permission::create(['name' => 'edit news']);
        Permission::create(['name' => 'delete news']);

        Permission::create(['name' => 'manage players']);
        Permission::create(['name' => 'manage fixtures']);
        Permission::create(['name' => 'manage admins']);

        // roles
        $admin = Role::create(['name' => 'admin']);
        $journalist = Role::create(['name' => 'journalist']);

        // assign permissions
        $admin->givePermissionTo(Permission::all());

        $journalist->givePermissionTo([
            'create news',
            'edit news'
        ]);
    }
}
