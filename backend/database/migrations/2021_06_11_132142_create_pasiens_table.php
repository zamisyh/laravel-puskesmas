<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Complex\tanh;

class CreatePasiensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pasien', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_jaminan');
            $table->string('no_kk');
            $table->string('no_antrian');
            $table->string('nama_pasien');
            $table->string('nama_kk');
            $table->string('usia');
            $table->string('kode_paramedis');
            $table->string('no_ktp');
            $table->string('no_jaminan');
            $table->string('jenis_kelamin');
            $table->date('tanggal_lahir');
            $table->date('tanggal_lahir_kk');
            $table->string('jenis_kelamin_kk');
            $table->string('alamat');
            $table->string('nama_faskes');
            $table->string('hubungan_dengan_penanggung_jawab');
            $table->string('status_pasien');
            $table->string('wilayah');
            $table->string('keterangan');
            $table->timestamps();


            $table->foreign('id_jaminan')->references('id')->on('jaminan')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pasien');
    }
}
