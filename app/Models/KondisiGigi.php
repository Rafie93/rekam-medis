<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KondisiGigi extends Model
{
    protected $table = "kondisi_gigi";
    protected $fillable = ["kode","nama"];
}
