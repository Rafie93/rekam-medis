<?php

namespace App\Models;

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
