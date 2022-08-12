<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up()
  {
    Schema::create('pengeluarans', function (Blueprint $table) {
      $table->id();
      $table->string('no_pengeluaran');
      $table->date('tanggal');
      $table->string('nama_kas_keluar');
      $table->integer('harga');
      $table->integer('qty');
      $table->string('keterangan');
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
        Schema::dropIfExists('pengeluarans');
    }
};
