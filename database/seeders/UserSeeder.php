<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Sample email: replace with your own if the assignment needs it.
        User::updateOrCreate(
            ['username' => 'johnx'],
            ['full_name' => 'John Xavier Tumbokon', 'email' => 'student@example.com'],
        );
    }
}
