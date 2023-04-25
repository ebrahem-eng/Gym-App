<?php

namespace Database\Seeders;

use App\Models\Time;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Time::create([
            'time_start' => '32:56:34',
            'time_end' => '25:56:34'
        ]);

        Time::create([
            'time_start' => '20:56:34',
            'time_end' => '35:56:34'
        ]);

        Time::create([
            'time_start' => '30:56:34',
            'time_end' => '45:56:34'
        ]);

        Time::create([
            'time_start' => '32:56:34',
            'time_end' => '43:56:34'
        ]);

        Time::create([
            'time_start' => '20:56:34',
            'time_end' => '10:56:34'
        ]);

        Time::create([
            'time_start' => '32:56:34',
            'time_end' => '25:56:34'
        ]);
    }
}
