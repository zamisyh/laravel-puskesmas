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
            $table->string('tanngal_operasi');
            $table->string('biaya');
            $table->string('kembalian');
            $table->text('keterangan')->nullable();
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
