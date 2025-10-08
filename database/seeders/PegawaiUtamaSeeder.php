<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PegawaiUtamaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Data pegawai utama sesuai dengan db/dummyhr.sql
     */
    public function run(): void
    {
        DB::table('pegawai')->insert([
            [
                'id_pegawai' => 1,
                'nama' => 'Danu Pratamaa',
                'tempat_lahir' => 'Batam',
                'tanggal_lahir' => '2000-01-01',
                'jenis_kelamin' => 'L',
                'alamat' => 'Jalan Contoh No. 1',
                'status' => 'Aktif',
                'no_hp' => '081234567899',
                'email' => 'danu123@example.com',
                'id_jabatan' => 1,
                'id_departemen' => 1,
                'tanggal_masuk' => '2023-01-01',
                'foto' => '1750652925_Screenshot 2025-01-05 192720.png',
                'jatahtahunan' => 12
            ],
            [
                'id_pegawai' => 2,
                'nama' => 'Danu Yudistia',
                'tempat_lahir' => 'Batam',
                'tanggal_lahir' => '2000-01-01',
                'jenis_kelamin' => 'L',
                'alamat' => 'Jalan Contoh No. 1',
                'status' => 'Aktif',
                'no_hp' => '081234567890',
                'email' => 'danu@example.com',
                'id_jabatan' => 1,
                'id_departemen' => 3,
                'tanggal_masuk' => '2023-01-01',
                'foto' => '1748753152_php-programming-language.png',
                'jatahtahunan' => 12
            ],
            [
                'id_pegawai' => 3,
                'nama' => 'asep',
                'tempat_lahir' => 'Batam',
                'tanggal_lahir' => '2005-11-16',
                'jenis_kelamin' => 'L',
                'alamat' => 'Batam,Bengkong Laut Komplek Nurul jadid',
                'status' => 'Aktif',
                'no_hp' => '0895605268996',
                'email' => 'danulegend@gmail.com',
                'id_jabatan' => 3,
                'id_departemen' => 3,
                'tanggal_masuk' => '2025-05-26',
                'foto' => 'user1.png',
                'jatahtahunan' => 12
            ],
            [
                'id_pegawai' => 5,
                'nama' => 'ellsa',
                'tempat_lahir' => 'Batam',
                'tanggal_lahir' => '2005-11-16',
                'jenis_kelamin' => 'P',
                'alamat' => 'Bengkong',
                'status' => 'Aktif',
                'no_hp' => '08971231222',
                'email' => 'danuhuet@gmail.com',
                'id_jabatan' => 1,
                'id_departemen' => 1,
                'tanggal_masuk' => '2025-06-01',
                'foto' => '1751540547_d211887986130e9673fde71384c0a024.jpg',
                'jatahtahunan' => 0
            ],
            [
                'id_pegawai' => 6,
                'nama' => 'Ahmad Yanii',
                'tempat_lahir' => 'batam',
                'tanggal_lahir' => '2025-06-05',
                'jenis_kelamin' => 'L',
                'alamat' => 'awdawdawd',
                'status' => 'Aktif',
                'no_hp' => '089123123',
                'email' => 'awdawijd@mail.com',
                'id_jabatan' => 5,
                'id_departemen' => 1,
                'tanggal_masuk' => '2025-06-05',
                'foto' => '1752113741_rapi.jpg',
                'jatahtahunan' => 1
            ],
            [
                'id_pegawai' => 17,
                'nama' => 'Zahra Ghaliyati Pratiwi',
                'tempat_lahir' => 'Yogyakarta',
                'tanggal_lahir' => '1984-07-03',
                'jenis_kelamin' => 'P',
                'alamat' => 'Psr. Qrisdoren No. 441, Gunungsitoli 44021, Sumut',
                'status' => 'Aktif',
                'no_hp' => '(+62) 799 6600 7515',
                'email' => 'zahra.ghaliyati.pratiwi@company.com',
                'id_jabatan' => 1,
                'id_departemen' => 1,
                'tanggal_masuk' => '2016-10-10',
                'foto' => 'avatar-1.jpg',
                'jatahtahunan' => 13
            ],
            [
                'id_pegawai' => 18,
                'nama' => 'Ibrahim Martana Hakim',
                'tempat_lahir' => 'Denpasar',
                'tanggal_lahir' => '1991-09-22',
                'jenis_kelamin' => 'L',
                'alamat' => 'Ki. Elang No. 195, Banjar 38781, Kaltara',
                'status' => 'Aktif',
                'no_hp' => '0332 2697 9870',
                'email' => 'ibrahim.martana.hakim@company.com',
                'id_jabatan' => 1,
                'id_departemen' => 2,
                'tanggal_masuk' => '2017-03-05',
                'foto' => 'avatar-1.jpg',
                'jatahtahunan' => 17
            ],
            [
                'id_pegawai' => 19,
                'nama' => 'Betania Kusmawati',
                'tempat_lahir' => 'Bengkulu',
                'tanggal_lahir' => '1978-10-29',
                'jenis_kelamin' => 'P',
                'alamat' => 'Gg. Batako No. 238, Bontang 20872, Papua',
                'status' => 'Aktif',
                'no_hp' => '(+62) 279 1024 049',
                'email' => 'betania.kusmawati@company.com',
                'id_jabatan' => 1,
                'id_departemen' => 1,
                'tanggal_masuk' => '2023-04-08',
                'foto' => 'avatar-1.jpg',
                'jatahtahunan' => 23
            ],
            [
                'id_pegawai' => 20,
                'nama' => 'Darman Simbolon',
                'tempat_lahir' => 'Jakarta',
                'tanggal_lahir' => '2004-04-25',
                'jenis_kelamin' => 'P',
                'alamat' => 'Psr. Adisumarmo No. 814, Bekasi 91093, NTB',
                'status' => 'Aktif',
                'no_hp' => '(+62) 888 6092 309',
                'email' => 'darman.simbolon@company.com',
                'id_jabatan' => 1,
                'id_departemen' => 1,
                'tanggal_masuk' => '2020-04-16',
                'foto' => '1757312017_IMG-20250824-WA0009.jpg',
                'jatahtahunan' => 18
            ],
        ]);
    }
}

