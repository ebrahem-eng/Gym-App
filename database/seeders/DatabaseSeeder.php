<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call(RoleSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(DaySeeder::class);
        $this->call(TimeSeeder::class);
        $this->call(EmployeSeeder::class);
        $this->call(TrainerSeeder::class);
        $this->call(PlayerSeeder::class);
        $this->call(Permission_RoleSeeder::class);
        
    }
}
