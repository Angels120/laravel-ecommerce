<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

            $this->call(UserSeeder::class);
            $this->call(PermissionSeeder::class);
            $this->call(RolesSeeder::class);
            $this->call(UserRoleSeeder::class);
            $this->call(UsersPermissionSeeder::class);
            $this->call(ProvinceSeeder::class);
            $this->call(CitySeeder::class);
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
