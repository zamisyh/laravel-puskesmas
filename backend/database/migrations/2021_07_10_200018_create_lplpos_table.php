<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLplposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lplpos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_obat');
            $table->string('penerimaan');
            $table->string('persediaan');
            $table->string('pemakaian');
            $table->string('rusak');
            $table->string('recal');
            $table->string('stock_akhir');
            $table->string('rko');
            $table->string('stock_opt');
            $table->string('permintaan');
            $table->string('pemberian');
            $table->text('keterangan');
            $table->timestamps();


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
        Schema::dropIfExists('lplpos');
    }
}
