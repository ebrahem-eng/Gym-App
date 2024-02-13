<?php

namespace Database\Seeders;

use App\Models\Program;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Program::create([
            'name' => 'program 1',
            'number_program' => '1',
            'status' => '1',
            'course_id' => '1',
            'created_by' => '1',
        ]);

        Program::create([
            'name' => 'program 2',
            'number_program' => '2',
            'status' => '1',
            'course_id' => '2',
            'created_by' => '1',
        ]);

        Program::create([
            'name' => 'program 3',
            'number_program' => '3',
            'status' => '1',
            'course_id' => '1',
            'created_by' => '1',
        ]);
    }
}
