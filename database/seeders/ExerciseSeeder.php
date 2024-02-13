<?php

namespace Database\Seeders;

use App\Models\Exercise;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExerciseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Exercise::create([
            'name' => 'Back Rowing',
            'description' => 'Maximize your gains and build the body you want with our guide on the best exercises for every muscle group.", video: "backRowing',
            'video' => 'backRowing',
            'course_id' =>'2',
            'created_by' => '1',
        ]);
    }
}
