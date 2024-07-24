<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
class TableUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@example.com',
            'password' => Hash::make('password'), // Ganti dengan password yang aman
            'role' => 'super_admin'
        ]);

        // Buat user admin_ruangan
        User::create([
            'name' => 'Admin Ruangan',
            'email' => 'adminruangan@example.com',
            'password' => Hash::make('password'), // Ganti dengan password yang aman
            'role' => 'admin_ruangan'
        ]);
    }
}
