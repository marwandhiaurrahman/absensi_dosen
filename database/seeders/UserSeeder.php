<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('qweqwe')
        ]);
        $role = Role::create(['name' => 'Admin']);
        $permissions = Permission::pluck('id', 'id')->all();
        $role->syncPermissions($permissions);
        $user->assignRole([$role->id]);

        $dosen = User::create([
            'name' => 'Marwan Dhiaur Rahman S.Kom,',
            'email' => 'marwan@gmail.com',
            'password' => bcrypt('qweqwe')
        ]);
        $dosenrole = Role::create(['name' => 'Dosen']);
        $dosen->assignRole([$dosenrole->id]);
    }
}
