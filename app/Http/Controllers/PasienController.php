<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DataTables;
// use Image;
use App\Models\Rekam;
use App\Models\RekamGigi;
use App\Models\PengeluaranObat;

class PasienController extends Controller
{
    public function json(Request $request)
    {
        // return DataTables::of(Icd::query())->toJson();
        if ($request->ajax()) {
            return DataTables::of(Pasien::query())
                    ->addColumn('action',function($data){
                        $button = '<a href="javascript:void(0)" 
                            data-id="'.$data->id.'"
                            data-nama="'.$data->nama.'"
                            data-no="'.$data->no_rm.'"
                            data-metode="'.$data->cara_bayar.'"
                            class="btn btn-primary shadow btn-xs pilihPasien">
                            Pilih</a>';
                        return $button;
                    })->rawColumns(['action'])
                    ->toJson();
        }
        return DataTables::of(Pasien::query())
        ->addColumn('action',function($data){
            $button = '<a href="javascript:void(0)" 
                data-id="'.$data->id.'"
                data-nama="'.$data->nama.'"
                data-no="'.$data->no_rm.'"
                data-metode="'.$data->cara_bayar.'"
                class="btn btn-primary shadow btn-xs pilihPasien">
                Pilih</a>';
            return $button;
        })->rawColumns(['action'])->toJson();
    }

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

    function file(Request $request,$id){
        $data = Pasien::find($id);
        return view('pasien.file',compact('data'));
    }

    function store(Request $request){
        $this->validate($request,[
            'nama' => 'required',
            'no_hp' => 'required',
            'cara_bayar' => 'required',
            'jk' => 'required',
            'no_rm' => 'required|unique:pasien',
            'no_bpjs' => 'unique:pasien'
        ]);

        $pasien = Pasien::create($request->all());
        if ($request->hasFile('file')) {
            $originName = $request->file('file')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('file')->getClientOriginalExtension();
            $fileName = $pasien->no_rm.'.'.$extension;
            $request->file('file')->move('images/pasien/',$fileName);
            $pasien->general_uncent = $fileName;
            $pasien->save();
        }


        return redirect()->route('pasien')->with('sukses','Data berhasil ditambahkan');

    }

    function update(Request $request,$id){
        $this->validate($request,[
            'nama' => 'required',
            'no_hp' => 'required',
            'jk' => 'required',
            'cara_bayar' => 'required',
            'file' => 'mimes:jpg,png,jpeg'
        ]);
        $data = Pasien::find($id);
        $data->update($request->all());
        if ($request->hasFile('file')) {
            $originName = $request->file('file')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('file')->getClientOriginalExtension();
            $fileName = $data->no_rm.'.'.$extension;
            $request->file('file')->move('images/pasien/',$fileName);
            $data->update([
                'general_uncent' => $fileName
            ]);
        }
        return redirect()->route('pasien')->with('sukses','Data berhasil diperbaharui');

    }

    function delete(Request $request,$id)
    {
        // Pasien::find($id)->update(['deleted_at'=>Carbon::now()]);
       $suk = Pasien::find($id)->delete();
       if($suk){
            Rekam::where('pasien_id',$id)->delete();
            RekamGigi::where('pasien_id',$id)->delete();
            PengeluaranObat::where('pasien_id',$id)->delete();
       }
        return redirect()->route('pasien')->with('sukses','Data berhasil dihapus');
    } 

    function getLastRM(Request $request)
    {
        if ($code = $request->get('code')){
            $data = Pasien::orderBy('no_rm','desc')
                        ->where('no_rm','LIKE',"%{$code}%")
                        ->first();
            if ($data) {
                $last_no = substr($data->no_rm,2,3);
                $noLast = (int)$last_no;
                $newNo = $noLast+1;
                $nomorBaru = $newNo;
                if($newNo < 10){
                    $nomorBaru = "00".$newNo;
                }else if($newNo < 100){
                    $nomorBaru = "0".$newNo;
                }
                $no_rm_baru = $code.$nomorBaru;
                return response()->json([
                    'success' => true,
                    'data' => $no_rm_baru
                ],200);
            }else{
                return response()->json([
                    'success' => false,
                ],400);
            }
        }
            
        return response()->json([ 'success' => false],400);
    }
}
