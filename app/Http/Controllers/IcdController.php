<?php

namespace App\Http\Controllers;

use App\Models\Icd;
use Illuminate\Http\Request;
use DataTables;

class IcdController extends Controller
{
    public function data(Request $request)
    {
        // return DataTables::of(Icd::query())->toJson();
        if ($request->ajax()) {
            return DataTables::of(Icd::query())
                    ->addColumn('action',function($data){
                        $button = '<a href="javascript:void(0)" 
                            data-id="'.$data->code.'"
                            class="btn btn-primary shadow btn-xs pilihIcd">
                            Pilih</a>';
                        return $button;
                    })->rawColumns(['action'])
                    ->toJson();
        }
        return DataTables::of(Icd::query())
        ->addColumn('action',function($data){
            $button = '<a href="javascript:void(0)" 
                data-id="'.$data->code.'"
                class="btn btn-primary shadow btn-xs pilihIcd">
                Pilih</a>';
            return $button;
        })->rawColumns(['action'])->toJson();
    }

    public function index(Request $request)
    {
        $datas = Icd::orderBy('code','asc')
                            ->when($request->keyword, function ($query) use ($request) {
                                $query->where('code', 'LIKE', "%{$request->keyword}%")
                                    ->orWhere('name_id', 'LIKE', "%{$request->keyword}%")
                                    ->orWhere('name_en', 'LIKE', "%{$request->keyword}%");
                            })->paginate(10);

        return view('icd.index',compact('datas'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'code' => 'required|unique:icds',
            'name_en' => 'required',
            'name_id' => 'required'
        ]);
        Icd::create($request->all());
        return redirect()->route('icd')->with('sukses','Data berhasil ditambahkan');
    }

    public function update(Request $request,$id)
    {
        $this->validate($request,[
            'code' => 'required',
            'name_en' => 'required',
            'name_id' => 'required'
        ]);
        $data = Icd::where('code',$id);
        $data->update($request->all());
        return redirect()->route('icd')->with('sukses','Data berhasil diperbaharui');
    }

    public function delete(Request $request,$id)
    {
        Icd::where('code',$id)->delete();
        return redirect()->route('icd')->with('sukses','Data berhasil dihapus');
    }    
}
