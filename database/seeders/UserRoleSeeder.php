<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Assign role with ID 1 to user with ID 1
        $user1 = User::find(1);
        $role1 = Role::find(1);

        if ($user1 && $role1) {
            $user1->assignRole($role1);
        }

        // Assign role with ID 2 to user with ID 2
        $user2 = User::find(2);
        $role2 = Role::find(2);

        if ($user2 && $role2) {
            $user2->assignRole($role2);
        }

        // Assign role with ID 3 to user with ID 3
        $user3 = User::find(3);
        $role3 = Role::find(3);

        if ($user3 && $role3) {
            $user3->assignRole($role3);
        }
    }
}
