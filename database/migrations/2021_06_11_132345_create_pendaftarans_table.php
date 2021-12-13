<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePendaftaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pendaftaran', function (Blueprint $table) {
            $table->id();
            $table->string('no_rekammedis');
            $table->string('no_rawat');
            $table->date('tanggal_daftar');
            $table->unsignedBigInteger('id_dokter');
            $table->unsignedBigInteger('id_poli');
            $table->unsignedBigInteger('id_pasien');
            $table->string('status_pasien');
            $table->string('no_jaminan');
            $table->timestamps();

            $table->foreign('id_dokter')->references('id')->on('dokter')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_poli')->references('id')->on('poli')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_pasien')->references('id')->on('pasien')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pendaftaran');
    }
}
