<?php

namespace Database\Seeders;

use App\Models\ExerciseProgram;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExerciseProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
    ExerciseProgram::create([
        'numberOFSets' => '4',
        'resetBetweenSets'=> '2',
        'dublicatesInSets' => '10 - 8 - 8 - 6',
        'exerciseArrangement' => '1',
        'exerciseSystem' => 'DropSets',
        'programID' => '1',
        'exerciseID' => '1',
    ]);

    ExerciseProgram::create([
        'numberOFSets' => '4',
        'resetBetweenSets'=> '2',
        'dublicatesInSets' => '10 - 8 - 8 - 6',
        'exerciseArrangement' => '1',
        'exerciseSystem' => 'DropSets',
        'programID' => '1',
        'exerciseID' => '1',
    ]);
    
    }
}
