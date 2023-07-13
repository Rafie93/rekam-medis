<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rekam extends Model
{
    protected $table = "rekam";
    protected $fillable = ["tgl_rekam","pasien_id","keluhan","poli","dokter_id","pemeriksaan",
    "no_rekam","tindakan","status","petugas_id","biaya_pemeriksaan","biaya_tindakan",
    "biaya_obat","total_biaya","cara_bayar","resep_obat","pemeriksaan_file","tindakan_file"];

    function gigi(){
      return  RekamGigi::where('rekam_id',$this->id)->get();
    }

    function diagnosa(){
        return  RekamDiagnosa::where('rekam_id',$this->id)->get();
      }

    function pasien(){
        return $this->belongsTo(Pasien::class);
    }

    // function diagnosis(){
    //     return $this->belongsTo(Icd::class,'diagnosa','code');
    // }

    function dokter(){
        return $this->belongsTo(Dokter::class);
    }
    function status_rekams(){
        switch ($this->status) {
            case 1:
                return "<span class='badge badge-rounded badge-danger'>Belum Diperiksa</span>";
                break;
            case 2:
                return "<span class='badge badge-rounded badge-danger'>Belum Diperiksa</span>";
                break;
            case 3:
                return "<span class='badge badge-rounded badge-primary'>Sudah Diperiksa</span>";
                break;
            case 4:
                return "<span class='badge badge-rounded badge-primary'>Selesai</span>";
                break;
            case 5:
                return "<span class='badge badge-rounded badge-primary'>Selesai</span>";
                break;
            default:
                # code...
                break;
        }
    }

    function status_display(){
        switch ($this->status) {
            case 1:
                return '<span class="badge badge-outline-warning">
                            <i class="fa fa-circle text-warning mr-1"></i>
                             Antrian
                        </span>';
            break;
            case 2:
                return '<span class="badge badge-info light">
                            <i class="fa fa-circle text-info mr-1"></i>
                            Pemeriksaan
                        </span>';
            break;
            case 3:
                return '<span class="badge badge-warning light" style="width:100px">
                           Di Apotek
                        </span>';
            break;
            case 4:
                return '<span class="badge badge-danger light">
                            <i class="fa fa-circle text-danger mr-1"></i>
                            Pembayaran
                        </span>';
            break;
            case 5:
                return '<span class="badge badge-primary light" style="width:100px">
                            <i class="fa fa-check text-primary mr-1"></i>
                            Selesai
                        </span>';
            break;
            default:
                # code...
                break;
        }
    }
}
