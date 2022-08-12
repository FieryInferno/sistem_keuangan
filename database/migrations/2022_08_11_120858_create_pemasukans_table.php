<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up()
  {
    Schema::create('pemasukans', function (Blueprint $table) {
      $table->id();
      $table->string('no_pemasukan');
      $table->date('tanggal');
      $table->enum('jenis_pemasukan', ['barang', 'jasa']);
      $table->foreignId('jasa_id')->constrained('jasas')->onUpdate('cascade')->onDelete('cascade')->nullable();
      $table->foreignId('barang_id')->constrained('barangs')->onUpdate('cascade')->onDelete('cascade')->nullable();
      $table->integer('harga');
      $table->integer('qty');
      $table->integer('diskon');
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
        Schema::dropIfExists('pemasukans');
    }
};
