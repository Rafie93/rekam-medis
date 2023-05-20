<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tindakan extends Model
{
    protected $table = "tindakan";
    protected $fillable = ["kode","nama","harga","poli"];
}
