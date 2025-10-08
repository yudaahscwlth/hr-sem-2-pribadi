<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JabatanSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('jabatan')->insert([
            ['id_jabatan' => 1, 'nama_jabatan' => 'Staff'],
            ['id_jabatan' => 3, 'nama_jabatan' => 'Kepala'],
            ['id_jabatan' => 4, 'nama_jabatan' => 'Kepala Departemen'],
            ['id_jabatan' => 5, 'nama_jabatan' => 'Kepala Yayasan'],
        ]);
    }
}
