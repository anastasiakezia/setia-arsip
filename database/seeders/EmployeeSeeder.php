<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Employee::create(
            [
                'employee_name' => 'Dr Mia Pramudianti',
                'position' => 'Direktur Utama PT',
                'id' => '1'
            ],
            [
                'employee_name' => 'Dr Hasman Budiono',
                'position' => 'Direktur PT',
                'id' => '1'
            ],
            [
                'employee_name' => 'Dr Pantja Kuntjoro, M.Kes, M.Eng',
                'position' => 'Direktur RS',
                'id' => '2'
            ]
        );
    }
}
