<?php

namespace Database\Seeders;

use App\Models\Program_Player;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProgramPlayerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Program_Player::create([
            'start_date' => '2023-09-30',
            'end_date' => '2023-10-30',
            'player_id' => '1',
            'program_id' => '1',
        ]);

        Program_Player::create([
            'start_date' => '2023-10-1',
            'end_date' => '2023-11-1',
            'player_id' => '1',
            'program_id' => '2',
        ]);

        Program_Player::create([
            'start_date' => '2023-10-5',
            'end_date' => '2023-11-5',
            'player_id' => '1',
            'program_id' => '3',
        ]);
    }
}
