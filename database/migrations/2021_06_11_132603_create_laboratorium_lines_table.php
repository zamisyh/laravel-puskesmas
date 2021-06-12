<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaboratoriumLinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laboratorium_line', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_laboratorium');
            $table->unsignedBigInteger('id_jenis_laboratorium');
            $table->string('hasil');
            $table->timestamps();

            $table->foreign('id_laboratorium')->references('id')->on('laboratorium')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_jenis_laboratorium')->references('id')->on('jenis_laboratorium')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('laboratorium_line');
    }
}
