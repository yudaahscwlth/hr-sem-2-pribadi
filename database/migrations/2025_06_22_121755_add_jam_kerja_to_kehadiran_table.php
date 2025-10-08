<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('kehadiran', function (Blueprint $table) { // atau 'absensi'
            // Tambah kolom untuk jam kerja
            $table->time('jam_pulang_minimum')->nullable()->after('waktu_pulang');
            $table->decimal('total_jam_kerja', 4, 2)->nullable()->after('jam_pulang_minimum');
            $table->string('durasi_kerja', 10)->nullable()->after('total_jam_kerja'); // Format HH:MM
            $table->enum('status_jam_kerja', ['Memenuhi', 'Kurang'])->nullable()->after('durasi_kerja');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kehadiran', function (Blueprint $table) {
            $table->dropColumn([
                'jam_pulang_minimum',
                'total_jam_kerja', 
                'durasi_kerja',
                'status_jam_kerja'
            ]);
        });
    }
};