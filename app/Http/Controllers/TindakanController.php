<?php

namespace App\Http\Controllers;

use App\Models\Poli;
use App\Models\Tindakan;
use Illuminate\Http\Request;

class TindakanController extends Controller
{
    public function index(Request $request)
    {
        $poli = Poli::all();
        $datas = Tindakan::orderBy('kode','asc')
                            ->when($request->keyword, function ($query) use ($request) {
                                $query->where('kode', 'LIKE', "%{$request->keyword}%")
                                    ->orWhere('nama', 'LIKE', "%{$request->keyword}%");
                            })->paginate(10);

        return view('tindakan.index',compact('datas','poli'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'kode' => 'required|unique:tindakan',
            'nama' => 'required',
            'poli' => 'required'
        ]);
        Tindakan::create($request->all());
        return redirect()->route('tindakan')->with('sukses','Data berhasil ditambahkan');
    }

    public function update(Request $request,$id)
    {
        $this->validate($request,[
            'kode' => 'required',
            'nama' => 'required',
            'poli' => 'required'
        ]);
        $data = Tindakan::find($id);
        $data->update($request->all());
        return redirect()->route('tindakan')->with('sukses','Data berhasil diperbaharui');
    }

    public function delete(Request $request,$id)
    {
        Tindakan::where('id',$id)->delete();
        return redirect()->route('tindakan')->with('sukses','Data berhasil dihapus');
    }    
}
