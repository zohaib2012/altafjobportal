<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $this->call([
            PositionSeeder::class,
        ]);

        User::create([
            'name' => 'Admin',
            'email' => 'zohaib.khaleed@gmail.com',
            'password' => Hash::make('Admin@1234'),
            'role' => 'admin',
        ]);
    }
}