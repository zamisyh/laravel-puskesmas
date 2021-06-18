<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKesehatanIbuAnaksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kesehatan_ibu_anak', function (Blueprint $table) {
            $table->id();
            $table->string('no_kia');
            $table->string('no_bpjs');
            $table->string('status_pasien');
            $table->string('nama_operasi');
            $table->string('biaya');
            $table->string('ditangani_oleh');
            $table->string('dibayar');
            $table->string('kembalian');
            $table->text('keterangan');
            $table->date('tanggal_tindakan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kesehatan_ibu_anak');
    }
}
