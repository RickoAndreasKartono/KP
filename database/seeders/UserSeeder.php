<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Membuat dua user secara terpisah
        User::create([
            'nama_user' => 'Default Admin',
            'email' => 'rickoandreaskartono_2226250037@mhs.mdp.ac.id',
            'password' => Hash::make('password123'),
            'role' => 'owner',
        ]);

        User::create([
            'nama_user' => 'Default Owner',
            'email' => 'christy_2226250005@mhs.mdp.ac.id',
            'password' => Hash::make('password1234'),
            'role' => 'owner',
        ]);
    }
}
