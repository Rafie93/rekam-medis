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
                    <table class="display white-border table-responsive-sm"
                            style="width: 100%"
                        id="pasien-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>No. RM</th>
                                <th>Nama Pasien</th>
                                <th>Tgl Lahir</th>
                                <th>No. HP</th>
                                <th>Cara Bayar</th>
                                <th>No BPJS/KTP</th>
                            </tr>
                        </thead>
                        
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
                    <form action="{{Route('rekam.update',$data->id)}}" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">No Periksa*</label>
                            <div class="col-sm-4">
                                <input type="text" name="no_rekam" class="form-control" readonly
                                value="{{$data->no_rekam}}">
                                @error('no_rekam')
                                <div class="invalid-feedback animated fadeInUp"
                                style="display: block;">{{$message}}</div>
                                @enderror
                            </div>
                            <label class="col-sm-2 col-form-label">Tanggal Periksa*</label>
                            <div class="col-sm-4">
                                <input type="date" name="tgl_rekam" class="form-control" 
                                value="{{$data->tgl_rekam}}">
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
                                name="pasien_id" value="{{$data->pasien_id}}">
                                <div class="input-group transparent-append">
                                    <input type="text" id="pasien_nama" class="form-control"
                                      data-toggle="modal" data-target="#modalPasien" value="{{$data->pasien->nama}}"
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
                                    <option value="Umum/Mandiri" {{$data->cara_bayar=="Umum/Mandiri" ? 'selected' : ''}}>Umum/Mandiri</option>
                                    <option value="Jaminan Kesehatan" {{$data->cara_bayar=="Jaminan Kesehatan" ? 'selected' : ''}}>Jaminan Kesehatan</option>
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
                            <label class="col-sm-2 col-form-label">Anemnesa / <br>Keluhan*</label>
                            <div class="col-sm-10">
                                <textarea name="keluhan" required class="form-control"
                                rows="4">{{$data->keluhan}}</textarea>
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
                                        @if ($data->poli == $item->nama)
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
                                  <option value="{{$data->dokter_id}}">{{$data->dokter->nama}}</option>
                                </select>
                                @error('dokter_id')
                                <div class="invalid-feedback animated fadeInUp"
                                style="display: block;">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                       
                        <hr>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">UPDATE</button>
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
    $(function () {
        var table = $('#pasien-table').DataTable({
            processing: true,
            serverSide: true,
            searching: true,
            paging:true,
            select: false,
            pageLength: 5,
            lengthChange:false ,
            ajax: "{{ route('pasien.json') }}",
            columns: [
                {data: 'action', name: 'action'},
                {data: 'no_rm', name: 'no_rm'},
                {data: 'nama', name: 'nama'},
                {data: 'tgl_lahir', name: 'tgl_lahir'},
                {data: 'no_hp', name: 'no_hp'},
                {data: 'cara_bayar', name: 'cara_bayar'},
                {data: 'no_bpjs', name: 'no_bpjs'}              
            ]
        });
        
    });

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