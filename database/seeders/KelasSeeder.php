<?php

namespace Database\Seeders;

use App\Models\Kelas;
use Illuminate\Database\Seeder;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kelass = [
            [
                'name' => 'A',
                'tahun' => '2017',
                'prodi_id' => '1',
                'kode' => 'TI-FKOM-2017-A',
            ],
            [
                'name' => 'B',
                'tahun' => '2017',
                'prodi_id' => '1',
                'kode' => 'TI-FKOM-2017-B',
            ],
            [
                'name' => 'C',
                'tahun' => '2017',
                'prodi_id' => '1',
                'kode' => 'TI-FKOM-2017-C',
            ],
            [
                'name' => 'D',
                'tahun' => '2017',
                'prodi_id' => '1',
                'kode' => 'TI-FKOM-2017-D',
            ],
        ];

        foreach ($kelass as $kelas) {
            Kelas::create($kelas);
        }
    }
}
