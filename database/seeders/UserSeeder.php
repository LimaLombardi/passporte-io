<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'organizador@passaporte.io'],
            [
                'name' => 'Carlos Organizador',
                'password' => 'password',
                'role' => User::ROLE_ORGANIZER,
            ]
        );

        User::firstOrCreate(
            ['email' => 'participante@passaporte.io'],
            [
                'name' => 'Ana Participante',
                'password' => 'password',
                'role' => User::ROLE_PARTICIPANT,
            ]
        );
    }
}
