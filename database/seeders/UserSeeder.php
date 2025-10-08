<?php 
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        DB::table('user')->insert([
            'username' => 'kepala',
            'password' => Hash::make('danu'),
            'role' => 'kepala_yayasan', // bisa 'hrd', 'pegawai', atau 'kepala'
            'id_pegawai' => 3 // pastikan ini sesuai ID dari PegawaiSeeder
        ]);
    }
}


?>