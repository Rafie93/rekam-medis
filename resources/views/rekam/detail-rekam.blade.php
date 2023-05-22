@extends('layout.apps')
@section('content')

@include('rekam.partial.modal-pemeriksaan')
{{-- MODAL TINAKAN --}}
@include('rekam.partial.modal-tindakan')
{{-- MODAL Diagnosa --}}
@include('rekam.partial.modal-diagnosa')
{{-- MODAL OBAT --}}
@include('rekam.partial.modal-resep-obat')

{{-- DATA --}}
    <div class="row">   
        <div class="">
            <div class="row">
                <div class="col-sm-12 col-sm-5 col-lg-5">
                    <div class="card">
                        <div class="card-header border-0 pb-0">
                            <h4 class="fs-20 text-black mb-0">Detail Pasien</h4>
                            <div class="dropdown">
                                RM#  {{$pasien->no_rm}}
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
                                    <h4 class="fs-14 font-w600 mb-1">{{$pasien->jk.", ".$pasien->status_menikah}}</h4>
                                    <span class="fs-14">{{$pasien->alamat_lengkap}}</span>
                                    <span class="fs-14">{{$pasien->keluhan.", ".$pasien->kecamatan.", ".$pasien->kabupaten.", ".$pasien->kewarganegaraan}}</span>
                                    {{-- <textarea name="analysis" class="form-control" id="editor" cols="30" rows="10"></textarea> --}}
                                    <br>
                                    @if ($pasien->isRekamGigi())
                                        <a href="{{Route('rekam.gigi.odontogram',$pasien->id)}}" style="width: 120px"
                                            class="btn-rounded btn-info btn-xs "><i class="fa fa-eye"></i> Odontogram</a>
                                    @endif
                                    
                                </div>
                            </div>
                         
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-sm-7 col-lg-7">
                    <div class="card">
                        <div class="card-header border-0 pb-0">
                            <h4 class="fs-20 text-black mb-0">Info Pasien</h4>
                            <div class="dropdown">
                                 @if ($rekamLatest)
                                    {!! $rekamLatest->status_display() !!}
                                @endif 
                                @if (auth()->user()->role_display()=="Admin")
                                <a href="{{Route('pasien.edit',$pasien->id)}}" style="width: 120px"
                                    class="btn-rounded btn-info btn-xs "><i class="fa fa-pencil"></i> Edit Pasien</a>
                                @endif
                              
                                
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
                                   
                                    <div class="d-flex align-items-center">
                                        <span class="fs-12 col-6 p-0 text-black">
                                            <svg class="mr-2" width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <rect width="19" height="19" fill="#5FBF91"/>
                                            </svg>
                                            Pembayaran
                                        </span>
                                        <div class="col-8 p-0">
                                           @if ($rekamLatest)
                                            <p>{{$rekamLatest->cara_bayar}}</p>
                                            <p>{{$pasien->no_bpjs}}</p>
                                           @else 
                                            <p>{{$pasien->cara_bayar}}</p>
                                            <p>{{$pasien->no_bpjs}}</p>
                                           @endif
                                           
                                        </div>
                                    </div>
                                    <div class="d-flex mb-3 align-items-center">
                                        <span class="fs-12 col-6 p-0 text-black">
                                            <svg class="mr-2" width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <rect width="19" height="19" fill="#5F74BF"/>
                                            </svg>
                                            Alergi
                                        </span>
                                        <div class="col-8 p-0">
                                           <p>{{$pasien->alergi}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12">
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
                        <div class="card-body">
                            <div class="table-responsive card-table">
                                <table  class="table table-sm table-responsive-md table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tgl Periksa</th>
                                            <th>Dokter</th>
                                            <th>Anamnesa (S)</th>
                                            <th>Pemeriksaan (O)</th>
                                            <th>Diagnosa (A)</th>
                                            <th>Tindakan (P)</th>
                                            <th>#</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($rekams as $key=>$row)
                                            <tr>
                                                <td>{{ $rekams->firstItem() + $key }}</td>
                                            <td>{{$row->tgl_rekam}}</td>
                                            <td>{{$row->dokter->nama}}
                                                <br><strong>{{$row->poli}}</strong>
                                            </td>
                                            <td>{{$row->keluhan}}</td>
                                            <td>
                                                @if ($row->poli=="Poli Gigi")
                                                    @foreach ($row->gigi() as $item)
                                                        <li>Gigi {{$item->elemen_gigi}} : {{$item->pemeriksaan}}</li>
                                                    @endforeach
                                                @else 
                                                    {!! $row->pemeriksaan !!}</td>
                                                @endif
                                            <td>
                                                @if ($row->poli=="Poli Gigi")
                                                    @foreach ($row->gigi() as $item)
                                                        <li>{{$item->diagnosa.", ".$item->diagnosis->name_id}}</li>
                                                    @endforeach
                                                @else 
                                                    {{$row->diagnosa}}
                                                    @if ($row->diagnosa!=null)
                                                        <br/>{{$row->diagnosis->name_id}}
                                                    @endif
                                                @endif
                                            <td>
                                                @if ($row->poli=="Poli Gigi")
                                                    @foreach ($row->gigi() as $item)
                                                        <li>{{$item->tindak->nama}}</li>
                                                    @endforeach
                                                @else 
                                                     {!! $row->tindakan !!}</td>
                                                @endif
                                            <td>
                                                
                                            @if ($row->status!=5 && $row->status!=4)
                                            <div class="btn-group-vertical" role="group" aria-label="Vertical button group">
                                               @if ($row->poli!="Poli Gigi")
                                                    @if (auth()->user()->role_display() == "Dokter" 
                                                    || auth()->user()->role_display() == "Admin"
                                                    || auth()->user()->role_display() == "Pendaftaran")
                                                        <a href="javascript:void(0)" data-toggle="modal" data-target="#addPemeriksaan"
                                                        data-id="{{$row->id}}" data-tanggal="{{$row->tgl_rekam}}"
                                                        data-pemeriksaan="{{$row->pemeriksaan}}" style="width: 120px"
                                                        class="btn-rounded btn-info btn-xs addPemeriksaan"><i class="fa fa-pencil"></i> Object</a>
                                                    @endif
                                                        
                                                    @if (auth()->user()->role_display() == "Dokter" || auth()->user()->role_display() == "Admin")
                                                        <a href="javascript:void(0)" data-toggle="modal" 
                                                            data-target="#addDiagnosa"
                                                            data-id="{{$row->id}}" data-tanggal="{{$row->tgl_rekam}}"
                                                            data-tindakan="{{$row->tindakan}}" style="width: 120px"
                                                            class="btn-rounded btn-primary btn-xs addDiagnosa">
                                                            <i class="fa fa-pencil"></i>Assessment</a>
                                                            
                                                            <a href="javascript:void(0)" data-toggle="modal" 
                                                            data-target="#addTindakan"
                                                            data-id="{{$row->id}}" data-tanggal="{{$row->tgl_rekam}}"
                                                            data-tindakan="{{$row->tindakan}}" style="width: 120px"
                                                            class="btn-rounded btn-success btn-xs addTindakan">
                                                            <i class="fa fa-pencil"></i>Plan</a>
                                                    @endif
                                                @else 
                                                    @if (auth()->user()->role_display() == "Dokter" 
                                                    || auth()->user()->role_display() == "Admin")
                                                        <a href="{{Route('rekam.gigi.add',$row->id)}}" style="width: 120px"
                                                        class="btn-rounded btn-info btn-xs "><i class="fa fa-pencil"></i> Rekam</a>

                                                        @if ($row->gigi()->count() > 0)
                                                            <a href="javascript:void(0)" data-toggle="modal" 
                                                            data-target="#addResep"
                                                            data-id="{{$row->id}}" data-tanggal="{{$row->tgl_rekam}}"
                                                            data-resep="{{$row->resep_obat}}" style="width: 120px"
                                                            class="btn-rounded btn-success btn-xs addResep">
                                                            <i class="fa fa-pencil"></i>Resep Obat</a>
                                                        @endif

                                                    @endif
                                                @endif 
                                                
                                               
                                            </div>
                                            @else
                                                <div class="d-flex">
                                                    <a href="{{Route('obat.pengeluaran',$row->id)}}" style="width: 120px" class="btn-rounded btn-primary btn-xs ">
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

    CKEDITOR.replace('editor3', {
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
        if(pemeriksaan=="--"){
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

    $(document).on("click", ".addResep", function () {
        var rekamId = $(this).data('id');
        var resep = $(this).data('resep');
        $(".modal-body #rekamId").val( rekamId );
        CKEDITOR.instances.editor3.setData( resep );

    });
</script>
@endsection