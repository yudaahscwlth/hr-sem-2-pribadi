<?php

namespace Database\Seeders;

use App\Models\PeriodePenilaian;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            // Master Data (sesuai db/dummyhr.sql)
            DepartemenSeeder::class,
            JabatanSeeder::class,
            JenisCutiSeeder::class,
            LokasiKantorSeeder::class,
            
            // Data Pegawai & User Utama
            PegawaiUtamaSeeder::class,
            UserUtamaSeeder::class,
            
            // Uncomment jika diperlukan:
            // PegawaiSeeder::class, // Untuk generate pegawai random tambahan
            // KehadiranSeeder::class,
            // KuisionerSeeder::class,
            // PeriodePenilaianSeeder::class,
        ]);
        
    }
}
