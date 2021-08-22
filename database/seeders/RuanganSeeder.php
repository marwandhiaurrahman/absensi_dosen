<?php

namespace Database\Seeders;

use App\Models\Ruangan;
use Grimzy\LaravelMysqlSpatial\Types\Point;
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
                'name' => 'BLK',
                'lantai' => '1',
                'gedung_id' => '1',
                'kode' => '1-BLK',
                'location'=>new Point( 108.53034806227015, -6.9700328468642585),
            ],
            [
                'name' => 'A',
                'lantai' => '1',
                'gedung_id' => '2',
                'kode' => '1-A',
                'location'=>new Point( 108.50011606548821, -6.975710101143071 ),

            ],
            [
                'name' => 'B',
                'lantai' => '1',
                'gedung_id' => '2',
                'kode' => '1-B',
                'location'=>new Point( 108.49994062924252, -6.975649858933238 ),

            ],
            [
                'name' => 'C',
                'lantai' => '1',
                'gedung_id' => '1',
                'kode' => '1-C',
                'location'=>new Point( 108.50026118380549, -6.975750730011024),
            ],
        ];

        foreach ($ruangans as $ruangan) {
            Ruangan::create($ruangan);
        }
    }
}
