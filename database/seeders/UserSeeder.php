<?php

namespace Database\Seeders;

use App\Models\User;
use App\Enums\RoleUserEnum;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [RoleUserEnum::ADMIN, RoleUserEnum::PROVIDER, RoleUserEnum::CLIENT];

        foreach ($users as $user) {
            User::create([
                'name' => $user,
                'email' => "$user@gmail.com",
                'password' => Hash::make('password123'),
                'role' => $user
            ]);

           
            
        }
    }
}
