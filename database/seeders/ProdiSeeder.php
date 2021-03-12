<?php

namespace Database\Seeders;

use App\Models\Prodi;
use Illuminate\Database\Seeder;

class ProdiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $prodis = [
            [
                'name' => 'Teknik Infomatika',
                'kode' => 'TI-FKOM',
                'fakultas_id' => '1'
            ],
            [
                'name' => 'Sistem Informasi',
                'kode' => 'SI-FKOM',
                'fakultas_id' => '1'
            ],
            [
                'name' => 'Desain Komunikasi Visual',
                'kode' => 'DKV-FKOM',
                'fakultas_id' => '1'
            ],
        ];

        foreach ($prodis as $prodi) {
            Prodi::create($prodi);
        }
    }
}
