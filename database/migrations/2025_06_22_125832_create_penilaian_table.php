<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenilaianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penilaian', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            // Relasi periode kuisioner
            $table->unsignedBigInteger('periode_id');
            
            // Relasi pegawai
            $table->integer('dinilai_pegawai_id');
            $table->integer('penilai_pegawai_id');

            // Kolom lain
            $table->string('status')->default('draft');
            $table->timestamps();

            // Foreign keys
            $table->foreign('periode_id')
                  ->references('id')->on('periode_kuisioner')
                  ->onDelete('cascade');

            $table->foreign('dinilai_pegawai_id')
                  ->references('id_pegawai')
                  ->on('pegawai')
                  ->onDelete('cascade');

            $table->foreign('penilai_pegawai_id')
                  ->references('id_pegawai')
                  ->on('pegawai')
                  ->onDelete('cascade');
                  });
            }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penilaian');
    }
}
