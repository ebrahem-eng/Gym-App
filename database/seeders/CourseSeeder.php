<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Course::create([
            'status' => '0',
            'day_times' => '
            {
                "1": [
                    "1"
                ],
                "4": [
                    "3"
                ]
                }
            ',
            'capacity'=>'40',
            'class_id' => '1',
            'trainer_id' => '1',
            'created_by' => '1',
        ]);
    }
}
