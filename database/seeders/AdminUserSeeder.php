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
            ['email' => 'admin@gmail.com'], // cek kalau sudah ada
            [
                'name' => 'Administrator',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('password123'),
                'role' => 'admin',
            ]
        );

        User::updateOrCreate(
            ['email' => 'admin2@gmail.com'], // cek kalau sudah ada
            [
                'name' => 'Administrator2',
                'email' => 'admin2@gmail.com',
                'password' => Hash::make('password123'),
                'role' => 'admin',
            ]
        );
        
        User::updateOrCreate(
            ['email' => 'thaniapraper@gmail.com'], // cek kalau sudah ada
            [
                'name' => 'Thania',
                'email' => 'thaniapraper@gmail.com',
                'password' => Hash::make('nathania00'),
                'role' => 'admin',
            ]
        );
        User::updateOrCreate(
            ['email' => 'selvinapraper@gmail.com'], // cek kalau sudah ada
            [
                'name' => 'Selvina',
                'email' => 'selvinapraper@gmail.com',
                'password' => Hash::make('selvina.00'),
                'role' => 'admin',
            ]
        );
        User::updateOrCreate(
            ['email' => 'baguspraper@gmail.com'], // cek kalau sudah ada
            [
                'name' => 'Bagus',
                'email' => 'baguspraper@gmail.com',
                'password' => Hash::make('bagusparta11'),
                'role' => 'admin',
            ]
        );
        User::updateOrCreate(
            ['email' => 'saraspraper@gmail.com'], // cek kalau sudah ada
            [
                'name' => 'Saras',
                'email' => 'saraspraper@gmail.com',
                'password' => Hash::make('sarazz00'),
                'role' => 'admin',
            ]
        );
        User::updateOrCreate(
            ['email' => 'piapraper@gmail.com'], // cek kalau sudah ada
            [
                'name' => 'Pia',
                'email' => 'piapraper@gmail.com',
                'password' => Hash::make('ppiaaw11'),
                'role' => 'admin',
            ]
        );
        User::updateOrCreate(
            ['email' => 'aryasapraper@gmail.com'], // cek kalau sudah ada
            [
                'name' => 'Aryasa',
                'email' => 'aryasapraper@gmail.com',
                'password' => Hash::make('gedearyasa1'),
                'role' => 'admin',
            ]
        );

    }
}
