<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    protected $table = "pasien";
    protected $fillable = ["no_rm","nama","tmp_lahir","tgl_lahir","jk","alamat_lengkap"
    ,"kelurahan","kecamatan","kabupaten","kodepos","agama","status_menikah","pendidikan"
    ,"pekerjaan","kewarganegaraan","no_hp","cara_bayar","no_bpjs","deleted_at","alergi"
    ,"general_uncent"];

    function rekamGigi(){
       return RekamGigi::where('pasien_id',$this->id)->get();
    }


    function isRekamGigi(){
        return RekamGigi::where('pasien_id',$this->id)->get()->count() > 0 ? true : false;
     }

     function statusPasien(){
         $lastData = Carbon::createFromFormat('Y-m-d H:i:s', '2023-05-22 18:00:00');

         $rekam= Rekam::where('pasien_id',$this->id)
                  ->whereIn('status',[4,5])
                  ->count();
         if($rekam >0){
            if($this->created_at > $lastData){
               return ' <span class="badge badge-outline-primary">
                              <i class="fa fa-circle text-primary mr-1"></i>
                              Sudah Periksa
                        </span>';
            }else{
               return ' <span class="badge badge-outline-success">
                              <i class="fa fa-circle text-success mr-1"></i>
                              Sudah Periksa
                        </span>';
            }
         }else{
            if($this->created_at > $lastData){
               return ' <span class="badge badge-outline-primary">
                              <i class="fa fa-circle text-primary mr-1"></i>
                              Pasien Baru
                        </span>';
            }else{
               return ' <span class="badge badge-outline-danger">
                              <i class="fa fa-circle text-danger mr-1"></i>
                              Pasien Lama
                        </span>';
            }
         }
     }
}
