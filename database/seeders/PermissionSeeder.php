<?php

namespace Database\Seeders;

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
        $permissions = [
            'role-list',
            'role-setup',
            'user-list',
            'user-setup',
            'fakultas-list',
            'prodi-list',
            'kelas-list',
            'ruangan-list',
            'gedung-list',
            'matkul-list',
            'jamkul-list',
            'jadwal-list',
            'absensi-list',
            'lokasi-absensi-list',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
