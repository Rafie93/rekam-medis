<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class DashboardQuery 
{
    public function totalObat()
    {
        return  Obat::count();
    }
    public function totalObatKeluar(){
        return PengeluaranObat::count();
    }
    public function totalObatKeluarSum(){
        return PengeluaranObat::sum('jumlah');
    }
    public function obatHariini(){
        return PengeluaranObat::whereDate('created_at',date('Y-m-d'))->count();
    }
    public function permintaanObat(){
        return Rekam::latest()
                    ->where('status',3)
                    ->get();
    }
    public function perikaHariini()
    {
        $user = auth()->user();
        $role = $user->role_display();
        return Rekam::whereDate('tgl_rekam',date('Y-m-d'))
                        ->when($role, function ($query) use ($role,$user){
                            if($role=="Dokter"){
                                $dokterId = Dokter::where('user_id',$user->id)->where('status',1)->first()->id;
                                $query->where('dokter_id', '=', $dokterId);
                            }
                        })
                        ->count();
    }
    public function pasienAntri(){
        $user = auth()->user();
        $role = $user->role_display();
        return Rekam::whereDate('tgl_rekam',date('Y-m-d'))
                        ->when($role, function ($query) use ($role,$user){
                            if($role=="Dokter"){
                                $dokterId = Dokter::where('user_id',$user->id)->where('status',1)->first()->id;
                                $query->where('dokter_id', '=', $dokterId);
                            }
                        })
                        ->whereIn('status',[1,2])
                        ->count();
    }
    public function perikaBulanini()
    {
        $user = auth()->user();
        $role = $user->role_display();
        return Rekam::whereMonth('tgl_rekam',date('m'))
                    ->whereYear('tgl_rekam',date('Y'))
                    ->when($role, function ($query) use ($role,$user){
                        if($role=="Dokter"){
                            $dokterId = Dokter::where('user_id',$user->id)->where('status',1)->first()->id;
                            $query->where('dokter_id', '=', $dokterId);
                        }
                    })
                    ->count();
    }
    public function perikaTahunini()
    {
        $user = auth()->user();
        $role = $user->role_display();
        return Rekam::whereYear('tgl_rekam',date('Y'))
                    ->when($role, function ($query) use ($role,$user){
                        if($role=="Dokter"){
                            $dokterId = Dokter::where('user_id',$user->id)->where('status',1)->first()->id;
                            $query->where('dokter_id', '=', $dokterId);
                        }
                    })
                    ->count();
    }
    public function totalPeriksa()
    {
        $user = auth()->user();
        $role = $user->role_display();
        return Rekam::when($role, function ($query) use ($role,$user){
            if($role=="Dokter"){
                $dokterId = Dokter::where('user_id',$user->id)->where('status',1)->first()->id;
                $query->where('dokter_id', '=', $dokterId);
            }
        })->count();
    }
    public function totalPasien()
    {
        
        return Pasien::whereNull('deleted_at')->count();
    }
    public function totalDoktor()
    {
        return Dokter::where('status',1)->count();
    }

    public function diagnosaBulanan(){
      $filterBulan = date('Y-m');
      $data=  DB::select('
            select aa.*,ic.name_id from(
            select diagnosa, count(diagnosa) as total
            from (
           
            select diagnosa
            from rekam_diagnosa a 
            LEFT JOIN rekam r ON r.id = a.rekam_id
            where diagnosa is not null
            and r.tgl_rekam LIKE "%'.$filterBulan.'%"

            union all
            select diagnosa
            from rekam_gigi 
            where created_at LIKE "%'.$filterBulan.'%"
        ) sc
        group by diagnosa)aa 
        left join icds ic on ic.code = aa.diagnosa
        order by total desc limit 10');
        return $data;
    }
    public function diagnosaYearly(){
        $filter = date('Y-');
        $data=  DB::select('
              select aa.*,ic.name_id from(
              select diagnosa, count(diagnosa) as total
              from (
             
              select diagnosa
              from rekam_diagnosa a
              LEFT JOIN rekam r ON r.id = a.rekam_id
              where diagnosa is not null
              and r.tgl_rekam LIKE "%'.$filter.'%"
  
              union all
              select diagnosa
              from rekam_gigi 
              where created_at LIKE "%'.$filter.'%"
          ) sc
          group by diagnosa)aa 
          left join icds ic on ic.code = aa.diagnosa
          order by total desc limit 10');
          return $data;
      }
    function rekam_day(){
        $user = auth()->user();
        $role = $user->role_display();

        return Rekam::latest()
                ->whereDate('tgl_rekam',date('Y-m-d'))
                ->when($role, function ($query) use ($role,$user){
                    if($role=="Dokter"){
                        $dokterId = Dokter::where('user_id',$user->id)->where('status',1)->first()->id;
                        $query->where('dokter_id', '=', $dokterId);
                    }
                })
                ->get();
    }

    function rekam_day2(){
        $user = auth()->user();
        $role = $user->role_display();

        return Rekam::orderBy('id','asc')
                ->whereDate('tgl_rekam',date('Y-m-d'))
                ->when($role, function ($query) use ($role,$user){
                    if($role=="Dokter"){
                        $dokterId = Dokter::where('user_id',$user->id)->where('status',1)->first()->id;
                        $query->where('dokter_id', '=', $dokterId);
                    }
                })
                ->get();
    }

    function rekam_antrian(){
        $user = auth()->user();
        $role = $user->role_display();

        return Rekam::orderBy('id','desc')
                ->whereDate('tgl_rekam',date('Y-m-d'))
                ->where('status',2)
                ->when($role, function ($query) use ($role,$user){
                    if($role=="Dokter"){
                        $dokterId = Dokter::where('user_id',$user->id)->where('status',1)->first()->id;
                        $query->where('dokter_id', '=', $dokterId);
                    }
                })
                ->get();
    }
}
