<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserUtamaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Data user utama sesuai dengan db/dummyhr.sql
     * 
     * Catatan: Password sudah di-hash di database asli
     * Untuk kemudahan testing, saya set password yang jelas
     */
    public function run(): void
    {
        DB::table('user')->insert([
            [
                'id_user' => 5,
                'username' => 'danu',
                'password' => Hash::make('danu123'), // Password: danu123
                'role' => 'pegawai',
                'id_pegawai' => 1,
                'created_at' => null,
                'updated_at' => null
            ],
            [
                'id_user' => 6,
                'username' => 'staff',
                'password' => Hash::make('staff123'), // Password: staff123
                'role' => 'hrd',
                'id_pegawai' => 2,
                'created_at' => null,
                'updated_at' => null
            ],
            [
                'id_user' => 20,
                'username' => 'ellsa',
                'password' => Hash::make('ellsa123'), // Password: ellsa123
                'role' => 'pegawai',
                'id_pegawai' => 5,
                'created_at' => null,
                'updated_at' => null
            ],
            [
                'id_user' => 22,
                'username' => 'ahmad',
                'password' => Hash::make('ahmad123'), // Password: ahmad123
                'role' => 'kepala_yayasan',
                'id_pegawai' => 6,
                'created_at' => '2025-07-09 06:28:10',
                'updated_at' => '2025-07-10 02:31:15'
            ],
            [
                'id_user' => 35,
                'username' => 'kepala',
                'password' => Hash::make('kepala123'), // Password: kepala123
                'role' => 'hrd',
                'id_pegawai' => 5,
                'created_at' => null,
                'updated_at' => null
            ],
        ]);

        echo "\n✅ User utama berhasil dibuat!\n";
        echo "═══════════════════════════════════════════\n";
        echo "Login Credentials:\n";
        echo "───────────────────────────────────────────\n";
        echo "1. Username: danu       | Password: danu123    | Role: Pegawai\n";
        echo "2. Username: staff      | Password: staff123   | Role: HRD\n";
        echo "3. Username: ellsa      | Password: ellsa123   | Role: Pegawai\n";
        echo "4. Username: ahmad      | Password: ahmad123   | Role: Kepala Yayasan\n";
        echo "5. Username: kepala     | Password: kepala123  | Role: HRD\n";
        echo "═══════════════════════════════════════════\n\n";
    }
}

