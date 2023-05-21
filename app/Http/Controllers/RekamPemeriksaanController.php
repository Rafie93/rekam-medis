<?php

namespace App\Http\Controllers;

use App\Models\Rekam;
use Illuminate\Http\Request;

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

        return redirect()->route('rekam.detail',$request->pasien_id)
                ->with('sukses','Pemeriksaan Berhasil diperbaharui');

    }

    public function diagnosa(Request $request)
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

        return redirect()->route('rekam.detail',$request->pasien_id)
                ->with('sukses','Tindakan Berhasil diperbaharui');

    }

    

}
