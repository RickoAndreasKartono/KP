<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'nama_user' => 'Default Admin',
            'email' => 'rickoandreaskartono_2226250037@mhs.mdp.ac.id',
            'password' => Hash::make('password123'), // Hash password
            'role' => 'owner',
        ]);
    }
}
