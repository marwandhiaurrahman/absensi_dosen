<?php

namespace Database\Seeders;

use App\Models\Jadwal;
use Illuminate\Database\Seeder;

class JadwalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jadwals = [
            [
                'kode' => '1-1-1-1-1',
                'hari' => '1',
                'jam' => '1',
                'matkul_id' => '1',
                'ruangan_id' => '1',
                'kelas_id' => '1',
            ],
            [
                'kode' => '2-2-2-2-2',
                'hari' => '2',
                'jam' => '2',
                'matkul_id' => '2',
                'ruangan_id' => '2',
                'kelas_id' => '2',
            ],
            [
                'kode' => '3-3-3-3-3',
                'hari' => '3',
                'jam' => '3',
                'matkul_id' => '3',
                'ruangan_id' => '3',
                'kelas_id' => '3',
            ],
        ];

        foreach ($jadwals as $jadwal) {
            Jadwal::create($jadwal);
        }
    }
}
