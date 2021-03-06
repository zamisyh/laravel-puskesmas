<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResepObatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resep_obat', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_obat');
            $table->unsignedBigInteger('id_pasien');
            $table->unsignedBigInteger('id_poli');
            $table->string('jenis_obat');
            $table->string('dosis');
            $table->string('jumlah_obat');
            $table->string('no_rawat');
            $table->string('no_rekammedis');
            $table->boolean('alergi_obat')->default(false);
            $table->text('keterangan_alergi');
            $table->timestamps();
            $table->foreign('id_obat')->references('id')->on('obat')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_pasien')->references('id')->on('pasien')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_poli')->references('id')->on('poli')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('resep_obat');
    }
}
