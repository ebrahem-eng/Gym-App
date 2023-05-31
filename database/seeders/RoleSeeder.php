<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Role::create(['name' => 'Admin']);
        // Role::create(['name' => 'Employe']);
        // Role::create(['name' => 'Coach']);
        // Role::create(['name' => 'Player']);

        
        Role::create(['guard_name' => 'admin', 'name' => 'Super Admin']);
        Role::create(['guard_name' => 'admin', 'name' => 'Admin']);
        Role::create(['guard_name' => 'employe', 'name' => 'Employe']);
        Role::create(['guard_name' => 'coach', 'name' => 'Coach']);
        Role::create(['guard_name' => 'player', 'name' => 'Player']);
        
    }
}
