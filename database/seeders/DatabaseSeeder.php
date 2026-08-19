<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Akun Admin tetap dipertahankan untuk login awal sistem
        User::firstOrCreate(
            ['email' => 'desiaretanet@gmail.com'],
            [
                'name' => 'Admin Areta',
                'password' => Hash::make('areta123456'),
            ]
        );
    }
}
