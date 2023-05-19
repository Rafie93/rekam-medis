@extends('layout.apps')
@section('content')
{{-- BREADCRUMBS --}}
<div class="form-head page-titles d-flex align-items-center mb-sm-4 mb-3">
    <div class="mr-auto">
        <h2 class="text-black font-w600">Pasien Detail</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Patient</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">RM#{{$pasien->no_rm}}</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">{{$rekam->no_rekam}}</a></li>

        </ol>
    </div>
    <div class="d-flex">
        @if ($rekam)
            {!! $rekam->status_display() !!}
        @endif  
    </div>
</div>


<!-- Pencarian Obat -->
<div class="modal fade" id="modalObat">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Data Obat</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive card-table"> 
                    <table class="display dataTablesCard white-border table-responsive-sm"
                            style="width: 100%"
                        id="obat-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Kode Obat</th>
                                <th>Nama Obat</th>
                                <th>Stok</th>
                                <th>Satuan</th>
                                <th>Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                        
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


{{-- DATA --}}
    <div class="row">
       
        <div class="col-xl-3 col-xxl-12">
            <div class="row">
                <div class="col-xl-12 col-xxl-5 col-lg-5">
                    <div class="card">
                        <div class="card-header border-0 pb-0">
                            <h4 class="fs-20 text-black mb-0">Detail Pasien</h4>
                            <div class="dropdown">
                                <div class="btn-link" role="button" data-toggle="dropdown" aria-expanded="false">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12 11C11.4477 11 11 11.4477 11 12C11 12.5523 11.4477 13 12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11Z" stroke="#2E2E2E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M12 18C11.4477 18 11 18.4477 11 19C11 19.5523 11.4477 20 12 20C12.5523 20 13 19.5523 13 19C13 18.4477 12.5523 18 12 18Z" stroke="#2E2E2E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path d="M12 4C11.4477 4 11 4.44772 11 5C11 5.55228 11.4477 6 12 6C12.5523 6 13 5.55228 13 5C13 4.44772 12.5523 4 12 4Z" stroke="#2E2E2E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </div>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#">Accept Patient</a>
                                    <a class="dropdown-item" href="#">Reject Order</a>
                                    <a class="dropdown-item" href="#">View Details</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="media mb-4 align-items-center">
                                <div class="media-body">
                                    <input type="hidden" id="pasien_id" value="{{$pasien->id}}">
                                    <input type="hidden" id="rekam_id" value="{{$rekam ? $rekam->id : '' }}">

                                    <h3 class="fs-18 font-w600 mb-1"><a href="javascript:void(0)"
                                         class="text-black">{{$pasien->nama}}</a></h3>
                                    <h4 class="fs-14 font-w600 mb-1">{{$pasien->tmp_lahir.", ".$pasien->tgl_lahir}}</h4>
                                    <h4 class="fs-14 font-w600 mb-1">{{$pasien->agama}}</h4>
                                    <h4 class="fs-14 font-w600 mb-1">{{$pasien->jk.", ".$pasien->status_menikah}}</h4>
                                    <span class="fs-14">{{$pasien->alamat_lengkap}}</span>
                                    <span class="fs-14">{{$pasien->keluhan.", ".$pasien->kecamatan.", ".$pasien->kabupaten.", ".$pasien->kewarganegaraan}}</span>
                                    {{-- <textarea name="analysis" class="form-control" id="editor" cols="30" rows="10"></textarea> --}}
                                      
                                </div>
                            </div>
                         
                        </div>
                    </div>
                </div>
                <div class="col-xl-12 col-xxl-7 col-lg-7">
                    <div class="card">
                        <div class="card-header border-0 pb-0">
                            <div>
                                <h4 class="fs-20 text-black mb-1">Info Detail</h4>
                                <span class="fs-12">Rincian Data</span>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-xl-12 col-xxl-6 col-sm-12">
                                    <div class="d-flex align-items-center">
                                        <span class="fs-12 col-6 p-0 text-black">
                                            Cara Bayar
                                        </span>
                                        <div class="col-8 p-0">
                                            <p>{{ $rekam->cara_bayar }}
                                            </p>
                                         </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <span class="fs-12 col-6 p-0 text-black">
                                            Keluhan
                                        </span>
                                        <div class="col-8 p-0">
                                            <p>{!! $rekam->keluhan !!}
                                            </p>
                                         </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <span class="fs-12 col-6 p-0 text-black">
                                            Diagnosa
                                        </span>
                                        <div class="col-8 p-0">
                                            <p>{{ $rekam->diagnosa." ".$rekam->diagnosis->name_id}}
                                            </p>
                                         </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <span class="fs-12 col-6 p-0 text-black">
                                            Tindakan
                                        </span>
                                        <div class="col-8 p-0">
                                            <p>{!! $rekam->tindakan !!}</p>
                                         </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if ($rekam->status==3)
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header border-0 pb-0">
                            <h4 class="fs-20 text-black mb-0">Pemberian Obat</h4>
                            @if ($rekam)
                               @if ($rekam->status==3)
                                   @if (auth()->user()->role_display()=="Admin")
                                        <a href="{{Route('rekam.status',[$rekam->id,5])}}" class="btn btn-success">
                                            Selesaikan Proses Ini Tanpa Pemberian Obat
                                            <span class="btn-icon-right"><i class="fa fa-check"></i></span>
                                        </a>
                                   @elseif (auth()->user()->role_display()=="Apotek")
                                        <a href="{{Route('rekam.status',[$rekam->id,5])}}" class="btn btn-success">
                                            Selesaikan Proses Ini Tanpa Pemberian Obat
                                            <span class="btn-icon-right"><i class="fa fa-check"></i></span>
                                        </a>
                                   @endif
                                @endif
                            @endif
                            
                        </div>
                        <div class="card-body pt-3">
                            <div class="row">
                                <div class="col-md-4">
                                    <form method="POST">
                                        {{-- <input type="hidden" class="form-control " id="obat_id"/> --}}
                                        <input type="hidden" class="form-control " id="stok"/>
                                        <input type="hidden" class="form-control " id="obat_code"/>

                                        <div class="form-group">
                                            <label class="text-black font-w500">Nama Obat*</label>
                                            <div class="input-group transparent-append">
                                                <input type="text" id="obat_id" class="form-control"
                                                  data-toggle="modal" data-target="#modalObat"
                                                 name="obat_id" placeholder="Pilih Obat..">
                                                <div class="input-group-append show-pass"  data-toggle="modal"
                                                 data-target="#modalObat">
                                                    <span class="input-group-text"> 
                                                        <a href="javascript:void(0)"  data-toggle="modal"
                                                         data-target="#modalObat"><i class="fa fa-search"></i></a>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="text-black font-w500">Nama Obat </label>
                                            <input type="text" id="nama_obat" class="form-control" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label class="text-black font-w500">Jumlah* </label>
                                            <input type="number" name="jumlah" id="jumlah" required class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label class="text-black font-w500">Harga* </label>
                                            <input type="number" name="harga" id="harga" required class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label class="text-black font-w500">Keterangan </label>
                                            <input type="text" id="keterangan" class="form-control">
                                        </div>
                                        
                                        <div class="form-group">
                                            <button type="button" onclick="addObat()" class="btn btn-info">+ Tambah</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-8">
                                    <div class="table-responsive">
                                        <h5>Obat Yang Akan Dikeluarkan</h5>
                                       <form action="{{Route('obat.pengeluaran.store')}}" method="POST">
                                        {{ csrf_field() }}
                                            <input type="hidden" name="rekam_id" value="{{$rekam->id}}">
                                            <input type="hidden" name="pasien_id" value="{{$pasien->id}}">
                                            <table  id="table-obat"
                                            class="table table-responsive-md table-bordered">
                                            <thead>
                                                <tr>
                                                    <th><strong>Kode</strong></th>
                                                    <th><strong>Nama</strong></th>
                                                    <th><strong>Jumlah</strong></th>
                                                    <th><strong>Harga</strong></th>
                                                    <th><strong>Total</strong></th>
                                                    <th><strong>Keterangan</strong></th>
                                                    <th><strong>#</strong></th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                            
                                        </table>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">SIMPAN & SELESAIKAN PROSES</button>
                                        </div>
                                       </form>
                                    </div>
                                </div>
                            </div>
                           
                        </div>
                    </div>
                </div>
                @elseif($rekam->status==4 || $rekam->status==5)
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header border-0 pb-0">
                            <h4 class="fs-20 text-black mb-0">Riwayat Obat</h4>
                           
                            
                        </div>
                        <div class="card-body pt-3">
                            <div class="row">
                                
                                <div class="col-md-12">
                                    <div class="table-responsive">                                      
                                            <table
                                            class="table table-responsive-md table-bordered">
                                            <thead>
                                                <tr>
                                                    <th><strong>Kode</strong></th>
                                                    <th><strong>Nama</strong></th>
                                                    <th><strong>Jumlah</strong></th>
                                                    <th><strong>Harga</strong></th>
                                                    <th><strong>Total</strong></th>
                                                    <th><strong>Keterangan</strong></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($pengeluaran as $item)
                                                    <tr>
                                                        <td>{{$item->obat->kd_obat}}</td>
                                                        <td>{{$item->obat->nama}}</td>
                                                        <td>{{$item->jumlah}}</td>
                                                        <td>{{number_format($item->harga)}}</td>
                                                        <td>{{number_format($item->subtotal)}}</td>
                                                        <td>{{$item->keterangan}}</td>
                                                    </tr>
                                                @endforeach

                                            </tbody>
                                            
                                        </table>
                                       
                                    </div>
                                </div>
                            </div>
                           
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('script')
<script>
    function addObat() { 
       var obatNama = $("#nama_obat").val();
       var obatId = $("#obat_id").val();
       var obatCode = $("#obat_code").val();

       var harga = $("#harga").val();
       var stok = $("#stok").val();
       var jumlah = $("#jumlah").val();
       var keterangan = $("#keterangan").val();

       if(jumlah=="" || obatId=="" || harga==""){
            alert("Obat Wajib Dipilih")
       }else{
            if(parseInt(jumlah) > parseInt(stok)){
                alert("Jumlah tidak sesuai stok");
            }
            var subtotal = parseInt(harga) * parseInt(jumlah);
            var markup = '<tr>'+
                    '<td>'+obatCode+
                        '<input type="hidden" name="obat_id[]" value="'+obatId+'"/>'+
                    '</td>'+
                    '<td>'+obatNama+
                    '</td>'+
                    '<td>'+jumlah+
                        '<input type="hidden" name="jumlah[]" value="'+jumlah+'"/>'+
                    '</td>'+
                    '<td>'+harga+
                        '<input type="hidden" name="harga[]" value="'+harga+'"/>'+
                    '</td>'+
                    '<td>'+subtotal+
                        '<input type="hidden" name="subtotal[]" value="'+subtotal+'"/>'+
                    '</td>'+
                    '<td>'+keterangan+
                        '<input type="hidden" name="keterangan[]" value="'+keterangan+'"/>'+
                    '</td>'+
                    '<td style="width: 80px">'+
                        // '<button type="button" class="btn btn-danger btnDelete">Hapus</button>'+
                        '<a href="#" class="btn btn-danger shadow btn-xs sharp btnDelete"><i class="fa fa-trash"></i></a>'+
                    '</td>'+
                    '</tr>';

             $("#table-obat tbody").append(markup);


       }
       
     }
    $(function () {
        var table = $('#obat-table').DataTable({
            processing: true,
            serverSide: true,
            searching: true,
            paging:true,
            select: false,
            pageLength: 5,
            lengthChange:false ,
            ajax: "{{ route('obat.data') }}",
            columns: [
                {data: 'action', name: 'action'},
                {data: 'kd_obat', name: 'kd_obat'},
                {data: 'nama', name: 'nama'},
                {data: 'stok', name: 'stok'},
                {data: 'satuan', name: 'satuan'},
                {data: 'harga', name: 'harga'}
            ]
        });

        $("#table-obat").on('click','.btnDelete',function(){
             $(this).closest('tr').remove();
        });
        
    });

    $(document).on("click", ".pilihObat", function () {
        var id = $(this).data('id');
        var nama = $(this).data('nama');
        var harga = $(this).data('harga');
        var stok = $(this).data('stok');
        var satuan = $(this).data('satuan');
        var code = $(this).data('code');
        $("#nama_obat").val(nama);
        $("#obat_id").val(id);
        $("#obat_code").val(code);

        $("#harga").val(harga);
        $("#stok").val(stok);

        // $("#cara_bayar").val(metode).change();

        $("#modalObat").modal('hide');
        
        // toastr.success("Obat "+nama+" telah dipilih", "Sukses",{timeOut: 3000})
    });
    
   
</script>
@endsection