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

        $pengawas = User::create([
            'name' => 'Pengawas',
            'email' => 'pengawas@gmail.com',
            'password' => bcrypt('qweqwe')
        ]);
        $pengawasrole = Role::create(['name' => 'Pengawas']);
        $pengawaspermissions = Permission::where('name', 'LIKE', "%{list}%")->pluck('id', 'id')->all();
        $pengawasrole->syncPermissions($pengawaspermissions);
        $pengawas->assignRole([$pengawasrole->id]);

        $dosenrole = Role::create(['name' => 'Dosen']);
        $dosens = [
            [
                'name' => 'Marwan Dhiaur Rahman S.Kom,',
                'email' => 'marwan@gmail.com',
                'password' => bcrypt('qweqwe')
            ],
            [
                'name' => 'Panji Novantara, S.Kom., M.T.',
                'email' => 'panji@gmail.com',
                'password' => bcrypt('qweqwe')
            ],
            [
                'name' => 'Heri Herwanto, S.Pd., M.Pd',
                'email' => 'heri@gmail.com',
                'password' => bcrypt('qweqwe')
            ],
            [
                'name' => 'Roni Nursyamsu, S.Pd., M.Pd.',
                'email' => 'roni@gmail.com',
                'password' => bcrypt('qweqwe')
            ],
            [
                'name' => 'Siti Maesyaroh, S.Kom., M.Kom.',
                'email' => 'siti@gmail.com',
                'password' => bcrypt('qweqwe')
            ],
            [
                'name' => '	Rio Andriyat Krisdiawan, S.Kom., M.Kom.',
                'email' => 'rio@gmail.com',
                'password' => bcrypt('qweqwe')
            ],
            [
                'name' => '	Fitra Nugraha, S.Kom., M.Kom.',
                'email' => 'fitra@gmail.com',
                'password' => bcrypt('qweqwe')
            ],
            [
                'name' => 'Sherly Gina Supratman, M.Kom.',
                'email' => 'sherly@gmail.com',
                'password' => bcrypt('qweqwe')
            ],
            [
                'name' => 'Yati Nurhayati, S.Kom., M.Kom.',
                'email' => 'yati@gmail.com',
                'password' => bcrypt('qweqwe')
            ], [
                'name' => 'Tito Sugiharto, S.Kom., M.Eng.',
                'email' => 'tito@gmail.com',
                'password' => bcrypt('qweqwe')
            ],
        ];

        foreach ($dosens as $dosen) {
            User::create($dosen)->assignRole([$dosenrole->id]);
        }
        // $dosen = User::create(
        //     [
        //         'name' => 'Marwan Dhiaur Rahman S.Kom,',
        //         'email' => 'marwan@gmail.com',
        //         'password' => bcrypt('qweqwe')
        //     ],
        // );


    }
}
