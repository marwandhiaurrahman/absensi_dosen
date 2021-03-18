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
            'fakultas-setup',
            'prodi-list',
            'prodi-setup',
            'kelas-list',
            'kelas-setup',
            'ruangan-list',
            'ruangan-setup',
            'gedung-list',
            'gedung-setup',
            'matkul-list',
            'matkul-setup',
            'jamkul-list',
            'jamkul-setup',
            'jadwal-list',
            'jadwal-setup',
            'absensi-list',
            'absensi-setup',
            'lokasi-absensi-list',
            'lokasi-absensi-setup',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
