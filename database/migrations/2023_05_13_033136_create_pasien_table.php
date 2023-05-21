<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePasienTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pasien', function (Blueprint $table) {
            $table->id();
            $table->string('no_rm');
            $table->string('nama');
            $table->string('tmp_lahir')->nullable();
            $table->date('tgl_lahir')->nullable();;
            $table->enum('jk',["Laki-Laki","Perempuan"])->nullable();
            $table->longText('alamat_lengkap')->nullable();
            $table->string('kelurahan')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('kabupaten')->nullable();
            $table->string('kodepos')->nullable();
            $table->string('agama')->default("Islam")->nullable();;
            $table->enum('status_menikah',["Menikah","Belum Menikah","Janda","Duda"])->nullable();;
            $table->string('pendidikan')->nullable();
            $table->string('pekerjaan')->nullable();
            $table->enum('kewarganegaraan',["WNI","WNA"])->defaul("WNI");
            $table->string('no_hp',13)->nullable();
            $table->string('cara_bayar')->default("Umum/Mandiri");
            $table->string('no_bpjs')->nullable();
            $table->string('alergi')->nullable();
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
        Schema::dropIfExists('pasien');
    }
}
