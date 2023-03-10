<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Permission::create(['name' => 'Add Employe']);
        // Permission::create(['name' => 'Delete Employe']);
        // Permission::create(['name' => 'Edit Employe']);
        // Permission::create(['name' => 'Show Employe']);
        // Permission::create(['name' => 'restore Employe']);
        // Permission::create(['name' => 'Show_Archive Employe']);
        // Permission::create(['name' => 'Add Trainer']);
        // Permission::create(['name' => 'Delete Trainer']);
        // Permission::create(['name' => 'Edit Trainer']);
        // Permission::create(['name' => 'Show Trainer']);
        // Permission::create(['name' => 'restore Trainer']);
        // Permission::create(['name' => 'Show_Archive Trainer']);


        Permission::create(['guard_name' => 'admin', 'name' => 'Add Employe']);
        Permission::create(['guard_name' => 'admin', 'name' => 'Delete Employe']);
        Permission::create(['guard_name' => 'admin', 'name' => 'Edit Employe']);
        Permission::create(['guard_name' => 'admin', 'name' => 'Show Employe']);
        Permission::create(['guard_name' => 'admin', 'name' => 'restore Employe']);
        Permission::create(['guard_name' => 'admin', 'name' => 'Show_Archive Employe']);
        Permission::create(['guard_name' => 'admin', 'name' => 'Add Trainer']);
        Permission::create(['guard_name' => 'admin', 'name' => 'Delete Trainer']);
        Permission::create(['guard_name' => 'admin', 'name' => 'Edit Trainer']);
        Permission::create(['guard_name' => 'admin', 'name' => 'Show Trainer']);
        Permission::create(['guard_name' => 'admin', 'name' => 'restore Trainer']);
        Permission::create(['guard_name' => 'admin', 'name' => 'Show_Archive Trainer']);
    }
}
