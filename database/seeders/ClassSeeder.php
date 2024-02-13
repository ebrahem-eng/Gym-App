<?php

namespace Database\Seeders;

use App\Models\ClassT;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ClassT::create([
            'name'=> 'Zomba',
            'image_path' => 'zomba.png',
            'created_by' => '1',
        ]);

        ClassT::create([
            'name'=> 'Body Bulding',
            'image_path' => 'bodyBulding.png',
            'created_by' => '1',
        ]);

        ClassT::create([
            'name'=> 'Body Power',
            'image_path' => 'bodyPower.png',
            'created_by' => '1',
        ]);

        ClassT::create([
            'name'=> 'Fitness',
            'image_path' => 'fitness.png',
            'created_by' => '1',
        ]);

        ClassT::create([
            'name'=> 'Mens Physique',
            'image_path' => 'mensPhysique.png',
            'created_by' => '1',
        ]);

        ClassT::create([
            'name'=> 'Cardio',
            'image_path' => 'cardio.png',
            'created_by' => '1',
        ]);

        ClassT::create([
            'name'=> 'Bicycle',
            'image_path' => 'bicycle.png',
            'created_by' => '1',
        ]);

        ClassT::create([
            'name'=> 'Physical Endurance',
            'image_path' => 'physicalEndurance.png',
            'created_by' => '1',
        ]);

        ClassT::create([
            'name'=> 'Yoga',
            'image_path' => 'yoga.png',
            'created_by' => '1',
        ]);
    }
}
