<?php

namespace Database\Seeders;

use App\Models\Matkul;
use Illuminate\Database\Seeder;

class MatkulSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $matkuls = [
            [
                'name' => 'Pemograman Web 1',
                'kode' => 'WEB1',
                'user_id' => '3'
            ],
            [
                'name' => 'Desain Digital',
                'kode' => 'DESAIN1',
                'user_id' => '3'
            ],
            [
                'name' => 'Algoritma Pemograman',
                'kode' => 'ALGO',
                'user_id' => '3'
            ],
            [
                'name' => 'Praktikum Sistem Teknologi Basis Data',
                'kode' => 'TINFCW20',
                'user_id' => '4'
            ],
            [
                'name' => 'Praktikum Statistika',
                'kode' => 'TINFCW06',
                'user_id' => '5'
            ], [
                'name' => 'English Communication For IT',
                'kode' => 'FKOM0W09',
                'user_id' => '6'
            ], [
                'name' => 'Pemrograman Berorientasi Objek',
                'kode' => 'TINFCW24',
                'user_id' => '7'
            ], [
                'name' => 'Bahasa Pemrograman 2',
                'kode' => 'TINFCW29',
                'user_id' => '8'
            ], [
                'name' => 'Jaringan Komputer',
                'kode' => 'FKOM0W03',
                'user_id' => '9'
            ], [
                'name' => 'Kecerdasan Buatan',
                'kode' => 'TINFCW34',
                'user_id' => '10'
            ],
        ];
        foreach ($matkuls as $matkul) {
            Matkul::create($matkul);
        }
    }
}
