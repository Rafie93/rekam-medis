<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRekamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rekam', function (Blueprint $table) {
            $table->id();
            $table->string('no_rekam');
            $table->string('tgl_rekam');
            $table->integer('pasien_id')->unsigned();
            $table->integer('dokter_id')->unsigned();
            $table->string('poli');
            $table->string('keluhan'); //Anam Nesa
            $table->string('pemeriksaan')->nullable();
            $table->string('diagnosa')->nullable();
            $table->string('tindakan')->nullable();
            $table->integer('biaya_pemeriksaan')->defaul(0);
            $table->integer('biaya_tindakan')->defaul(0);
            $table->integer('biaya_obat')->defaul(0);
            $table->integer('total_biaya')->defaul(0);
            $table->string('cara_bayar')->nullable();
            $table->integer('status')->default(1);
            $table->integer('petugas_id')->unsigned();

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
        Schema::dropIfExists('rekam');
    }
}
