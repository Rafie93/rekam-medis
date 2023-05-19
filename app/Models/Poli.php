<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Poli extends Model
{
    protected $table = "poli";
    protected $fillable = ["nama","status"];

    function status_display(){
        return $this->status ==1 ? 'Aktif' :'Tidak Aktif';
    }
}
