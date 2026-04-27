<?php

namespace Database\Seeders;

use App\Models\Position;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    public function run(): void
    {
        $positions = [
            ['title' => 'Junior Teacher', 'department' => 'Education', 'fee_amount' => 300],
            ['title' => 'Senior Teacher', 'department' => 'Education', 'fee_amount' => 300],
            ['title' => 'Admin Officer', 'department' => 'Administration', 'fee_amount' => 300],
            ['title' => 'IT Officer', 'department' => 'Information Technology', 'fee_amount' => 300],
            ['title' => 'Accounts Officer', 'department' => 'Finance', 'fee_amount' => 300],
            ['title' => 'Data Entry Operator', 'department' => 'Administration', 'fee_amount' => 300],
            ['title' => 'Field Coordinator', 'department' => 'Operations', 'fee_amount' => 300],
            ['title' => 'Project Manager', 'department' => 'Management', 'fee_amount' => 300],
            ['title' => 'Content Writer', 'department' => 'Media', 'fee_amount' => 300],
            ['title' => 'HR Officer', 'department' => 'Human Resources', 'fee_amount' => 300],
        ];

        foreach ($positions as $position) {
            Position::create($position);
        }
    }
}