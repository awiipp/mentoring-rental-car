<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'username' => 'admin_24',
            'role' => 'admin',
            'password' => bcrypt('admin_24'),
        ]);

        User::create([
            'username' => 'user_24',
            'role' => 'user',
            'password' => bcrypt('user_24'),
        ]);
    }
}
