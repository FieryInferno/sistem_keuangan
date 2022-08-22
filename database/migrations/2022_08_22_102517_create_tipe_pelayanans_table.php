<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up()
  {
    Schema::create('tipe_pelayanans', function (Blueprint $table) {
      $table->id();
      $table->foreignId('jasa_id')->constrained('jasas');
      $table->string('tipe');
      $table->integer('harga');
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
        Schema::dropIfExists('tipe_pelayanans');
    }
};
