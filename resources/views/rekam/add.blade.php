@extends('layout.apps')
@section('content')
<div class="form-head align-items-center d-flex mb-sm-4 mb-3">
    <div class="mr-auto">
        <h2 class="text-black font-w600">Rekam Medis Baru</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{Route('pasien')}}">Rekam Medis</a></li>
            <li class="breadcrumb-item active"><a href="#">Tambah Pasien Periksa</a></li>
        </ol>
    </div>
</div>

<!-- Pencarian Pasien -->
<div class="modal fade" id="modalPasien">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Data Pasien</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive card-table"> 
                    <table id="example5" class="display dataTablesCard white-border table-responsive-sm">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>No. RM</th>
                                <th>Nama Pasien</th>
                                <th>Tgl Lahir</th>
                                <th>No. HP</th>
                                <th>Pengobatan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pasien as $key=>$row)
                                <tr>
                                    <td>
                                        <a href="javascript:void(0)" 
                                            data-id="{{$row->id}}" data-nama="{{$row->nama}}"
                                            data-no="{{$row->no_rm}}"
                                            data-metode="{{$row->cara_bayar}}"
                                             class="btn btn-primary shadow btn-xs pilihPasien">
                                            Pilih</a>
                                    </td>
                                    <td>RM#{{$row->no_rm}}</td>
                                    <td>{{$row->nama}}</td>
                                    <td>{{$row->tgl_lahir}}</td>
                                    <td>{{$row->no_hp}}</td>
                                    <td>{{$row->cara_bayar}}
                                        @if ($row->cara_bayar=="Jaminan Kesehatan")
                                            <br><strong> ({{$row->no_bpjs}})</strong>
                                        @endif
                                    </td>
                                </tr>
                                
                            @endforeach
                        </tbody>
                        
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <div class="basic-form">
                    <form action="{{Route('rekam.store')}}" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Tanggal Periksa*</label>
                            <div class="col-sm-4">
                                <input type="date" name="tgl_rekam" class="form-control" value="{{date('Y-m-d')}}">
                                @error('tgl_rekam')
                                <div class="invalid-feedback animated fadeInUp"
                                style="display: block;">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Nama Pasien*</label>
                            <div class="col-sm-5 ">
                                <input type="hidden" class="form-control " id="pasien_id"
                                name="pasien_id" value="{{old('pasien_id')}}">
                                <div class="input-group transparent-append">
                                    <input type="text" id="pasien_nama" class="form-control"
                                      data-toggle="modal" data-target="#modalPasien" value="{{old('pasien_nama')}}"
                                     name="pasien_nama" placeholder="Pilih Pasien..">
                                    <div class="input-group-append show-pass"  data-toggle="modal" data-target="#modalPasien">
                                        <span class="input-group-text"> 
                                            <a href="javascript:void(0)"  data-toggle="modal" data-target="#modalPasien"><i class="fa fa-search"></i></a>
                                        </span>
                                    </div>
                                </div>
                                @error('pasien_id')
                                <div class="invalid-feedback animated fadeInUp"
                                style="display: block;">{{$message}}</div>
                                @enderror
                            </div>
                            <label class="col-sm-2 col-form-label">Cara Bayar*</label>
                            <div class="col-sm-3">
                                <select name="cara_bayar" id="cara_bayar" required class="form-control">
                                    <option value=""></option>
                                    <option value="Umum/Mandiri" {{old('cara_bayar')=="Umum/Mandiri" ? 'selected' : ''}}>Umum/Mandiri</option>
                                    <option value="Jaminan Kesehatan" {{old('cara_bayar')=="Jaminan Kesehatan" ? 'selected' : ''}}>Jaminan Kesehatan</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-10">
                                <div class="alert alert-warning left-icon-big alert-dismissible fade show">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                                    </button>
                                    <div class="media">
                                        <div class="alert-left-icon-big">
                                            <span><i class="mdi mdi-help-circle-outline"></i></span>
                                        </div>
                                        <div class="media-body">
                                            <p class="mb-0"><i>Jika tidak ada nama pasien / bpjs, silahkan lakukan tambah data dulu.</i>
                                                <a href="{{Route('pasien.add')}}">  klik disini !!</a>
                                                </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                           
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Keluhan*</label>
                            <div class="col-sm-10">
                                <textarea name="keluhan" required class="form-control"
                                rows="4">{{old('keluhan')}}</textarea>
                                {{-- <input type="text" name="keluhan" required class="form-control"> --}}
                                @error('keluhan')
                                <div class="invalid-feedback animated fadeInUp"
                                style="display: block;">{{$message}}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Poli Tujuan*</label>
                            <div class="col-sm-4">
                                <select name="poli" id="poli" class="form-control" required>
                                    <option value="">--Pilih Poli--</option>
                                    @foreach ($poli as $item)
                                        @if (old('poli') == $item->nama)
                                            <option value="{{$item->nama}}" selected>{{$item->nama}}</option>

                                        @else 
                                            <option value="{{$item->nama}}">{{$item->nama}}</option>

                                        @endif
                                    @endforeach
                                </select>
                                @error('poli')
                                <div class="invalid-feedback animated fadeInUp"
                                style="display: block;">{{$message}}</div>
                                @enderror
                            </div>

                            <label class="col-sm-2 col-form-label">Pilih Dokter*</label>
                            <div class="col-sm-4">
                                <select name="dokter_id" id="dokter_id" class="form-control">
                                  
                                </select>
                                @error('dokter_id')
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
    $( document ).ready(function() {
        $("#poli").change(function(e) {
            var poli = $("#poli").val();
            if (poli == '') return false;
            $.get(
                "{{ route('getDokter') }}",
                {
                    poli: poli
                },
                function(data) {
                    var string = '';
                    $.each(data.data, function(index, value) {
                        string = string + `<option value="` + value.id + `">` + value.nama + `</option>`;
                    })
                    $("#dokter_id").html(string);

                }
            );
         });
    });
     $(document).on("click", ".pilihPasien", function () {
        var id = $(this).data('id');
        var nama = $(this).data('nama');
        var no = $(this).data('no');
        var metode = $(this).data('metode');
        $("#pasien_nama").val(nama);
        $("#pasien_id").val(id);
        $("#cara_bayar").val(metode).change();

        $("#modalPasien").modal('hide');
        
        toastr.success("Pasien "+nama+" telah dipilih", "Sukses",{timeOut: 3000})
    });
</script>
@endsection