<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerbaikanGizisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perbaikan_gizi', function (Blueprint $table) {
            $table->id();
            $table->string('nama_anak');
            $table->string('nama_tindakan');
            $table->string('nama_obat');
            $table->string('jumlah');
            $table->string('satuan');
            $table->date('tanggal');
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
        Schema::dropIfExists('perbaikan_gizi');
    }
}
