<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    protected $table = "pasien";
    protected $fillable = ["no_rm","nama","tmp_lahir","tgl_lahir","jk","alamat_lengkap"
    ,"kelurahan","kecamatan","kabupaten","kodepos","agama","status_menikah","pendidikan"
    ,"pekerjaan","kewarganegaraan","no_hp","cara_bayar","no_bpjs","deleted_at","alergi"];
}
