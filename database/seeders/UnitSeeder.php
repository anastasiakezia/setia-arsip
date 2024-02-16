<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;
use SebastianBergmann\CodeCoverage\Report\Xml\Unit;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Department::create([
            'name' => 'Direksi PT',
            'name' => 'Direksi Rumah Sakit'
        ]);
    }
}
