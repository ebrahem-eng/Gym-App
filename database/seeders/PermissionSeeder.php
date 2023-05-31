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


        Permission::create(['guard_name' => 'admin', 'name' => 'Show Employe Table']);
        Permission::create(['guard_name' => 'admin', 'name' => 'Edit Employe']);
        Permission::create(['guard_name' => 'admin', 'name' => 'Show Role Permission Page']);
        Permission::create(['guard_name' => 'admin', 'name' => 'Assign Role To Employe']);
        Permission::create(['guard_name' => 'admin', 'name' => 'Delete Role From Employe']);
        Permission::create(['guard_name' => 'admin', 'name' => 'Give Permission To Employe']);
        Permission::create(['guard_name' => 'admin', 'name' => 'Revoke Permission From Employe']);
        Permission::create(['guard_name' => 'admin', 'name' => 'Move Employe To Archive']);
        Permission::create(['guard_name' => 'admin', 'name' => 'Add Employe']);
        Permission::create(['guard_name' => 'admin', 'name' => 'Reset Password Employe']);
        Permission::create(['guard_name' => 'admin', 'name' => 'Show Employe Arcvive Table']);
        Permission::create(['guard_name' => 'admin', 'name' => 'Restore Employe']);
        Permission::create(['guard_name' => 'admin', 'name' => 'Delete Employe']);
       
        

        Permission::create(['guard_name' => 'admin', 'name' => 'Show Trainer Table']);
        Permission::create(['guard_name' => 'admin', 'name' => 'Edit Trainer']);
        Permission::create(['guard_name' => 'admin', 'name' => 'Assign Role To Trainer']);
        Permission::create(['guard_name' => 'admin', 'name' => 'Delete Role From Trainer']);
        Permission::create(['guard_name' => 'admin', 'name' => 'Give Permission To Trainer']);
        Permission::create(['guard_name' => 'admin', 'name' => 'Revoke Permission From Trainer']);
        Permission::create(['guard_name' => 'admin', 'name' => 'Move Trainer To Archive']);
        Permission::create(['guard_name' => 'admin', 'name' => 'Add Trainer']);
        Permission::create(['guard_name' => 'admin', 'name' => 'Reset Password Trainer']);
        Permission::create(['guard_name' => 'admin', 'name' => 'Show Trainer Arcvive Table']);
        Permission::create(['guard_name' => 'admin', 'name' => 'Restore Trainer']);
        Permission::create(['guard_name' => 'admin', 'name' => 'Delete Trainer']);



        Permission::create(['guard_name' => 'admin', 'name' => 'Show Classes Table']);
        Permission::create(['guard_name' => 'admin', 'name' => 'Edit Class']);
        Permission::create(['guard_name' => 'admin', 'name' => 'Move Class To Archive']);
        Permission::create(['guard_name' => 'admin', 'name' => 'Add Class']);
        Permission::create(['guard_name' => 'admin', 'name' => 'Show Classes Arcvive Table']);
        Permission::create(['guard_name' => 'admin', 'name' => 'Restore Class']);
        Permission::create(['guard_name' => 'admin', 'name' => 'Delete Class']);



        Permission::create(['guard_name' => 'admin', 'name' => 'Show Courses Table']);
        Permission::create(['guard_name' => 'admin', 'name' => 'Edit Course']);
        Permission::create(['guard_name' => 'admin', 'name' => 'Move Course To Archive']);
        Permission::create(['guard_name' => 'admin', 'name' => 'Add Course']);
        Permission::create(['guard_name' => 'admin', 'name' => 'Show Courses Arcvive Table']);
        Permission::create(['guard_name' => 'admin', 'name' => 'Restore Course']);
        Permission::create(['guard_name' => 'admin', 'name' => 'Delete Course']);


        Permission::create(['guard_name' => 'admin', 'name' => 'Show Admin Table']);
        Permission::create(['guard_name' => 'admin', 'name' => 'Edit Admin']);
        Permission::create(['guard_name' => 'admin', 'name' => 'Assign Role To Admin']);
        Permission::create(['guard_name' => 'admin', 'name' => 'Delete Role From Admin']);
        Permission::create(['guard_name' => 'admin', 'name' => 'Give Permission To Admin']);
        Permission::create(['guard_name' => 'admin', 'name' => 'Revoke Permission From Admin']);
        Permission::create(['guard_name' => 'admin', 'name' => 'Move Admin To Archive']);
        Permission::create(['guard_name' => 'admin', 'name' => 'Add Admin']);
        Permission::create(['guard_name' => 'admin', 'name' => 'Reset Password Admin']);
        Permission::create(['guard_name' => 'admin', 'name' => 'Show Admin Arcvive Table']);
        Permission::create(['guard_name' => 'admin', 'name' => 'Restore Admin']);
        Permission::create(['guard_name' => 'admin', 'name' => 'Delete Admin']);


        Permission::create(['guard_name' => 'admin', 'name' => 'Show Roles Table']);
        Permission::create(['guard_name' => 'admin', 'name' => 'Give Permission To Role']);
        Permission::create(['guard_name' => 'admin', 'name' => 'Revok Permission From Role']);

        Permission::create(['guard_name' => 'admin', 'name' => 'Show Permissions Table']);
        Permission::create(['guard_name' => 'admin', 'name' => 'Assign Role To Permission']);
        Permission::create(['guard_name' => 'admin', 'name' => 'Revok Role From Permisiion']);


        Permission::create(['guard_name' => 'admin', 'name' => 'Show Reports Table']);
        Permission::create(['guard_name' => 'admin', 'name' => 'Delete Report']);

        Permission::create(['guard_name' => 'employe', 'name' => 'view trainer']);



    }
}
