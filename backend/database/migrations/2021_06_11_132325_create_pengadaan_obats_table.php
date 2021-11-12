<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengadaanObatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengadaan_obat', function (Blueprint $table) {
            $table->id();
            $table->string('no_trans');
            $table->unsignedBigInteger('id_supplier');
            $table->unsignedBigInteger('id_obat');
            $table->string('harga_beli');
            $table->string('jumlah');
            $table->text('keterangan');
            $table->string('total');
            $table->date('tanggal_transaksi');
            $table->timestamps();

            $table->foreign('id_supplier')->references('id')->on('suppliers')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('pengadaan_obat');
    }
}
