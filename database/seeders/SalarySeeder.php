<?php

namespace Database\Seeders;

use App\Models\Salary;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SalarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Salary::create([
            'value' => '50000',
        ]);
        Salary::create([
            'value' => '60000',
        ]);
        Salary::create([
            'value' => '70000',
        ]);
        Salary::create([
            'value' => '80000',
        ]);
        Salary::create([
            'value' => '90000',
        ]);
        Salary::create([
            'value' => '100000',
        ]);
        Salary::create([
            'value' => '150000',
        ]);
        Salary::create([
            'value' => '200000',
        ]);
        Salary::create([
            'value' => '250000',
        ]);

    }
}
