<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
    {
        Schema::create('lokasi_kantor', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_lokasi', 255);
            $table->decimal('latitude', 10, 8);
            $table->decimal('longitude', 11, 8);
            $table->enum('status', ['aktif', 'nonaktif']);
            $table->integer('radius_meter')->default(100);
            $table->timestamps();
            
            // Indexes
            $table->index('status');
        });
    }

    public function down()
    {
        Schema::dropIfExists('lokasi_kantor');
    }
};
