<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Super Admin',
                'password' => 'password',
                'role' => User::ROLE_ADMIN,
                'is_active' => true,
            ],
        );

        User::updateOrCreate(
            ['email' => 'instructor@example.com'],
            [
                'name' => 'Demo Instructor',
                'password' => 'password',
                'role' => User::ROLE_INSTRUCTOR,
                'is_active' => true,
            ],
        );
    }
}
