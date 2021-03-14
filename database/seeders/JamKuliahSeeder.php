<?php

namespace Database\Seeders;

use App\Models\JamKuliah;
use Illuminate\Database\Seeder;

class JamKuliahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jamkuls = [
            [
                'masuk' => '07:00',
                'keluar' => '08:30',
                'sks' => '2'
            ],
            [
                'masuk' => '09:00',
                'keluar' => '10:30',
                'sks' => '2'
            ],
            [
                'masuk' => '10:45',
                'keluar' => '11:55',
                'sks' => '2'
            ],
            [
                'masuk' => '07:00',
                'keluar' => '09:15',
                'sks' => '3'
            ],
            [
                'masuk' => '09:30',
                'keluar' => '11:45',
                'sks' => '3'
            ],
        ];

        foreach ($jamkuls as $jamkul) {
            JamKuliah::create($jamkul);
        }
    }
}
