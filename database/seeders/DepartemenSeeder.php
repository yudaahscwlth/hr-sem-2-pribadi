<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartemenSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('departemen')->insert([
            ['id_departemen' => 1, 'nama_departemen' => 'Teknologi Informasi', 'kepala_departemen' => null],
            ['id_departemen' => 2, 'nama_departemen' => 'Keuangan', 'kepala_departemen' => null],
            ['id_departemen' => 3, 'nama_departemen' => 'Sumber Daya Manusia', 'kepala_departemen' => null],
        ]);
    }
}
