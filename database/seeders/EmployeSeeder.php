<?php

namespace Database\Seeders;

use App\Models\Employe;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Employe::create([
            'first_name' => 'employe',
            'last_name' => 'emp',
            'email' => 'employe@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'phone'=>'0987654321',
            'status'=>'1',
            'age'=>'23',
            'address'=>'damas',
            'gender'=>'1',
            'salary_id' => '1',
            'work_time_id'=>'1',
            'created_by' => '1',
        ]);
    }
}
