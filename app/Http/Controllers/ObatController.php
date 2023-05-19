<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use App\Models\PengeluaranObat;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DataTables;

class ObatController extends Controller
{
    public function data(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::of(Obat::query())
                    ->addColumn('action',function($data){
                        $button = '<a href="javascript:void(0)" 
                            data-id="'.$data->id.'"
                            data-code="'.$data->kd_obat.'"
                            data-nama="'.$data->nama.'"
                            data-stok="'.$data->stok.'"
                            data-harga="'.$data->harga.'"
                            data-satuan="'.$data->satuan.'"
                            class="btn btn-primary shadow btn-xs pilihObat">
                            Pilih</a>';
                        return $button;
                    })->rawColumns(['action'])
                    ->toJson();
        }
        return DataTables::of(Obat::query())
        ->addColumn('action',function($data){
            $button = '<a href="javascript:void(0)" 
                data-id="'.$data->kd_obat.'"
                data-code="'.$data->id.'"
                data-nama="'.$data->nama.'"
                data-stok="'.$data->stok.'"
                data-harga="'.$data->harga.'"
                data-satuan="'.$data->satuan.'"
                class="btn btn-primary shadow btn-xs pilihObat">
                Pilih</a>';
            return $button;
        })->rawColumns(['action'])->toJson();
    }

    public function index(Request $request)
    {
        $datas = Obat::whereNull('deleted_at')->paginate(10);
        return view('obat.index',compact('datas'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'kd_obat' => 'required|unique:obat',
            'nama' => 'required|unique:obat',
            'satuan' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric',
        ]);
        Obat::create($request->all());
        return redirect()->route('obat')->with('sukses','Data berhasil ditambahkan');
    }

    public function update(Request $request,$id)
    {
        $this->validate($request,[
            'nama' => 'required',
        ]);
        $data = Obat::find($id);
        $data->update($request->all());
        return redirect()->route('obat')->with('sukses','Data berhasil diperbaharui');
    }

    public function delete(Request $request,$id)
    {
        $dike = PengeluaranObat::where('obat_id',$id)->count();
        if ($dike > 0) {
            Obat::find($id)->update([
                'deleted_at' => Carbon::now()
            ]);
        }else{
            Obat::find($id)->delete();
        }
        return redirect()->route('obat')->with('sukses','Data berhasil dihapus');
    } 
}
