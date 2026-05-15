<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // create role if not exists
        $adminRole = Role::firstOrCreate(['name' => 'admin']);

        // create admin user
        $admin = User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin',
                'password' => bcrypt('12345678'),
            ]
        );

        // assign role
        $admin->assignRole($adminRole);
    }
}
