<?php

namespace Database\Seeders;

use App\Models\Gedung;
use Illuminate\Database\Seeder;

class GedungSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $gedungs = [
            'Gedung FKOM A',
            'Gedung FKOM B',
            'Gedung Rektorat',
        ];

        foreach ($gedungs as $gedung) {
            Gedung::create(['name' => $gedung]);
        }
    }
}
