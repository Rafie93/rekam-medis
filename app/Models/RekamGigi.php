<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RekamGigi extends Model
{
    protected $table = "rekam_gigi";
    protected $fillable = ["rekam_id","pasien_id","elemen_gigi","pemeriksaan","diagnosa","tindakan","status"];

    function rekam(){
        return $this->belongsTo(Rekam::class);
    }

    function pasien(){
        return $this->belongsTo(Pasien::class);
    }

    function tindak(){
        return $this->belongsTo(Tindakan::class,'tindakan','kode');
    }

    function diagnosis(){
        return $this->belongsTo(Icd::class,'diagnosa','code');
    }

}
