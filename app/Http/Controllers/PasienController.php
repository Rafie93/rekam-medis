<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    public function index(Request $request)
    {
        $datas = Pasien::whereNull('deleted_at')
                ->when($request->keyword, function ($query) use ($request) {
                    $query->where('no_rm', 'LIKE', "%{$request->keyword}%")
                        ->orWhere('nama', 'LIKE', "%{$request->keyword}%")
                        ->orWhere('no_bpjs', 'LIKE', "%{$request->keyword}%")
                        ->orWhere('no_hp', 'LIKE', "%{$request->keyword}%")
                        ->orWhere('alamat_lengkap', 'LIKE', "%{$request->keyword}%");
                })->paginate(10);
        return view('pasien.index',compact('datas'));
    }

    function add(Request $request){
        return view('pasien.add');
    }

    function edit(Request $request,$id){
        $data = Pasien::find($id);
        return view('pasien.edit',compact('data'));
    }

    function store(Request $request){
        $this->validate($request,[
            'nama' => 'required',
            'tmp_lahir' => 'required',
            'tgl_lahir' => 'required',
            'jk' => 'required',
            'status_menikah' => 'required',
            'agama' => 'required',
            'pendidikan' => 'required',
            'no_hp' => 'required',
            'cara_bayar' => 'required',
            'no_rm' => 'required|unique:pasien',
            'no_bpjs' => 'required|unique:pasien'
        ]);

        Pasien::create($request->all());
        return redirect()->route('pasien')->with('sukses','Data berhasil ditambahkan');

    }

    function update(Request $request,$id){
        $this->validate($request,[
            'nama' => 'required',
            'tmp_lahir' => 'required',
            'tgl_lahir' => 'required',
            'jk' => 'required',
            'status_menikah' => 'required',
            'agama' => 'required',
            'pendidikan' => 'required',
            'no_hp' => 'required',
            'cara_bayar' => 'required',
        ]);
        $data = Pasien::find($id);
        $data->update($request->all());
        return redirect()->route('pasien')->with('sukses','Data berhasil diperbaharui');

    }

    public function delete(Request $request,$id)
    {
        Pasien::find($id)->update(['deleted_at'=>Carbon::now()]);
        return redirect()->route('pasien')->with('sukses','Data berhasil dihapus');
    } 
}
