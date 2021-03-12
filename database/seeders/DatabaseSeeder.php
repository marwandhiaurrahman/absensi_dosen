<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PermissionSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(FakultaSeeder::class);
        $this->call(ProdiSeeder::class);
        $this->call(KelasSeeder::class);
        $this->call(GedungSeeder::class);
        $this->call(RuanganSeeder::class);
        $this->call(MatkulSeeder::class);
    }
}
