<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PositionsSeeder extends Seeder
{
    public function run(): void
    {
        $positions = [
            ['title' => 'Controller',           'department' => 'Administration', 'fee_amount' => 450.00, 'is_active' => true, 'bps' => 'Contract', 'vacancies' => 3,    'age_limit' => '18-48', 'qualification_required' => 'MA',                          'domicile' => 'All over Sindh'],
            ['title' => 'Managing Director',    'department' => 'Management',     'fee_amount' => 450.00, 'is_active' => true, 'bps' => 'Contract', 'vacancies' => 6,    'age_limit' => '18-45', 'qualification_required' => 'MA',                          'domicile' => 'All over Sindh'],
            ['title' => 'Coordinator',          'department' => 'Coordination',   'fee_amount' => 450.00, 'is_active' => true, 'bps' => 'Contract', 'vacancies' => 18,   'age_limit' => '18-45', 'qualification_required' => 'Graduation',                   'domicile' => 'All over Sindh'],
            ['title' => 'District Coordinator', 'department' => 'Coordination',   'fee_amount' => 450.00, 'is_active' => true, 'bps' => 'Contract', 'vacancies' => 35,   'age_limit' => '18-45', 'qualification_required' => 'Graduation',                   'domicile' => 'All over Sindh'],
            ['title' => 'Monitoring Officer',   'department' => 'Monitoring',     'fee_amount' => 450.00, 'is_active' => true, 'bps' => 'Contract', 'vacancies' => 300,  'age_limit' => '18-45', 'qualification_required' => 'Intermediate',                 'domicile' => 'All over Sindh'],
            ['title' => 'Assistant',            'department' => 'Administration', 'fee_amount' => 450.00, 'is_active' => true, 'bps' => 'Contract', 'vacancies' => 370,  'age_limit' => '18-45', 'qualification_required' => 'Intermediate',                 'domicile' => 'All over Sindh'],
            ['title' => 'Clerk',                'department' => 'Administration', 'fee_amount' => 450.00, 'is_active' => true, 'bps' => 'Contract', 'vacancies' => 400,  'age_limit' => '18-45', 'qualification_required' => 'Intermediate',                 'domicile' => 'All over Sindh'],
            ['title' => 'Data Entry Operator',  'department' => 'IT',             'fee_amount' => 450.00, 'is_active' => true, 'bps' => 'Contract', 'vacancies' => 200,  'age_limit' => '18-45', 'qualification_required' => 'Intermediate + MS Certificate','domicile' => 'All over Sindh'],
            ['title' => 'Field Officer',        'department' => 'Field',          'fee_amount' => 450.00, 'is_active' => true, 'bps' => 'Contract', 'vacancies' => 1600, 'age_limit' => '18-45', 'qualification_required' => 'Intermediate',                 'domicile' => 'All over Sindh'],
            ['title' => 'Instructor/Teacher',   'department' => 'Education',      'fee_amount' => 450.00, 'is_active' => true, 'bps' => 'Contract', 'vacancies' => 2500, 'age_limit' => '18-45', 'qualification_required' => 'Matric/Intermediate',          'domicile' => 'All over Sindh'],
            ['title' => 'Supporting Staff',     'department' => 'Support',        'fee_amount' => 450.00, 'is_active' => true, 'bps' => 'Contract', 'vacancies' => 1500, 'age_limit' => '18-45', 'qualification_required' => 'Primary',                      'domicile' => 'All over Sindh'],
            ['title' => 'Driver',               'department' => 'Transport',      'fee_amount' => 450.00, 'is_active' => true, 'bps' => 'Contract', 'vacancies' => 30,   'age_limit' => '18-30', 'qualification_required' => 'Having License',               'domicile' => 'All over Sindh'],
            ['title' => 'Cook',                 'department' => 'Support',        'fee_amount' => 450.00, 'is_active' => true, 'bps' => 'Contract', 'vacancies' => 15,   'age_limit' => '18-45', 'qualification_required' => 'Educated',                     'domicile' => 'All over Sindh'],
        ];

        foreach ($positions as $position) {
            $exists = DB::table('positions')->where('title', $position['title'])->exists();
            if (!$exists) {
                DB::table('positions')->insert(array_merge($position, [
                    'created_at' => now(),
                    'updated_at' => now(),
                ]));
            }
        }
    }
}
