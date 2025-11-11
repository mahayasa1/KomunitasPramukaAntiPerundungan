<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@example.com'], // cek kalau sudah ada
            [
                'name' => 'Administrator',
                'email' => 'admin@example.com',
                'password' => Hash::make('password123'),
                'role' => 'admin',
            ]
        );
    }
}
