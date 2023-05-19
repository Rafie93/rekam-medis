<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        if(auth()->user()->role_display()=="Admin"){

            return view('dashboard.admin');
        }else if(auth()->user()->role_display()=="Pendaftaran"){
            return view('dashboard.registrasi');
        }else if(auth()->user()->role_display()=="Dokter"){
            return view('dashboard.dokter');
        }else if(auth()->user()->role_display()=="Apotek"){
            return view('dashboard.obat');
        }
    }
}
