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
      $table->string('nama');
      $table->foreignId('jasa_id')->constrained('jasas')->onUpdate('cascade')->onDelete('cascade');
      $table->integer('tip');
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
