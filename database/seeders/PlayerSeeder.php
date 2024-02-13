<?php

namespace Database\Seeders;

use App\Models\Player;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlayerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Player::create([
            'first_name' => 'player',
            'last_name' => 'pl',
            'email' => 'player@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'phone'=>'0987654321',
            'status'=>'1',
            'img' => 'trainerprofile',
            'age'=>'23',
            'gender' =>'1',
            'address' =>'Damas',
            'level' =>'beginner',
        ]);

        Player::create([
            'first_name' => 'player 2',
            'last_name' => 'pl 2',
            'email' => 'player2@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'phone'=>'0987654321',
            'status'=>'1',
            'img' => 'fitness',
            'age'=>'23',
            'gender' =>'1',
            'address' =>'Damas',
            'level' =>'meduim',
        ]);
    }
}
