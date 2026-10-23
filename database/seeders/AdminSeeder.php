<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::firstOrCreate(
            [
                'email' => 'ahmed@gmail.com',
            ],
            [
                'name' => 'Ahmed',
                'password' => bcrypt('12345678'),
            ]
        );

        $admin->assignRole('admin');
    }
}
