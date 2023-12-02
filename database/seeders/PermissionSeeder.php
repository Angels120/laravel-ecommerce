<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'crud_role']);
        Permission::create(['name' => 'create_category']);
        Permission::create(['name' => 'read_category']);
        Permission::create(['name' => 'update_category']);
        Permission::create(['name' => 'delete_category']);
        Permission::create(['name' => 'create_product']);
        Permission::create(['name' => 'read_product']);
        Permission::create(['name' => 'update_product']);
        Permission::create(['name' => 'delete_product']);
        Permission::create(['name' => 'create_brand']);
        Permission::create(['name' => 'read_brand']);
        Permission::create(['name' => 'update_brand']);
        Permission::create(['name' => 'delete_brand']);
        Permission::create(['name' => 'create_subcategory']);
        Permission::create(['name' => 'read_subcategory']);
        Permission::create(['name' => 'update_subcategory']);
        Permission::create(['name' => 'delete_subcategory']);
        Permission::create(['name' => 'create_user']);
        Permission::create(['name' => 'read_user']);
        Permission::create(['name' => 'update_user']);
        Permission::create(['name' => 'delete_user']);
    }
}
