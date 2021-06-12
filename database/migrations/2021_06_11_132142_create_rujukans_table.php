<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRujukansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rujukan', function (Blueprint $table) {
            $table->id();
            $table->string('no_rujukan');
            $table->unsignedBigInteger('id_pasien');
            $table->string('nama_penyakit');
            $table->string('diagnosa');
            $table->string('nama_rumah_sakit');
            $table->string('poli_tujuan');
            $table->date('tanggal_rujukan');
            $table->string('no_rawat');
            $table->timestamps();


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
        Schema::dropIfExists('rujukan');
    }
}
