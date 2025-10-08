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
        Schema::create('kehadiran', function (Blueprint $table) {
            $table->integer('id_kehadiran')->primary()->autoIncrement();
            $table->integer('id_pegawai');
            $table->date('tanggal');
            $table->integer('lokasi_kantor_id');
            $table->dateTime('waktu_masuk');
            $table->timestamp('waktu_pulang')->nullable();
            $table->decimal('total_jam_kerja', 4, 2)->nullable();
            $table->string('durasi_kerja', 10)->nullable();
            $table->enum('status_jam_kerja', ['Memenuhi', 'Kurang', 'Setengah Hari'])->nullable();
            $table->enum('status_kehadiran', ['Hadir', 'Tidak Hadir', 'Terlambat', 'Sakit', 'Izin']);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
            
            // Foreign keys
            $table->foreign('id_pegawai')
                  ->references('id_pegawai')
                  ->on('pegawai')
                  ->onDelete('cascade');
                  
            $table->foreign('lokasi_kantor_id')
                  ->references('id')
                  ->on('lokasi_kantor')
                  ->onDelete('cascade');
            
            // Indexes
            $table->index('id_pegawai');
            $table->index('lokasi_kantor_id');
            $table->index('tanggal');
            $table->index('status_kehadiran');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kehadiran');
    }
};

