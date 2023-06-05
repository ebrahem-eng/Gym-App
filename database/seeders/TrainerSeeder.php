<?php

namespace Database\Seeders;

use App\Models\Trainer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TrainerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Trainer::create([
            'first_name' => 'trainer',
            'last_name' => 'tr',
            'email' => 'trainer@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'phone'=>'0987654321',
            'age'=>'23',
            'salary'=>'23',
            'work_time_start' =>'01:01:00',
            'work_time_end' =>'14:01:00',
        ]);
    }
}
