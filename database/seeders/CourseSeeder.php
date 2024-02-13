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

        Course::create([
            'status' => '0',
            'day_times' => '
            {
                "1": [
                    "1"
                ],
                "2": [
                    "2"
                ]
            }
            ',
            'capacity'=>'30',
            'class_id' => '2',
            'trainer_id' => '1',
            'created_by' => '1',
        ]);

        Course::create([
            'status' => '0',
            'day_times' => '
            {
                "2": [
                    "4"
                ]
            }
            ',
            'capacity'=>'20',
            'class_id' => '3',
            'trainer_id' => '1',
            'created_by' => '1',
        ]);

        Course::create([
            'status' => '1',
            'day_times' => '
            {
                "2": [
                    "3"
                ],
                "3": [
                    "1",
                    "2"
                ]
            }
            ',
            'capacity'=>'50',
            'class_id' => '4',
            'trainer_id' => '1',
            'created_by' => '1',
        ]);

        Course::create([
            'status' => '1',
            'day_times' => '
            {
                "2": [
                    "2",
                    "3"
                ],
                "4": [
                    "2",
                    "4"
                ]
            }
            ',
            'capacity'=>'30',
            'class_id' => '5',
            'trainer_id' => '1',
            'created_by' => '1',
        ]);

        Course::create([
            'status' => '0',
            'day_times' => '
            {
                "7": [
                    "1"
                ]
            }
            ',
            'capacity'=>'40',
            'class_id' => '6',
            'trainer_id' => '1',
            'created_by' => '1',
        ]);

        Course::create([
            'status' => '0',
            'day_times' => '
            {
                "3": [
                    "1"
                ],
                "6": [
                    "3"
                ]
            }
            ',
            'capacity'=>'30',
            'class_id' => '7',
            'trainer_id' => '1',
            'created_by' => '1',
        ]);

        Course::create([
            'status' => '0',
            'day_times' => '
            {
                "1": [
                    "3"
                ],
                "6": [
                    "4"
                ]
            }
            ',
            'capacity'=>'40',
            'class_id' => '8',
            'trainer_id' => '1',
            'created_by' => '1',
        ]);

        Course::create([
            'status' => '0',
            'day_times' => '
            {
                "2": [
                    "3"
                ]
            }
            ',
            'capacity'=>'30',
            'class_id' => '9',
            'trainer_id' => '1',
            'created_by' => '1',
        ]);

        // Course::create([
        //     'status' => '0',
        //     'day_times' => '
        //     {
        //         "5": [
        //             "5"
        //         ]
        //     }
        //     ',
        //     'capacity'=>'40',
        //     'class_id' => '10',
        //     'trainer_id' => '1',
        //     'created_by' => '1',
        // ]);
    }
}
