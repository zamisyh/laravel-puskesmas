<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenangananOperasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penanganan_operasi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pasien');
            $table->string('nama_operasi');
            $table->string('ditangani_oleh');
            $table->string('tanggal_operasi');
            $table->string('status_pasien');
            $table->string('biaya');
            $table->string('dibayar');
            $table->string('kembalian');
            $table->text('keterangan');
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
        Schema::dropIfExists('penanganan_operasi');
    }
}
