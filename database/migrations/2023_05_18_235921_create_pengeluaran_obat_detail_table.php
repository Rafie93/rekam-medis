<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengeluaranObatDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengeluaran_obat_detail', function (Blueprint $table) {
            $table->id();
            $table->integer('pengeluaran_obat_id');
            $table->integer('obat_id');
            $table->integer('jumlah');
            $table->string('satuan')->nullable();
            $table->integer('harga')->default(0);
            $table->integer('subtotal')->default(0);
            $table->string('keterangan')->nullabl();
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
        Schema::dropIfExists('pengeluaran_obat_detail');
    }
}
