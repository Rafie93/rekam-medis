<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengeluaranObat extends Model
{
    protected $table = "pengeluaran_obat";
    protected $fillable = ["rekam_id","pasien_id"
    ,"obat_id","jumlah","harga","subtotal","keterangan","deleted_at"];

    function obat(){
        return $this->belongsTo(Obat::class);
    }

    function pasien(){
        return $this->belongsTo(Pasien::class);
    }

    function rekam(){
        return $this->belongsTo(Rekam::class);
    }

       
}
