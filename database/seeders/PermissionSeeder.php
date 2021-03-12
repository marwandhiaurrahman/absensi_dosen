<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'role-list',
            'role-setup',
            'product-list',
            'product-create',
            'product-edit',
            'product-delete',
            'user-list',
            'user-setup',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
        Role::create(['name' => 'User']);
    }
}
