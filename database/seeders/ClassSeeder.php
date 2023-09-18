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
            'created_by' => '1',

        ]);

        ClassT::create([
            'name'=> 'BudyBulding',
            'created_by' => '1',
        ]);
    }
}
