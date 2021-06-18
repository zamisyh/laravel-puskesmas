<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRiwayatTindakansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('riwayat_tindakan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_poli');
            $table->string('kode_penyakit');
            $table->unsignedBigInteger('id_tindakan');
            $table->string('no_rawat');
            $table->string('hasil_periksa');
            $table->string('keluhan');
            $table->string('cek_fisik');
            $table->string('temperatur');
            $table->string('tinggi_badan');
            $table->string('berat_badan');
            $table->string('tekanan_darah');
            $table->string('tekanan_nadi');
            $table->string('penunjang');
            $table->string('nama_obat');
            $table->string('no_rekammedis');
            $table->timestamps();

            $table->foreign('id_poli')->references('id')->on('poli')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_tindakan')->references('id')->on('tindakan')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('riwayat_tindakan');
    }
}
