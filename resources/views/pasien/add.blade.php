@extends('layout.apps')
@section('content')
<div class="form-head align-items-center d-flex mb-sm-4 mb-3">
    <div class="mr-auto">
        <h2 class="text-black font-w600">Tambah Pasien</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{Route('pasien')}}">Data Pasien</a></li>
            <li class="breadcrumb-item active"><a href="#">Tambah Data Pasein</a></li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <div class="basic-form">
                    <form action="{{Route('pasien.store')}}" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">No.RM*</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="no_rm" required value="{{old('no_rm')}}">
                                @error('no_rm')
                                <div class="invalid-feedback animated fadeInUp"
                                style="display: block;">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Nama Pasien*</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="nama" required value="{{old('nama')}}">
                                @error('nama')
                                <div class="invalid-feedback animated fadeInUp"
                                style="display: block;">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Tempat Lahir*</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="tmp_lahir" required value="{{old('tmp_lahir')}}">
                                @error('tmp_lahir')
                                <div class="invalid-feedback animated fadeInUp"
                                style="display: block;">{{$message}}</div>
                                @enderror
                            </div>
                            <label class="col-sm-2 col-form-label">Tanggal Lahir</label>
                            <div class="col-sm-4">
                                <input type="date" class="form-control" name="tgl_lahir" required value="{{old('tgl_lahir')}}">
                                @error('tgl_lahir')
                                <div class="invalid-feedback animated fadeInUp"
                                style="display: block;">{{$message}}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Jenis Kelamin*</label>
                            <div class="col-sm-4">
                                <div class="form-check">
                                    <input type="radio" name="jk" class="form-check-input" 
                                    value="Laki-Laki">
                                    <label class="form-check-label">Laki-Laki</label>     
                                </div>
                                <div class="form-check">
                                    <input type="radio" name="jk" class="form-check-input"
                                    value="Perempuan">
                                    <label class="form-check-label">Perempuan</label>   
                                </div>
                                @error('jk')
                                <div class="invalid-feedback animated fadeInUp"
                                style="display: block;">{{$message}}</div>
                                @enderror
                            </div>
                            <label class="col-sm-2 col-form-label">Status Menikah</label>
                            <div class="col-sm-4">
                                {{-- <div class="form-check">
                                    <input type="radio" name="status_menikah" class="form-check-input" 
                                    value="Menikah">
                                    <label class="form-check-label">Menikah</label>     
                                </div>
                                <div class="form-check">
                                    <input type="radio" name="status_menikah" class="form-check-input"
                                    value="Belum Menikah">
                                    <label class="form-check-label">Belum Menikah</label>   
                                </div> --}}
                                <select name="status_menikah" class="form-control" required>
                                    <option value="">--Pilih--</option>
                                    <option value="Belum Menikah">Belum Menikah</option>
                                    <option value="Menikah">Menikah</option>
                                    <option value="Duda">Duda</option>
                                    <option value="Janda">Janda</option>
                                </select>
                                @error('status_menikah')
                                <div class="invalid-feedback animated fadeInUp"
                                style="display: block;">{{$message}}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Agama*</label>
                            <div class="col-sm-2">
                                <select name="agama" class="form-control">
                                    <option value="Islam">Islam</option>
                                    <option value="Kristen">Kristen</option>
                                    <option value="Katholik">Katholik</option>
                                    <option value="Hindu">Hindu</option>
                                    <option value="Budha">Budha</option>
                                    <option value="Konghucu">Konghucu</option>
                                </select>
                                @error('agama')
                                <div class="invalid-feedback animated fadeInUp"
                                style="display: block;">{{$message}}</div>
                                @enderror
                            </div>
                            <label class="col-sm-2 col-form-label">Pendidikan*</label>
                            <div class="col-sm-2">
                                <select name="pendidikan" class="form-control" required>
                                    <option value="">--Pilih--</option>
                                    <option value="SD">SD</option>
                                    <option value="SMP">SMP</option>
                                    <option value="SMA">SMA</option>
                                    <option value="Diploma">Diploma</option>
                                    <option value="S1">S1</option>
                                    <option value="S2">S2</option>
                                    <option value="S3">S3</option>
                                    <option value="Tidak Sekolah">Tidak Sekolah</option>
                                </select>
                                @error('pendidikan')
                                <div class="invalid-feedback animated fadeInUp"
                                style="display: block;">{{$message}}</div>
                                @enderror
                            </div>

                            <label class="col-sm-2 col-form-label">Pekerjaan</label>
                            <div class="col-sm-2">
                                <select name="pekerjaan" class="form-control">
                                    <option value="">--Pilih--</option>
                                    <option value="PNS">PNS</option>
                                    <option value="Wiraswasta">Wiraswasta</option>
                                    <option value="TNI/Polri">TNI/Polri</option>
                                    <option value="Pelajar/Mahasiswa">Pelajar/Mahasiswa</option>
                                    <option value="Petani">Petani</option>
                                    <option value="Guru/Pengajar">Guru/Pengajar</option>
                                    <option value="Lain-Lain">Lain-Lain</option>
                                </select>
                                @error('pendidikan')
                                <div class="invalid-feedback animated fadeInUp"
                                style="display: block;">{{$message}}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Alamat Lengkap</label>
                            <div class="col-sm-10">
                            
                                <textarea name="alamat_lengkap" class="form-control" rows="4">{{old('alamat_lengkap')}}</textarea>
                                @error('alamat_lengkap')
                                <div class="invalid-feedback animated fadeInUp"
                                style="display: block;">{{$message}}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Kelurahan</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="kelurahan" value="{{old('kelurahan')}}">
                                @error('kelurahan')
                                <div class="invalid-feedback animated fadeInUp"
                                style="display: block;">{{$message}}</div>
                                @enderror
                            </div>
                            <label class="col-sm-2 col-form-label">Kecamatan</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="kecamatan"  value="{{old('kecamatan')}}">
                                @error('kecamatan')
                                <div class="invalid-feedback animated fadeInUp"
                                style="display: block;">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Kabupaten</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="kabupaten" value="{{old('kabupaten')}}">
                                @error('kabupaten')
                                <div class="invalid-feedback animated fadeInUp"
                                style="display: block;">{{$message}}</div>
                                @enderror
                            </div>
                            <label class="col-sm-2 col-form-label">Kodepos</label>
                            <div class="col-sm-4">
                                <input type="number" maxlength="5" class="form-control" name="kodepos" value="{{old('kodepos')}}">
                                @error('kodepos')
                                <div class="invalid-feedback animated fadeInUp"
                                style="display: block;">{{$message}}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">No HP*</label>
                            <div class="col-sm-4">
                                <input type="number" class="form-control" name="no_hp" required value="{{old('no_hp')}}">
                                @error('no_hp')
                                <div class="invalid-feedback animated fadeInUp"
                                style="display: block;">{{$message}}</div>
                                @enderror
                            </div>
                            <label class="col-sm-3 col-form-label">Kewarganegaraan</label>
                            <div class="col-sm-3">
                                <div class="form-check">
                                    <input type="radio" name="kewarganegaraan" class="form-check-input" 
                                    value="WNI" checked>
                                    <label class="form-check-label">WNI</label>     
                                </div>
                                <div class="form-check">
                                    <input type="radio" name="kewarganegaraan" class="form-check-input"
                                    value="WNA">
                                    <label class="form-check-label">WNA</label>   
                                </div>
                                @error('kewarganegaraan')
                                <div class="invalid-feedback animated fadeInUp"
                                style="display: block;">{{$message}}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Cara Bayar *</label>
                            <div class="col-sm-4">
                                <div class="form-check">
                                    <input type="radio" name="cara_bayar" class="form-check-input" 
                                    value="Umum/Mandiri">
                                    <label class="form-check-label">Umum/Mandiri</label>     
                                </div>
                                <div class="form-check">
                                    <input type="radio" name="cara_bayar" class="form-check-input"
                                    value="Jaminan Kesehatan">
                                    <label class="form-check-label">Jaminan Kesehatan</label>   
                                </div>
                                @error('cara_bayar')
                                <div class="invalid-feedback animated fadeInUp"
                                style="display: block;">{{$message}}</div>
                                @enderror
                            </div>
                            <label class="col-sm-2 col-form-label" id="no_bpjs_label">No. BPJS</label>
                            <div class="col-sm-4">
                                <input type="number" class="form-control" id="no_bpjs" name="no_bpjs" value="{{old('no_bpjs')}}">
                                @error('no_bpjs')
                                <div class="invalid-feedback animated fadeInUp"
                                style="display: block;">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">SIMPAN</button>
                        </div>

                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script>
        $('input:radio[name="cara_bayar"]').change(
         function(){
            if ($(this).is(':checked') && $(this).val() == 'Jaminan Kesehatan') {
               $("#no_bpjs").show();
               $("#no_bpjs_label").show();
            }else{
                $("#no_bpjs").hide();
                $("#no_bpjs_label").hide();
                $("#no_bpjs").val("");

            }
        });
    </script>
@endsection