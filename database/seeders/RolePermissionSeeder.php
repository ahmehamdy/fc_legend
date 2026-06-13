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
        Permission::firstOrCreate(['name' => 'create news']);
        Permission::firstOrCreate(['name' => 'edit news']);
        Permission::firstOrCreate(['name' => 'delete news']);

        Permission::firstOrCreate(['name' => 'manage players']);
        Permission::firstOrCreate(['name' => 'manage fixtures']);
        Permission::firstOrCreate(['name' => 'manage admins']);

        // roles
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $journalist = Role::firstOrCreate(['name' => 'journalist']);

        // assign permissions
        $admin->givePermissionTo(Permission::all());

        $journalist->givePermissionTo([
            'create news',
            'edit news'
        ]);
    }
}
