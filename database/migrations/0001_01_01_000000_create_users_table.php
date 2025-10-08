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
        Schema::create('user', function (Blueprint $table) {
            $table->integer('id_user')->primary()->autoIncrement();
            $table->string('username', 255)->unique();
            $table->string('password', 255);
            $table->enum('role', ['pegawai', 'hrd', 'kepala_yayasan']);
            $table->integer('id_pegawai')->nullable();
            $table->timestamps();
            
            // Indexes
            $table->index('id_pegawai');
            $table->index('role');
            
            // Foreign key akan ditambahkan di migration terpisah setelah tabel pegawai dibuat
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user');
    }
};
