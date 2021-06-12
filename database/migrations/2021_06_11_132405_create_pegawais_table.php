<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePegawaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pegawai', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_jabatan');
            $table->unsignedBigInteger('id_bidang');
            $table->string('nama_pegawai');
            $table->string('jenis_kelamin');
            $table->string('npwp');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->timestamps();

            $table->foreign('id_jabatan')->references('id')->on('jabatan')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_bidang')->references('id')->on('bidang')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pegawai');
    }
}
