<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        if (!User::where('email', 'admin@neph.com')->exists()) {
            User::create([
                'name'     => 'Admin',
                'email'    => 'admin@neph.com',
                'password' => Hash::make('Admin@123'),
                'role'     => 'admin',
            ]);
        }
    }
}
