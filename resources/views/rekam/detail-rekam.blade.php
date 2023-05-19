@extends('layout.apps')
@section('content')
{{-- BREADCRUMBS --}}
<div class="form-head page-titles d-flex align-items-center mb-sm-4 mb-3">
    <div class="mr-auto">
        <h2 class="text-black font-w600">Pasien Detail</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Patient</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">RM#{{$pasien->no_rm}}</a></li>
            
        </ol>
    </div>
    <div class="d-flex">
        @if ($rekamLatest)
            {!! $rekamLatest->status_display() !!}
        @endif  
    </div>
</div>
{{-- MODAL PEMERIKSAAN --}}
<!-- Add -->
<div class="modal fade" id="addPemeriksaan">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pemeriksaan </h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{Route('pemeriksaan.update')}}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" id="rekamId" name="rekam_id" value="0">
                    <input type="hidden" id="pasienId" name="pasien_id" value="{{$pasien->id}}">
                    <div class="form-group">
                        <label class="text-black font-w500">Pemeriksaan*</label>
                        <textarea name="pemeriksaan"  required
                        id="editor" 
                        class="form-control" 
                        rows="10"></textarea>
                        @error('pemeriksaan')
                        <div class="invalid-feedback animated fadeInUp"
                        style="display: block;">{{$message}}</div>
                        @enderror
                       
                    </div>
                    
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">UPDATE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- MODAL TINAKAN --}}
<!-- Add -->
<div class="modal fade" id="addTindakan">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tindakan </h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{Route('tindakan.update')}}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" id="rekamId" name="rekam_id" value="0">
                    <input type="hidden" id="pasienId" name="pasien_id" value="{{$pasien->id}}">
                    <div class="form-group">
                        <label class="text-black font-w500">Tindakan*</label>
                        <textarea name="tindakan"  
                        id="editor2" required
                        class="form-control" 
                        rows="10"></textarea>
                        @error('tindakan')
                        <div class="invalid-feedback animated fadeInUp"
                        style="display: block;">{{$message}}</div>
                        @enderror
                       
                    </div>
                    
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">UPDATE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- MODAL Diagnosa --}}
<!-- Add -->
<div class="modal fade" id="addDiagnosa">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cari Diagnosa </h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{Route('diagnosa.update')}}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" id="rekamId" name="rekam_id" value="0">
                    <input type="hidden" id="pasienId" name="pasien_id" value="{{$pasien->id}}">
                    <div class="form-group">
                        {{-- <textarea name="diagnosa"  required
                        id="editor" 
                        class="form-control" 
                        rows="10"></textarea> --}}
                        <div class="row">
                            <table class="display dataTablesCard white-border table-responsive-sm"
                                style="width: 100%"
                             id="icd-table">
                                <thead>
                                    <tr>
                                        <th style="width: 5%">#</th>
                                        <th style="width: 15%">Kode</th>
                                        <th style="width: 80%">Nama</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        @error('diagnosa')
                        <div class="invalid-feedback animated fadeInUp"
                        style="display: block;">{{$message}}</div>
                        @enderror
                       
                    </div>
                    
                   
                </form>
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
                                    <input type="hidden" id="rekam_id" value="{{$rekamLatest ? $rekamLatest->id : '' }}">

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
                                <h4 class="fs-20 text-black mb-1">Info Pasien</h4>
                                <span class="fs-12">Rincian Data Pasien</span>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row align-items-center">
                               
                                <div class="col-xl-12 col-xxl-6 col-sm-6">
                                    <div class="d-flex mb-3 align-items-center">
                                        <span class="fs-12 col-6 p-0 text-black">
                                            <svg class="mr-2" width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <rect width="19" height="19" fill="#5F74BF"/>
                                            </svg>
                                            No HP
                                        </span>
                                        <div class="col-8 p-0">
                                           <p>{{$pasien->no_hp}}</p>
                                        </div>
                                    </div>
                                    <div class="d-flex mb-3 align-items-center">
                                        <span class="fs-12 col-6 p-0 text-black">
                                            <svg class="mr-2" width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <rect width="19" height="19" fill="#FFD439"/>
                                            </svg>
                                            Pendidikan
                                        </span>
                                        <div class="col-8 p-0">
                                            <p>{{$pasien->pendidikan}}</p>
                                        </div>
                                    </div>
                                    <div class="d-flex mb-3 align-items-center">
                                        <span class="fs-12 col-6 p-0 text-black">
                                            <svg class="mr-2" width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <rect width="19" height="19" fill="#FF6E5A"/>
                                            </svg>
                                            Pekerjaan
                                        </span>
                                        <div class="col-8 p-0">
                                            <p>{{$pasien->pekerjaan}}</p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <span class="fs-12 col-6 p-0 text-black">
                                            <svg class="mr-2" width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <rect width="19" height="19" fill="#5FBF91"/>
                                            </svg>
                                            Pembayaran
                                        </span>
                                        <div class="col-8 p-0">
                                           
                                            <p>{{$rekamLatest->cara_bayar}}</p>
                                            @if ($rekamLatest->cara_bayar!="Umum/Mandiri")
                                            <p>{{$pasien->no_bpjs}}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header border-0 pb-0">
                            <h4 class="fs-20 text-black mb-0">Rekam Medis Pasien</h4>
                            @if ($rekamLatest)
                                @if ($rekamLatest->status==1)
                                    @if (auth()->user()->role_display()=="Admin" ||
                                         auth()->user()->role_display()=="Pendaftaran")
                                        <a href="{{Route('rekam.status',[$rekamLatest->id,2])}}" class="btn btn-primary">
                                            Lanjutkan Ke Dokter
                                            <span class="btn-icon-right"><i class="fa fa-check"></i></span>
                                        </a>
                                    @endif
                                @elseif ($rekamLatest->status==2)
                                   @if (auth()->user()->role_display()=="Admin" || auth()->user()->role_display()=="Dokter")
                                        <a href="{{Route('rekam.status',[$rekamLatest->id,3])}}" class="btn btn-primary">
                                            Selesaikan Pemeriksaan & Perawatan
                                            <span class="btn-icon-right"><i class="fa fa-check"></i></span>
                                        </a>
                                   @endif
                                @elseif ($rekamLatest->status==4)
                                   @if (auth()->user()->role_display()=="Admin" || auth()->user()->role_display()=="Pendaftaran")
                                        <a href="{{Route('rekam.status',[$rekamLatest->id,5])}}" class="btn btn-primary">
                                            Selesaikan Pembayaran & Rekam Medis ini
                                            <span class="btn-icon-right"><i class="fa fa-check"></i></span>
                                        </a>
                                   @endif
                                @elseif ($rekamLatest->status==3)
                                   @if (auth()->user()->role_display()=="Admin")
                                        <a href="{{Route('rekam.status',[$rekamLatest->id,5])}}" class="btn btn-primary">
                                            Selesaikan Rekam Medis Ini
                                            <span class="btn-icon-right"><i class="fa fa-check"></i></span>
                                        </a>
                                   @endif
                               
                                @endif
                            @endif
                            
                        </div>
                        <div class="card-body pt-3">
                            <div class="table-responsive">
                                <table  class="table table-responsive-md table-bordered">
                                    <thead>
                                        <tr>
                                            <th><strong>No</strong></th>
                                            {{-- <th><strong>Status</strong></th> --}}
                                            <th><strong>Tgl Periksa</strong></th>
                                            <th><strong>Keluhan / Anamnesa</strong></th>
                                            <th><strong>Pemeriksaan Klinik</strong></th>
                                            <th><strong>Diagnosa</strong></th>
                                            <th><strong>Terapi & Tindakan</strong></th>
                                            <th><strong>#</strong></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($rekams as $key=>$row)
                                            <tr>
                                                <td>{{ $rekams->firstItem() + $key }}</td>
                                                {{-- <td>{!!$row->status_rekams()!!}</td> --}}
                                            <td>{{$row->tgl_rekam}}</td>
                                            <td>{{$row->keluhan}}</td>
                                            <td>{!! $row->pemeriksaan !!}</td>
                                            <td>{{$row->diagnosa}}
                                                @if ($row->diagnosa!=null)
                                                    <br/>{{$row->diagnosis->name_id}}
                                                @endif
                                            <td>{!! $row->tindakan !!}</td>
                                            {{-- <td>{!!$row->status_display()!!}</td> --}}
                                            <td>
                                                
                                            @if ($row->status!=5 && $row->status!=4)
                                            <div class="btn-group-vertical" role="group" aria-label="Vertical button group">
                                                
                                               @if (auth()->user()->role_display() == "Dokter" 
                                               || auth()->user()->role_display() == "Admin"
                                               || auth()->user()->role_display() == "Pendaftaran")
                                                <a href="javascript:void(0)" data-toggle="modal" data-target="#addPemeriksaan"
                                                data-id="{{$row->id}}" data-tanggal="{{$row->tgl_rekam}}"
                                                data-pemeriksaan="{{$row->pemeriksaan}}" style="width: 150px"
                                                class="btn-rounded btn-info btn-xs addPemeriksaan"><i class="fa fa-pencil"></i> Isi Pemeriksaan</a>
                                               @endif
                                                
                                               @if (auth()->user()->role_display() == "Dokter" || auth()->user()->role_display() == "Admin")
                                               <a href="javascript:void(0)" data-toggle="modal" 
                                                data-target="#addDiagnosa"
                                                data-id="{{$row->id}}" data-tanggal="{{$row->tgl_rekam}}"
                                                data-tindakan="{{$row->tindakan}}" style="width: 150px"
                                                class="btn-rounded btn-primary btn-xs addDiagnosa">
                                                <i class="fa fa-pencil"></i> Isi Diagnosa</a>
                                                
                                                <a href="javascript:void(0)" data-toggle="modal" 
                                                data-target="#addTindakan"
                                                data-id="{{$row->id}}" data-tanggal="{{$row->tgl_rekam}}"
                                                data-tindakan="{{$row->tindakan}}" style="width: 150px"
                                                class="btn-rounded btn-success btn-xs addTindakan">
                                                <i class="fa fa-pencil"></i> Isi Tindakan</a>


                                                
                                               @endif
                                            </div>
                                            @else
                                                <div class="d-flex">
                                                    <a href="{{Route('obat.pengeluaran',$row->id)}}" class="btn btn-primary shadow btn-xs">
                                                        <i class="fa fa-eye"></i> Obat</a>
                                                </div>                                                   
                                            @endif
                                            </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    
                                </table>
                                <div class="dataTables_info" id="example_info" role="status"
                                aria-live="polite">Showing {{$rekams->firstItem()}} to {{$rekams->perPage() * $rekams->currentPage()}} of {{$rekams->total()}} entries</div>
           
                               {{ $rekams->appends(request()->except('page'))->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script src="{{asset('vendor/ckeditor/ckeditor.js')}}"></script>
<script>
    $(function () {
        var table = $('#icd-table').DataTable({
            processing: true,
            serverSide: true,
            searching: true,
            paging:true,
            select: false,
            pageLength: 5,
            lengthChange:false ,
            ajax: "{{ route('icd.data') }}",
            columns: [
                {data: 'action', name: 'action'},
                {data: 'code', name: 'code'},
                {data: 'name_id', name: 'name_id'}
            ]
        });
        
    });
    
    CKEDITOR.addCss('.cke_editable p { margin: 0 !important; }');
    CKEDITOR.replace('editor', {
        height  : '250px',
        filebrowserUploadUrl: "{{route('rekam.upload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form',
        toolbarGroups: [
		{ name: 'document',	   groups: [ 'mode', 'document' ] },		
 		{ name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },			
        { name: 'insert', groups: [ 'Image'] },
	]
    });

    CKEDITOR.replace('editor2', {
        height  : '250px',
        filebrowserUploadUrl: "{{route('rekam.upload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form',
        toolbarGroups: [
		{ name: 'document',	   groups: [ 'mode', 'document' ] },		
 		{ name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },			
        { name: 'insert', groups: [ 'Image'] },
	]
    });
   
    $(document).on("click", ".addPemeriksaan", function () {
        var rekamId = $(this).data('id');
        var pemeriksaan = $(this).data('pemeriksaan');
        $(".modal-body #rekamId").val( rekamId );
        if(pemeriksaan==""){
            pemeriksaan = '<table border="0" cellpadding="0" cellspacing="0" style="width:100%">'+
                    '<tbody>'+
                        '<tr>'+
                            '<td style="width:20%">TD</td>'+
                            '<td style="width:2%">:</td>'+
                            '<td>&nbsp;</td>'+
                        '</tr>'+
                        '<tr>'+
                            '<td>Temp</td>'+
                            '<td>:</td>'+
                            '<td>&nbsp;</td>'+
                        '</tr>'+
                        '<tr>'+
                            '<td>Resp</td>'+
                            '<td>:</td>'+
                            '<td>&nbsp;</td>'+
                        '</tr>'+
                        '<tr>'+
                            '<td>Nadi</td>'+
                            '<td>:</td>'+
                            '<td>&nbsp;</td>'+
                        '</tr>'+
                        '<tr>'+
                            '<td>BB</td>'+
                            '<td>:</td>'+
                            '<td>&nbsp;</td>'+
                        '</tr>'+
                        
                    '</tbody>'+
                '</table>'+
                '<p>&nbsp;</p>';
        }
        CKEDITOR.instances.editor.setData( pemeriksaan );

    });

    $(document).on("click", ".pilihIcd", function () {
        var diagnosa_id = $(this).data('id');
        var rekam_id = $("#rekam_id").val();
        var pasien_id = $("#pasien_id").val();
        var token = '{{csrf_token()}}';
        $("#addDiagnosa").modal('hide');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });   
        $.ajax({
           type:'POST',
           url:"{{ route('diagnosa.update') }}",
           data:{rekam_id:rekam_id, pasien_id:pasien_id, diagnosa:diagnosa_id,_token:token},
           success:function(data){
                location.reload();
           }
        });

        
    });

    $(document).on("click", ".addTindakan", function () {
        var rekamId = $(this).data('id');
        var tindakan = $(this).data('tindakan');
        $(".modal-body #rekamId").val( rekamId );
        CKEDITOR.instances.editor2.setData( tindakan );
    });

    $(document).on("click", ".addDiagnosa", function () {
        var rekamId = $(this).data('id');
        var diagnosa = $(this).data('diagnosa');
        $(".modal-body #rekamId").val( rekamId );
        CKEDITOR.instances.editor.setData( diagnosa );

    });
</script>
@endsection