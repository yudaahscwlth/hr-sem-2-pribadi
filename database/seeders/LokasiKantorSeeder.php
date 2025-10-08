<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use App\Models\LokasiKantor;

class LokasiKantorSeeder extends Seeder
{
    public function run()
    {
        // Data sesuai dengan db/dummyhr.sql
        LokasiKantor::insert([
            [
                'id' => 3,
                'nama_lokasi' => 'Kantor 1',
                'latitude' => 1.12003760,
                'longitude' => 104.04497850,
                'status' => 'aktif',
                'radius_meter' => 100,
                'created_at' => '2025-06-17 21:05:21',
                'updated_at' => '2025-07-15 12:46:05'
            ],
            [
                'id' => 4,
                'nama_lokasi' => 'Kantor 2',
                'latitude' => 1.11083520,
                'longitude' => 104.04495360,
                'status' => 'aktif',
                'radius_meter' => 300,
                'created_at' => '2025-06-21 21:02:45',
                'updated_at' => '2025-07-11 06:22:13'
            ],
            [
                'id' => 5,
                'nama_lokasi' => 'kantor deny',
                'latitude' => 1.15446000,
                'longitude' => 104.03768000,
                'status' => 'aktif',
                'radius_meter' => 100,
                'created_at' => '2025-09-06 15:48:57',
                'updated_at' => '2025-09-06 15:49:50'
            ],
            [
                'id' => 6,
                'nama_lokasi' => 'poltek',
                'latitude' => 1.11890000,
                'longitude' => 104.04841000,
                'status' => 'aktif',
                'radius_meter' => 1000,
                'created_at' => '2025-09-08 01:38:15',
                'updated_at' => '2025-09-08 01:38:15'
            ],
            [
                'id' => 7,
                'nama_lokasi' => 'rafles',
                'latitude' => 1.05063580,
                'longitude' => 103.97785824,
                'status' => 'aktif',
                'radius_meter' => 1000,
                'created_at' => '2025-10-03 02:28:37',
                'updated_at' => '2025-10-03 02:28:37'
            ],
        ]);
    }
}
