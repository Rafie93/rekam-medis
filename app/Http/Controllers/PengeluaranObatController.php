<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use App\Models\Pasien;
use App\Models\PengeluaranObat;
use App\Models\Rekam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengeluaranObatController extends Controller
{
    public function resep(Request $request)
    {
        $datas = Rekam::latest()
                    ->where('status',3)
                    ->get();

        return view('obat.resep',compact('datas'));
    }

    public function pengeluaran(Request $request,$rekam_id)
    {
        $rekam = Rekam::find($rekam_id);
        $pasien = Pasien::find($rekam->pasien_id);
        $pengeluaran = PengeluaranObat::where('rekam_id',$rekam_id)->whereNull('deleted_at')->get();
        return view('obat.pengeluaran',compact('rekam','pasien','pengeluaran'));
    }

    public function riwayat(Request $request)
    {
        $datas = PengeluaranObat::latest()
                            ->when($request->keyword, function ($query) use ($request) {
                                $query->where('created_at', 'LIKE', "%{$request->keyword}%")
                                    ->orWhere('kd_obat', 'LIKE', "%{$request->keyword}%");
                            })
                            ->whereNull('deleted_at')
                            ->paginate(10);
        return view('obat.riwayat',compact('datas'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        try {
            DB::beginTransaction();
            if ($request->obat_id) {
                foreach ($request->obat_id as $i => $obatId) {
                    PengeluaranObat::create([
                        'rekam_id' => $request->rekam_id,
                        'pasien_id' => $request->pasien_id,
                        'obat_id'  => $obatId,
                        'jumlah' => $request->jumlah[$i],
                        'harga' => $request->harga[$i],
                        'subtotal' => $request->subtotal[$i],
                        'keterangan' =>  $request->keterangan[$i] != "" ? $request->keterangan[$i] : ""
                    ]);

                    $obat = Obat::find($obatId);
                    $obat->update(
                        [
                        'stok' => $obat->stok - $request->jumlah[$i]
                    ]);
                }
            }
            DB::commit();
            $rekam = Rekam::find($request->rekam_id);
            $status = 5;
            if ($rekam->cara_bayar=="Umum/Mandiri") {
                $status = 4;
            }
            $rekam->update([
                'status' => $status
            ]);
            return redirect()->route('obat.pengeluaran',$request->rekam_id)->with('sukses','Obat Berhasil diberikan');

        } catch (\PDOException $e) {
            DB::rollback();
            return redirect()->route('obat.pengeluaran',$request->rekam_id)->with('gagal','Data Gagal ditambahkan '.$e);

        }   
    }


}
