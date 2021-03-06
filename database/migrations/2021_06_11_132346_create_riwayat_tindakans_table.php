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
            $table->unsignedBigInteger('id_pasien');
            $table->unsignedBigInteger('id_pendaftaran');
            $table->string('nama_tindakan');
            $table->string('no_rawat');
            $table->string('hasil_periksa');
            $table->string('keluhan');
            $table->string('cek_fisik');
            $table->string('temperatur');
            $table->string('tinggi_badan');
            $table->string('tekanan_darah');
            $table->string('tekanan_nadi');
            $table->string('penunjang');
            $table->string('hr');
            $table->string('rr');
            $table->string('bb');
            $table->string('lp');
            $table->string('imt');
            $table->string('jenis_kasus');
            $table->string('rencana_pengobatan');
            $table->string('no_rekamedis');
            $table->timestamps();

            $table->foreign('id_poli')->references('id')->on('poli')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_pasien')->references('id')->on('pasien')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_pendaftaran')->references('id')->on('pendaftaran')->onDelete('cascade')->onUpdate('cascade');
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
