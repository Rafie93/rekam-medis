<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\Pasien;
use App\Models\PengeluaranObat;
use App\Models\Poli;
use App\Models\Rekam;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RekamController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $role = $user->role_display();
        $rekams = Rekam::latest()
                    ->when($role, function ($query) use ($role,$user){
                        if($role=="Dokter"){
                            $dokterId = Dokter::where('user_id',$user->id)->where('status',1)->first()->id;
                            $query->where('dokter_id', '=', $dokterId);
                        }
                    })
                    ->when($request->tab, function ($query) use ($request) {
                        if(auth()->user()->role_display()=="Dokter" && $request->tab==5){
                            $query->whereIn('status', [3,4,5]);
                        }else{
                            if($request->tab==5){
                                $query->whereIn('status',[4,5]);
                            }else{
                                $query->where('status', '=', "$request->tab");
                            }
                        }
                    })
                    ->paginate(10);
        return view('rekam.index',compact('rekams'));
    }

    public function add(Request $request)
    {
        $poli = Poli::all();
        $pasien = Pasien::whereNull('deleted_at')->get();
        return view('rekam.add',compact('poli','pasien'));
    }

    public function detail(Request $request,$pasien_id)
    {
        $pasien = Pasien::find($pasien_id);
        $rekams = Rekam::latest()
                    ->where('pasien_id',$pasien_id)
                    ->paginate(5);
        $rekamLatest = Rekam::latest()
                                ->where('status','!=',5)
                                ->where('pasien_id',$pasien_id)
                                ->first();

        return view('rekam.detail-rekam',compact('pasien','rekams','rekamLatest'));
    }

    function store(Request $request){
        $this->validate($request,[
            'tgl_rekam' => 'required',
            'pasien_id' => 'required',
            'pasien_nama' => 'required',
            'keluhan' => 'required',
            'poli' => 'required',
            'cara_bayar' => 'required',
            'dokter_id' => 'required'
        ]);
        $pasien = Pasien::where('id',$request->pasien_id)->first();
        if(!$pasien){
            return redirect()->back()->withInput($request->input())
                                ->withErrors(['pasien_id' => 'Data Pasien Tidak Ditemukan']);
        }
        $rekam_ada = Rekam::where('pasien_id',$request->pasien_id)
                            ->whereIn('status',[1,2,3,4])
                            ->first();
        if($rekam_ada){
            return redirect()->back()->withInput($request->input())
                                ->withErrors(['pasien_id' => 'Pasien ini masih belum selesai periksa,
                                 harap selesaikan pemeriksaan sebelumnya']);
        }
        // $dokter = Dokter::where('poli',$request->poli)->first();
        // if($dokter){
        //     $request->merge([
        //         'dokter_id' => $dokter->id
        //     ]);
        // }
        $request->merge([
            'no_rekam' => "REG#".date('Ymd').$request->pasien_id,
            'petugas_id' => auth()->user()->id
        ]);
        Rekam::create($request->all());
        return redirect()->route('rekam.detail',$request->pasien_id)
                        ->with('sukses','Pendaftaran Berhasil,
                         Silakan lakukan pemeriksaan dan teruskan ke dokter terkait');

    }

    public function pemeriksaan_update(Request $request)
    {
        $this->validate($request,[
            'rekam_id' => 'required',
            'pasien_id' => 'required',
            'pemeriksaan' => 'required',
        ]);

        $rekam = Rekam::find($request->rekam_id);
        $rekam->update([
            'pemeriksaan' => $request->pemeriksaan
        ]);

        return redirect()->route('rekam.detail',$request->pasien_id)
                ->with('sukses','Pemeriksaan Berhasil diperbaharui');

    }

    public function tindakan_update(Request $request)
    {
        $this->validate($request,[
            'rekam_id' => 'required',
            'pasien_id' => 'required',
            'tindakan' => 'required',
        ]);

        $rekam = Rekam::find($request->rekam_id);
        $rekam->update([
            'tindakan' => $request->tindakan
        ]);

        return redirect()->route('rekam.detail',$request->pasien_id)
                ->with('sukses','Tindakan Berhasil diperbaharui');

    }

    public function diagnosa_update(Request $request)
    {
        $this->validate($request,[
            'rekam_id' => 'required',
            'pasien_id' => 'required',
            'diagnosa' => 'required',
        ]);

        $rekam = Rekam::find($request->rekam_id);
        $rekam->update([
            'diagnosa' => $request->diagnosa
        ]);

        return redirect()->route('rekam.detail',$request->pasien_id)
                ->with('sukses','Diagnosa Berhasil diperbaharui');

    }

    public function rekam_status(Request $request, $id, $status)
    {
        $rekam = Rekam::find($id);
        if($status==2){
            if($rekam->pemeriksaan==null){
                return redirect()->route('rekam.detail',$rekam->pasien_id)
                ->with('gagal','Pemeriksaan Isi lebih dulu');
            }
        }
        if($status==3){
            if($rekam->tindakan==null || $rekam->diagnosa==null){
                return redirect()->route('rekam.detail',$rekam->pasien_id)
                ->with('gagal','Tindakan dan Diagnosa Belum diisi');
            }
        }
        $rekam->update([
            'status' => $status
        ]);

        return redirect()->route('rekam.detail',$rekam->pasien_id)
                ->with('sukses','Status Rekam medis selesai diperbaharui ');
    }

    public function delete(Request $request,$id)
    {
        Rekam::find($id)->delete();
        PengeluaranObat::where('rekam_id',$id)->update([
            'deleted_at'=> Carbon::now()
        ]);
        return redirect()->route('rekam')->with('sukses','Data berhasil dihapus');
    } 
}
