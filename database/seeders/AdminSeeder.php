<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@tastyfood.com'],
            [
                'name' => 'Admin',
                'password' => 'w3erty99a',
            ]
        );
    }
}
