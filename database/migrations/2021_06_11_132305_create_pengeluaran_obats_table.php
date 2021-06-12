<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengeluaranObatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengeluaran_obat', function (Blueprint $table) {
            $table->id();
            $table->string('no_terima_obat');
            $table->unsignedBigInteger('id_pasien');
            $table->unsignedBigInteger('id_obat');
            $table->string('jumlah');
            $table->date('tanggal_serah_obat');
            $table->text('keterangan');
            $table->timestamps();

            $table->foreign('id_pasien')->references('id')->on('pasien')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_obat')->references('id')->on('obat')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengeluaran_obat');
    }
}
