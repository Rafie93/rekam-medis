<?php

namespace App\Http\Controllers;

use App\Models\Rekam;
use Illuminate\Http\Request;
// use Image;
use App\Models\RekamDiagnosa;
class RekamPemeriksaanController extends Controller
{
    public function pemeriksaan(Request $request)
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

        if ($request->hasFile('file')) {
            // $img = Image::make($request->file)->resize(300, 200)->encode('data-url');
            $originName = $request->file('file')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('file')->getClientOriginalExtension();
            $fileName = "PEM-".$rekam->tgl_rekam.'.'.$extension;
            $request->file('file')->move('images/pemeriksaan/',$fileName);
            $rekam->update(
                ['pemeriksaan_file' => $fileName]
            );
        }

        return redirect()->route('rekam.detail',$request->pasien_id)
                ->with('sukses','Pemeriksaan Berhasil diperbaharui');

    }

    function diagnosa_delete(Request $reques,$id){
        $rekam = RekamDiagnosa::find($id);
        $rekam->delete();

        return redirect()->route('rekam.detail',$rekam->pasien_id)
                ->with('sukses','Diagnosa Berhasil dihapus');
    }

    public function diagnosa(Request $request)
    {
        $this->validate($request,[
            'rekam_id' => 'required',
            'pasien_id' => 'required',
            'diagnosa' => 'required',
        ]);

        $rekam = Rekam::find($request->rekam_id);
        // $rekam->update([
        //     'diagnosa' => $request->diagnosa
        // ]);
        $data = array(
            'pasien_id' => $request->pasien_id,
            'rekam_id' => $request->rekam_id,
            'diagnosa' => $request->diagnosa
        );
        RekamDiagnosa::updateOrCreate($data,$data);

        return redirect()->route('rekam.detail',$request->pasien_id)
                ->with('sukses','Diagnosa Berhasil diperbaharui');

    }

    public function tindakan(Request $request)
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

        if ($request->hasFile('file')) {
            // $img = Image::make($request->file)->resize(300, 200)->encode('data-url');
            $originName = $request->file('file')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('file')->getClientOriginalExtension();
            $fileName = "TIND-".$rekam->tgl_rekam.'.'.$extension;
            $request->file('file')->move('images/pemeriksaan/',$fileName);
            $rekam->update(
                ['tindakan_file' => $fileName]
            );
        }

        return redirect()->route('rekam.detail',$request->pasien_id)
                ->with('sukses','Tindakan Berhasil diperbaharui');

    }

    public function resep(Request $request)
    {
        $this->validate($request,[
            'rekam_id' => 'required',
            'pasien_id' => 'required',
            'resep_obat' => 'required',
        ]);

        $rekam = Rekam::find($request->rekam_id);
        $rekam->update([
            'resep_obat' => $request->resep_obat
        ]);

        return redirect()->route('rekam.detail',$request->pasien_id)
                ->with('sukses','Resep Obat Berhasil diperbaharui');

    }

    function file(Request $request, $id, $type){
        $data = Rekam::find($id);
        return view('rekam.file',compact('data','type'));

    }

    function insertToTableNew(){
        $rekam = Rekam::whereNotNull('diagnosa')->get();
        foreach ($rekam as $key => $data) {
            $data = array(
                'pasien_id' => $data->pasien_id,
                'rekam_id' => $data->id,
                'diagnosa' => $data->diagnosa
            );
            RekamDiagnosa::updateOrCreate($data,$data);

        }
    }
    

}
