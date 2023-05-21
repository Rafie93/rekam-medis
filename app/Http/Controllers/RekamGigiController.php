<?php

namespace App\Http\Controllers;

use App\Models\KondisiGigi;
use App\Models\Rekam;
use App\Models\RekamGigi;
use App\Models\Tindakan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RekamGigiController extends Controller
{
    public function odontogram(Request $request, $pasienId)
    {
        $rekam = Rekam::orderBy('id','desc')->where('pasien_id',$pasienId)->first();
        if(!$rekam){
            return redirect()->route('rekam.detail',$pasienId)
            ->with('gagal','Odontogram tidak ditemukan');

        }
        $pem_gigi = RekamGigi::where('rekam_id',$rekam->id)->get();
        $elemen_gigis="";
        $pemeriksaan_gigi="";
        $numItems = $pem_gigi->count();
        $i = 0;
        foreach($pem_gigi as $key=>$value){
            $elemen_gigis.=$value->elemen_gigi;
            $pemeriksaan_gigi.=$value->pemeriksaan;
            if(++$i != $numItems) {
                $elemen_gigis.=",";
                $pemeriksaan_gigi.=",";
            }
        }

        $all_riwayat_gigi = RekamGigi::where('pasien_id',$pasienId)->get();
        
        return view('rekam.odontogram',compact('rekam','elemen_gigis','pemeriksaan_gigi','all_riwayat_gigi'));
    }

    public function index(Request $request,$rekamId)
    {
        $rekam = Rekam::find($rekamId);
        $tindakan = Tindakan::where('poli','Poli Gigi')->get();
        $kondisi_gigi = KondisiGigi::all();
        $pem_gigi = RekamGigi::where('rekam_id',$rekamId)->get();
        $elemen_gigis="";
        $pemeriksaan_gigi="";
        $numItems = $pem_gigi->count();
        $i = 0;
        foreach($pem_gigi as $key=>$value){
            $elemen_gigis.=$value->elemen_gigi;
            $pemeriksaan_gigi.=$value->pemeriksaan;
            if(++$i != $numItems) {
                $elemen_gigis.=",";
                $pemeriksaan_gigi.=",";
            }
        }
        
        return view('rekam.rekam-gigi',compact('rekam','tindakan','kondisi_gigi','elemen_gigis','pemeriksaan_gigi','pem_gigi'));
    }

    public function store(Request $request,$rekamId){
        $rekam = Rekam::find($rekamId);
        // dd($request->all());
        try {
            DB::beginTransaction();
            if ($request->element_gigi) {
                foreach ($request->element_gigi as $i => $elementId) {
                    RekamGigi::updateOrCreate([
                        'rekam_id' => $rekamId,
                        'pasien_id' => $rekam->pasien_id,
                        'elemen_gigi'  => $elementId,
                    ]
                    ,[
                        'rekam_id' => $rekamId,
                        'pasien_id' => $rekam->pasien_id,
                        'elemen_gigi'  => $elementId,
                        'pemeriksaan' => $request->pemeriksaan[$i],
                        'diagnosa' => $request->diagnosa[$i],
                        'tindakan' => $request->tindakan[$i],
                        'status' =>1,
                    ]);
                }
            }
            DB::commit();
            
            return redirect()->route('rekam.detail',$rekam->pasien_id)->with('sukses','Rekam Gigi Berhasil ditambahkan');

        } catch (\PDOException $e) {
            DB::rollback();
            return redirect()->route('rekam.gigi.add',$rekamId)->with('gagal','Data Gagal ditambahkan '.$e);

        }   
    }

    public function delete(Request $request,$id)
    {
        $data = RekamGigi::find($id);
        $data->delete();
        return redirect()->route('rekam.gigi.add',$data->rekam_id)->with('sukses','Data berhasil dihapus');
    }   
}
