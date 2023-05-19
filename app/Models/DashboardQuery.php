<?php

namespace App\Models;

class DashboardQuery 
{
    public function perikaHariini()
    {
        return Rekam::whereDate('tgl_rekam',date('Y-m-d'))->count();
    }
    public function perikaBulanini()
    {
        return Rekam::whereMonth('tgl_rekam',date('m'))
                    ->whereYear('tgl_rekam',date('Y'))
                    ->count();
    }
    public function perikaTahunini()
    {
        return Rekam::whereYear('tgl_rekam',date('Y'))
                    ->count();
    }
    public function totalPeriksa()
    {
        return Rekam::count();
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
        return Rekam::latest()
                ->whereDate('tgl_rekam',date('Y-m-d'))
                ->get();
    }
}
