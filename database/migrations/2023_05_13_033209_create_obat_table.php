<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('obat', function (Blueprint $table) {
            $table->id();
            $table->string('kd_obat')->nullable();
            $table->string('nama');
            $table->string('satuan');
            $table->date('tgl_masuk');
            $table->date('tgl_keluar');
            $table->integer('jumlah');
            $table->string('foto')->nullable();
            $table->integer('harga')->default(0);
            $table->integer('is_bpjs')->default(1);
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
        Schema::dropIfExists('obat');
    }
}
