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
            [
                'kode' => '4-3-4-2-1',
                'hari' => '4',
                'jam' => '3',
                'matkul_id' => '4',
                'ruangan_id' => '2',
                'kelas_id' => '1',
            ],
            [
                'kode' => '1-2-5-2-1',
                'hari' => '1',
                'jam' => '2',
                'matkul_id' => '5',
                'ruangan_id' => '2',
                'kelas_id' => '1',
            ],
            [
                'kode' => '1-3-6-2-1',
                'hari' => '1',
                'jam' => '3',
                'matkul_id' => '6',
                'ruangan_id' => '2',
                'kelas_id' => '1',
            ],
            [
                'kode' => '2-3-7-2-1',
                'hari' => '2',
                'jam' => '3',
                'matkul_id' => '7',
                'ruangan_id' => '2',
                'kelas_id' => '1',
            ],
            [
                'kode' => '5-1-7-2-1',
                'hari' => '5',
                'jam' => '1',
                'matkul_id' => '8',
                'ruangan_id' => '2',
                'kelas_id' => '1',
            ],
            [
                'kode' => '6-2-9-2-1',
                'hari' => '6',
                'jam' => '2',
                'matkul_id' => '9',
                'ruangan_id' => '2',
                'kelas_id' => '1',
            ],
            [
                'kode' => '3-1-10-2-1',
                'hari' => '3',
                'jam' => '1',
                'matkul_id' => '10',
                'ruangan_id' => '2',
                'kelas_id' => '1',
            ],
        ];

        foreach ($jadwals as $jadwal) {
            Jadwal::create($jadwal);
        }
    }
}
