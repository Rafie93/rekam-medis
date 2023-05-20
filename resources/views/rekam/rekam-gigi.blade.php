@extends('layout.apps')
@section('content')
<div class="mr-auto">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{Route('rekam.detail',$rekam->pasien_id)}}">Rekam Medis</a></li>
        <li class="breadcrumb-item active"><a href="#">Tambah Rekam Gigi {{$rekam->pasien->nama}}</a></li>
    </ol>
</div>
@include('rekam.partial.modal-diagnosa-gigi')

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <div class="basic-form">
                    <table class="table" style="width: 100%">
                    <tbody>
                        {{-- <tr>
                            <td>
                                <div id="tratamiento">
                                    <h2>Tratamiento</h2>
                                    <select 
                                      data-bind=" options: tratamientosPosibles, 
                                                  value: tratamientoSeleccionado, 
                                                  optionsText: function(item){ return item.nombre; },
                                                  optionsCaption: 'Seleccione un tratamiento...'">
                                    </select>
                                    <ul data-bind="foreach: tratamientosAplicados">
                                      <li>
                                        P<span data-bind="text: diente.id"></span><span data-bind="text: cara"></span>
                                        -            
                                        <span data-bind="text: tratamiento.nombre"></span>
                                        | 
                                        <a href="#" data-bind="click: $parent.quitarTratamiento">Eliminar</a>
                                      </li>
                                    </ul>
                                  </div>
                            </td>
                        </tr> --}}
                        <tr>
                            <td align="center">
                                <div id="odontograma"></div>
                            </td>
                        </tr>
                    </tbody>
                    </table>
                    <form action="{{Route('rekam.gigi.store',$rekam->id)}}" method="POST">
                        {{ csrf_field() }}
                        <hr>
                        <div class="row">
                            <div class="card-body pt-3">
                                <div class="row">
                                    <div class="col-md-4">
                                            
                                            <div class="form-group">
                                                <label class="text-black font-w500">Element Gigi*</label>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                            <select name="element_gigi" id="element_gigi" class="form-control">
                                                                @php
                                                                    for ($i=11; $i < 19; $i++) { 
                                                                        echo "<option value='".$i."'>".$i."</option>";
                                                                    }
                                                                    for ($i=21; $i < 29; $i++) { 
                                                                        echo "<option value='".$i."'>".$i."</option>";
                                                                    }
                                                                    for ($i=31; $i < 39; $i++) { 
                                                                        echo "<option value='".$i."'>".$i."</option>";
                                                                    }
                                                                    for ($i=41; $i < 49; $i++) { 
                                                                        echo "<option value='".$i."'>".$i."</option>";
                                                                    }
                                                                    for ($i=48; $i < 53; $i++) { 
                                                                        echo "<option value='".$i."'>".$i."</option>";
                                                                    }
                                                                    for ($i=61; $i < 66; $i++) { 
                                                                        echo "<option value='".$i."'>".$i."</option>";
                                                                    }
                                                                    for ($i=71; $i < 76; $i++) { 
                                                                        echo "<option value='".$i."'>".$i."</option>";
                                                                    }
                                                                    for ($i=78; $i < 83; $i++) { 
                                                                        echo "<option value='".$i."'>".$i."</option>";
                                                                    }
                                                                @endphp
                                                            </select>
                                                        
                                                    </div>
                                                    <div class="col-md-6">
                                                        <select  id="posisi_gigi" class="form-control">
                                                            <option value="X">X</option>
                                                            <option value="C">C</option>
                                                            <option value="S">S</option>
                                                            <option value="D">D</option>
                                                            <option value="Z">Z</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- <div class="form-group">
                                                <label class="text-black font-w500">Pemeriksaan </label>
                                                <input type="text" id="pemeriksaan" class="form-control" >
                                            </div> --}}
                                            <div class="form-group">
                                                <label class="text-black font-w500">Diagnosa*</label>
                                                <div class="input-group transparent-append">
                                                    <input type="text" id="diagnosa" class="form-control"
                                                      data-toggle="modal" data-target="#addDiagnosa" readonly
                                                     name="diagnosa" placeholder="">
                                                    <div class="input-group-append show-pass"  data-toggle="modal"
                                                     data-target="#addDiagnosa">
                                                        <span class="input-group-text"> 
                                                            <a href="javascript:void(0)"  data-toggle="modal"
                                                             data-target="#modalObat"><i class="fa fa-search"></i></a>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="text-black font-w500">Tindakan/Prosedur* </label>
                                                <select name="tindakan" id="tindakan" class="form-control">
                                                    @foreach ($tindakan as $item)
                                                        <option value="{{$item->kode}}">{{$item->nama}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                           
                                           
                                            <div class="form-group">
                                                <button type="button" onclick="addRekam()" class="btn btn-info">+ Tambah</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="table-responsive card-table">
                                            <h5>Rincian</h5>
                                                <table  id="table-tindakan"
                                                class="table table-responsive-md table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Elemen Gigi</th>
                                                        <th>Diagnosa</th>
                                                        <th>Tindakan</th>
                                                        <th><strong>#</strong></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
    
                                                </tbody>
                                                
                                            </table>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary">SIMPAN</button>
                                            </div>
                                           {{-- </form> --}}
                                        </div>
                                    </div>
                                </div>
                               
                            </div>
                        </div>
                        {{-- <hr>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">SIMPAN</button>
                        </div> --}}

                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('header')
<link rel="stylesheet" href="{{asset('odontograma/css/jquery.svg.css')}}">
<link rel="stylesheet" href="{{asset('odontograma/css/odontograma.css')}}">

@endsection
@section('script')
<script src="{{asset('odontograma/js/modernizr-2.0.6.min.js')}}"></script>
{{-- <script defer src="{{asset('odontograma/js/jquery-1.7.1.min.js')}}"></script> --}}

<script defer src="{{asset('odontograma/js/plugins.js')}}"></script>

<script defer src="{{asset('odontograma/js/jquery-ui-1.8.17.custom.min.js')}}"></script>

<script defer src="{{asset('odontograma/js/jquery.tmpl.j')}}s"></script>
<script defer src="{{asset('odontograma/js/knockout-2.0.0.js')}}"></script>
<script defer src="{{asset('odontograma/js/jquery.svg.min.js')}}"></script>  
<script defer src="{{asset('odontograma/js/jquery.svggraph.min.js')}}"></script>  
<script defer src="{{asset('odontograma/js/odontograma.js')}}"></script>
<script>
    function addRekam() { 
       var element_gigi = $("#element_gigi").val();
       var posisi_gigi = $("#posisi_gigi").val();
       var tindakan = $("#tindakan").val();
       var diagnosa = $("#diagnosa").val()

       if(posisi_gigi=="" || tindakan=="" || diagnosa==""){
            alert("Form Wajib Dipilih")
       }else{
            
            var markup = '<tr>'+
                    '<td>'+element_gigi+posisi_gigi+
                        '<input type="hidden" name="element_gigi[]" value="'+element_gigi+posisi_gigi+'"/>'+
                    '</td>'+
                    
                    '<td>'+diagnosa+
                        '<input type="hidden" name="diagnosa[]" value="'+diagnosa+'"/>'+
                    '</td>'+
                    '<td>'+tindakan+
                        '<input type="hidden" name="tindakan[]" value="'+tindakan+'"/>'+
                    '</td>'+
                    
                    '<td style="width: 80px">'+
                        // '<button type="button" class="btn btn-danger btnDelete">Hapus</button>'+
                        '<a href="#" class="btn btn-danger shadow btn-xs sharp btnDelete"><i class="fa fa-trash"></i></a>'+
                    '</td>'+
                    '</tr>';

             $("#table-tindakan tbody").append(markup);


       }
       
     }
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

        $(document).on("click", ".pilihIcd", function () {
            var diagnosa_id = $(this).data('id');
            var rekam_id = $("#rekam_id").val();
            var pasien_id = $("#pasien_id").val();
            var token = '{{csrf_token()}}';
            $("#diagnosa").val(diagnosa_id);
            $("#addDiagnosa").modal('hide');
        

            
        });

        
        
    });
</script>

@endsection