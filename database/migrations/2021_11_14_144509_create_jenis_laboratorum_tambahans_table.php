<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJenisLaboratorumTambahansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jenis_laboratorum_tambahan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_laboratorium');
            $table->string('keterangan');
            $table->string('nilai');
            $table->string('satuan');
            $table->string('nilai_rujukan');
            $table->timestamps();
            $table->foreign('id_laboratorium')->references('id')->on('laboratorium')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jenis_laboratorum_tambahans');
    }
}
