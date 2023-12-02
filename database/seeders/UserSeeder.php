<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'Super Admin',
            'username' => 'Superadmin',
            'phone_number' => '9845646116',
            'email' => 'admin@superadmin.com',
            'password' => 'password',
            'email_verified_at' => now(),
            'verify' => 1
        ]);
        $user = User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'phone_number' => '9845646116',
            'email' => 'admin@admin.com',
            'password' => 'password',
            'email_verified_at' => now(),
            'verify' => 1
        ]);
        $user = User::create([
            'name' => 'Customer',
            'username' => 'customer',
            'phone_number' => '9845646116',
            'email' => 'customer@mail.com',
            'password' => 'password',
            'email_verified_at' => now(),
            'verify' => 1
        ]);
        $user->save();
    }
}
