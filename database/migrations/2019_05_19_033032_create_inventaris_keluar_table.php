<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventarisKeluarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventaris_keluar', function (Blueprint $table) {
            $table->bigIncrements('id_keluar');
            $table->unsignedBigInteger('id_inventaris');
            $table->foreign('id_inventaris')->references('id_inventaris')->on('inventaris')->onDelete('cascade');
            $table->string('kode_keluar',40)->unique();
            $table->string('penerima');
            $table->string('keperluan');
            $table->integer('jumlah_keluar');
            $table->date('tanggal_keluar');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventaris_keluar');
    }
}
