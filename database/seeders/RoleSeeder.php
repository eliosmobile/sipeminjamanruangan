<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Create roles
         Role::firstOrCreate(['name' => 'mahasiswa']);
         Role::firstOrCreate(['name' => 'admin_ruangan']);
         Role::firstOrCreate(['name' => 'super_admin']);
 
         // Assign default role to users
         User::all()->each(function ($user) {
             $user->assignRole('mahasiswa');
         });
    }
}
