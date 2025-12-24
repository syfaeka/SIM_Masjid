<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Buat 1 Akun Admin
        User::create([
            'name' => 'Ketua DKM',
            'email' => 'admin@masjid.com',
            'password' => Hash::make('bismillah'), // Passwordnya: bismillah
        ]);
    }
}