<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    protected $table = "dokter";
    protected $fillable = ["nip","nama","no_hp","alamat","poli","status","user_id"];

    function status_display(){
        return $this->status ==1 ? 'Aktif' :'Tidak Aktif';
    }
}
