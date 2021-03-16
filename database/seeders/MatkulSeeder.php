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
                'user_id' => '2'
            ],
            [
                'name' => 'Desain Digital',
                'kode' => 'DESAIN1',
                'user_id' => '2'
            ],
            [
                'name' => 'Algoritma Pemograman',
                'kode' => 'ALGO',
                'user_id' => '2'
            ],
        ];
        foreach ($matkuls as $matkul) {
            Matkul::create($matkul);
        }
    }
}
