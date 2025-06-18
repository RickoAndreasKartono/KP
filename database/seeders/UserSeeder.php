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
            'nama_user' => 'Default Owner 1',
            'email' => 'rickoandreaskartono_2226250037@mhs.mdp.ac.id',
            'password' => Hash::make('password123'), // Hash password
            'role' => 'owner',
        ]);
        User::create([
            'nama_user' => 'Default Owner 2',
            'email' => 'christy_2226250005@mhs.mdp.ac.id',
            'password' => Hash::make('password1234'), // Hash password
            'role' => 'owner',
        ]);
        User::create([
            'nama_user' => 'Manager',
            'email' => 'manager@gmail.com',
            'password' => Hash::make('manager123'), // Hash password
            'role' => 'manager',
        ]);
        User::create([
            'nama_user' => 'Kepala Admin',
            'email' => 'kepadm@gmail.com',
            'password' => Hash::make('kepadmin123'), // Hash password
            'role' => 'kepala_admin',
        ]);
        User::create([
            'nama_user' => 'Kepala Gudang',
            'email' => 'kepgud@gmail.com',
            'password' => Hash::make('kepgudang123'), // Hash password
            'role' => 'kepala_gudang',
        ]);
        
    }
}
