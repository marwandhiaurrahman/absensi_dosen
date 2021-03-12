<?php

namespace Database\Seeders;

use App\Models\Ruangan;
use Illuminate\Database\Seeder;

class RuanganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ruangans = [
            [
                'name' => 'A',
                'lantai' => '1',
                'gedung_id' => '1',
                'kode' => '2-A',
            ],
            [
                'name' => 'B',
                'lantai' => '1',
                'gedung_id' => '1',
                'kode' => '2-B',
            ],
            [
                'name' => 'C',
                'lantai' => '1',
                'gedung_id' => '1',
                'kode' => '2-C',
            ],
            [
                'name' => 'D',
                'lantai' => '1',
                'gedung_id' => '1',
                'kode' => '2-D',
            ],
        ];

        foreach ($ruangans as $ruangan) {
            Ruangan::create($ruangan);
        }
    }
}
