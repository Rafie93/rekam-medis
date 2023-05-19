<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\Poli;
use App\Models\Rekam;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DokterController extends Controller
{
    public function index(Request $request)
    {
        $datas = Dokter::all();
        $poli = Poli::all();
        return view('dokter.index',compact('datas','poli'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'nama' => 'required',
            'no_hp' => 'required',
            'poli' => 'required',
            'password' => 'required'
        ]);
        DB::beginTransaction();
        try {
            $user = User::create([
                'name' => $request->nama,
                'phone' => $request->no_hp,
                'password' => bcrypt($request->password),
                'role' => 3,
                'status' => 1
            ]);
            $request->merge([
                'user_id' => $user->id
            ]);
            Dokter::create($request->all());
            DB::commit();
            return redirect()->route('dokter')->with('sukses','Data berhasil ditambahkan');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('dokter')->with('gagal','Data gagal ditambahkan');
        }
        DB::rollBack();
        return redirect()->route('dokter')->with('gagal','Data gagal ditambahkan');
    }

    public function update(Request $request,$id)
    {
        $this->validate($request,[
            'nama' => 'required',
            'no_hp' => 'required',
            'poli' => 'required',
            'password' => 'required'
        ]);
        DB::beginTransaction();
        try {
          
            $dokter = Dokter::find($id);
            $dokter->update($request->all());
            $user = User::find($dokter->user_id);
            $user->update([
                'name' => $request->nama,
                'phone' => $request->no_hp
            ]);
            DB::commit();
            return redirect()->route('dokter')->with('sukses','Data berhasil diperbaharui');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('dokter')->with('gagal','Data gagal diperbaharui');
        }
        DB::rollBack();
        return redirect()->route('dokter')->with('gagal','Data gagal diperbaharui');
    }

    public function delete(Request $request,$id)
    {
        $rekam = Rekam::where('dokter_id',$id)->count();
        if ($rekam >= 1) {
            $dokter = Dokter::find($id);
            $dokter->update([
                'status' => 0
            ]);
            User::find($dokter->user_id)->update([
                'status' => 0
            ]);   
            return redirect()->route('dokter')->with('sukses','Data dokter di non aktifkan');

        }else{
            $dokter = Dokter::find($id);
            $dokter->delete();
            User::find($dokter->user_id)->delete();    
        }
        return redirect()->route('dokter')->with('sukses','Data berhasil dihapus');
    }    

    public function getDokter(Request $request)
    {
        $data = Dokter::select('id','nama')->where('status',1)->get();
        if ($poli = $request->get('poli'))
            $data = Dokter::select('id','nama')
                    ->where('status',1)
                    ->where('poli',$poli)->get();

        return response()->json([ 'success' => true,'data' => $data],200);
    }

    public function updatepassword(Request $request, $id)
    {
        $this->validate($request,[
            'password' => 'required|min:6',
            'password_konfirm' => 'required_with:password|same:password|min:6'
        ]);
      
        $password = bcrypt($request->password);
        User::where('id', $id)->update(['password' => $password,
        'updated_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        return redirect()->route('dokter')->with('sukses','Selamat, password anda sudah diperbaharui');
    }
}
