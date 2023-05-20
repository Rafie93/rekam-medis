<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRekamGigiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rekam_gigi', function (Blueprint $table) {
            $table->id();
            $table->integer('rekam_id');
            $table->integer('pasien_id');
            $table->string('elemen_gigi');
            $table->string('pemeriksaan')->nullable();
            $table->string('diagnosa')->nullable();
            $table->string('tindakan')->nullable();
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('rekam_gigi');
    }
}
