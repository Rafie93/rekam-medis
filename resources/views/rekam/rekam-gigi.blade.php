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
                    <a href="{{Route('rekam.gigi.odontogram',$rekam->pasien_id)}}" style="width: 120px"
                        class="btn-rounded btn-info btn-xs "><i class="fa fa-eye"></i> Lihat Riwayat Odontogram</a>
                        <br/><br/>
                    <table class="table" style="width: 100%">
                    <tbody>
                        
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
                                    @if ($rekam->status <= 2)
                                        <div class="col-md-4">
                                                
                                            <div class="form-group">
                                                <label class="text-black font-w500">Element Gigi*</label>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                            <select id="element_gigi" class="form-control">
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
                                                                    for ($i=51; $i < 56; $i++) { 
                                                                        echo "<option value='".$i."'>".$i."</option>";
                                                                    }
                                                                    for ($i=61; $i < 66; $i++) { 
                                                                        echo "<option value='".$i."'>".$i."</option>";
                                                                    }
                                                                    for ($i=71; $i < 76; $i++) { 
                                                                        echo "<option value='".$i."'>".$i."</option>";
                                                                    }
                                                                    for ($i=81; $i < 86; $i++) { 
                                                                        echo "<option value='".$i."'>".$i."</option>";
                                                                    }
                                                                @endphp
                                                            </select>
                                                        
                                                    </div>
                                                
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="text-black font-w500">Kondisi Gigi* </label>
                                                <select name="pemeriksaan" id="kondisi_gigi" class="form-control">
                                                    @foreach ($kondisi_gigi as $item)
                                                        <option value="{{$item->kode}}">{{$item->kode}} || {{$item->nama}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
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
                                    @endif
                                    <div class="col-md-{{$rekam->status <= 2 ? '8' : '12'}}">
                                        <div class="table-responsive card-table">
                                            <h5>Rincian</h5>
                                                <table  id="table-tindakan"
                                                class="table table-responsive-md table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Elemen Gigi</th>
                                                        <th>Kondisi Gigi</th>
                                                        <th>Diagnosa</th>
                                                        <th>Tindakan</th>
                                                        <th><strong>#</strong></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($pem_gigi as $row)
                                                        <tr>
                                                            <td>{{$row->elemen_gigi}}</td>
                                                            <td>{{$row->pemeriksaan}}</td>
                                                            <td>{{$row->diagnosa}}</td>
                                                            <td>{{$row->tindakan}}</td>
                                                            <td> @if ($rekam->status<=2)
                                                                <a href="#" class="btn btn-danger shadow btn-xs sharp delete" 
                                                                    r-link="{{Route('rekam.gigi.delete',$row->id)}}"
                                                                    r-name="{{$row->elemen_gigi}}" r-id="{{$row->id}}"><i class="fa fa-trash"></i></a>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                                
                                            </table>
                                           @if ($rekam->status<=2)
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary">SIMPAN</button>
                                                </div>
                                           @endif
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
{{-- <script defer src="{{asset('odontograma/js/odontograma.js')}}"></script> --}}
<script>
    function addRekam() { 
       var element_gigi = $("#element_gigi").val();
       var tindakan = $("#tindakan").val();
       var diagnosa = $("#diagnosa").val()
       var kondisi_gigi = $("#kondisi_gigi").val();

       if(kondisi_gigi=="" || tindakan=="" || diagnosa==""){
            alert("Form Wajib Dipilih")
       }else{
            
            var markup = '<tr>'+
                    '<td>'+element_gigi+
                        '<input type="hidden" name="element_gigi[]" value="'+element_gigi+'"/>'+
                    '</td>'+
                    '<td>'+kondisi_gigi+
                        '<input type="hidden" name="pemeriksaan[]" value="'+kondisi_gigi+'"/>'+
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

        $(".delete").click(function() {
                var id = $(this).attr('r-id');
                var name = $(this).attr('r-name');
                var link = $(this).attr('r-link');

                Swal.fire({
                title: 'Ingin Menghapus?',
                text: "Yakin ingin menghapus data  : "+name+" ini ?" ,
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, hapus !'
            }).then((result) => {
                console.log(result);
                if (result.value) {
                    window.location = link;
                }
            });
        });

        
        
     });

     jQuery(function(){
            

        function drawDiente(svg, parentGroup, diente){
            if(!diente) throw new Error('Error no se ha especificado el diente.');
            
            var x = diente.x || 0,
                y = diente.y || 0;
            // console.log(diente);
            var color = 'white';
            var colorI = 'white';
            var colorS = 'white';
            var colorZ = 'white';
            var colorD = 'white';
            var colorC = 'white';
            var stroke = 'navy';
            var strokeWidth = 0.5;

            if (diente.id=="mis") {
                color = 'red';
                colorC = 'red';
                colorS ='red';
                colorI = 'red';
                colorZ = 'red';
                colorD = 'red';
            }else  if (diente.id=="amf") {
                colorC = 'black';
            }else  if (diente.id=="gif") {
                colorC = 'green';
            }else  if (diente.id=="fis") {
                colorC = 'red';
            }
            else  if (diente.id=="car") {
               stroke = 'black';
               strokeWidth = 1.5;
            }else  if (diente.id=="nvt") {
                colorS = 'black';
            }
            else  if (diente.id=="cfr") {
              colorC = 'black';
              colorS = 'black';
              colorI = 'black';
            }else  if (diente.id=="amf") {
                colorC = 'black';
                colorS = 'black';
            }
            else  if (diente.id=="poc") {
                colorC = 'green';
                color = 'green';
                colorC = 'green';
                colorS ='green';
                colorI = 'green';
                colorZ = 'green';
                colorD = 'green';
                stroke = 'black';
            }
            else  if (diente.id=="fmc") {
                colorC = 'black';
                color = 'black';
                colorC = 'black';
                colorS ='black';
                colorI = 'black';
                colorZ = 'black';
                colorD = 'black';
                stroke = 'black';
                strokeWidth = 0.7;
            }
            else  if (diente.id=="abu") {
                colorC = 'grey';
                color = 'grey';
                colorC = 'grey';
                colorS ='grey';
                colorI = 'grey';
                colorZ = 'grey';
                colorD = 'grey';
            }
            var defaultPolygon = {fill: color, stroke: 'navy', strokeWidth: 0.5};
            var iPoloygon = {fill: colorI, stroke: stroke, strokeWidth: strokeWidth};
            var sPoloygon = {fill: colorS, stroke: stroke, strokeWidth: strokeWidth};
            var dPoloygon = {fill: colorD, stroke: stroke, strokeWidth: strokeWidth};
            var zPoloygon = {fill: colorZ, stroke: stroke, strokeWidth: strokeWidth};
            var cPoloygon = {fill: colorC, stroke: stroke, strokeWidth: strokeWidth};

            var dienteGroup = svg.group(parentGroup, {transform: 'translate(' + x + ',' + y + ')'});

            var caraSuperior = svg.polygon(dienteGroup,
                [[0,0],[20,0],[15,5],[5,5]],  
                sPoloygon);
            caraSuperior = $(caraSuperior).data('cara', 'S');

            // console.log(caraSuperior);
            
            var caraInferior =  svg.polygon(dienteGroup,
                [[5,15],[15,15],[20,20],[0,20]],  
                iPoloygon);			
            caraInferior = $(caraInferior).data('cara', 'I');

            var caraDerecha = svg.polygon(dienteGroup,
                [[15,5],[20,0],[20,20],[15,15]],  
                dPoloygon);
            caraDerecha = $(caraDerecha).data('cara', 'D');
            
            var caraIzquierda = svg.polygon(dienteGroup,
                [[0,0],[5,5],[5,15],[0,20]],  
                zPoloygon);
            caraIzquierda = $(caraIzquierda).data('cara', 'Z');		    
            
            var caraCentral = svg.polygon(dienteGroup,
                [[5,5],[15,5],[15,15],[5,15]],  
                cPoloygon);	
            caraCentral = $(caraCentral).data('cara', 'C');		    
            
            var caraCompleto = svg.text(dienteGroup, 6, 30, diente.id.toString(), 
                {fill: 'navy', stroke: 'navy', strokeWidth: 0.1, style: 'font-size: 6pt;font-weight:normal'});
            caraCompleto = $(caraCompleto).data('cara', 'X');
            
            //Busco los tratamientos aplicados al diente
            var tratamientosAplicadosAlDiente = ko.utils.arrayFilter(vm.tratamientosAplicados(), function(t){
                return t.diente.id == diente.id;
            });
            var caras = [];
            caras['S'] = caraSuperior;
            caras['C'] = caraCentral;
            caras['X'] = caraCompleto;
            caras['Z'] = caraIzquierda;
            caras['D'] = caraDerecha;

            for (var i = tratamientosAplicadosAlDiente.length - 1; i >= 0; i--) {
                var t = tratamientosAplicadosAlDiente[i];
                caras[t.cara].attr('fill', 'red');
            };

            $.each([caraCentral, caraIzquierda, caraDerecha, caraInferior, caraSuperior, caraCompleto], function(index, value){
                value.click(function(){
                    var me = $(this);
                    var cara = me.data('cara');
                    console.log(value);
                    if(!vm.tratamientoSeleccionado()){
                        alert(cara);	
                        return false;
                    }

                    //Validaciones
                    //Validamos el tratamiento
                    var tratamiento = vm.tratamientoSeleccionado();

                    if(cara == 'X' && !tratamiento.aplicaDiente){
                        alert('El tratamiento seleccionado no se puede aplicar a toda la pieza.');
                        return false;
                    }
                    if(cara != 'X' && !tratamiento.aplicaCara){
                        alert('El tratamiento seleccionado no se puede aplicar a una cara.');
                        return false;
                    }
                    //TODO: Validaciones de si la cara tiene tratamiento o no, etc...

                    vm.tratamientosAplicados.push({diente: diente, cara: cara, tratamiento: tratamiento});
                    vm.tratamientoSeleccionado(null);
                    
                    //Actualizo el SVG
                    renderSvg();
                }).mouseenter(function(){
                    var me = $(this);
                    me.data('oldFill', me.attr('fill'));
                    me.attr('fill', 'yellow');
                }).mouseleave(function(){
                    var me = $(this);
                    me.attr('fill', me.data('oldFill'));
                });			
            });
        };

        function renderSvg(){
            console.log('update render');

            var svg = $('#odontograma').svg('get').clear();
            var parentGroup = svg.group({transform: 'scale(1.5)'});
            var dientes = vm.dientes();
            for (var i =  dientes.length - 1; i >= 0; i--) {
                var diente =  dientes[i];
                var dienteUnwrapped = ko.utils.unwrapObservable(diente); 
                drawDiente(svg, parentGroup, dienteUnwrapped);
            };
        }

        //View Models
        function DienteModel(id, x, y,itemPemeriksaan){
            var self = this;
            var lbl = id;
            if(itemPemeriksaan!=""){
                lbl = itemPemeriksaan;
            }
            self.id = lbl;	
            self.x = x;
            self.y = y;		
        };

        function ViewModel(){
            var self = this;

            self.tratamientosPosibles = ko.observableArray([]);
            self.tratamientoSeleccionado = ko.observable(null);
            self.tratamientosAplicados = ko.observableArray([]);

            self.quitarTratamiento = function(tratamiento){
                self.tratamientosAplicados.remove(tratamiento);
                renderSvg();
            }
            var itemGigi = "{{$elemen_gigis}}";
            var itemPem = "{{$pemeriksaan_gigi}}";
            // console.log(itemPem);
            var itemElemenGigi = JSON.parse("[" + itemGigi + "]");
            // var itemPemeriksaan = JSON.parse("[" + itemPem + "]");
            var itemPemeriksaan = itemPem.split(",");

            //Cargo los dientes
            var dientes = [];
            //Dientes izquierdos
            for(var i = 0; i < 8; i++){
                var resultPemeriksaan = "";
                itemElemenGigi.find((value, index) => {
                    if (value == 18 - i) {
                        console.log("True ", itemPemeriksaan[index]);
                        resultPemeriksaan= itemPemeriksaan[index];
                    }
                    
                });

                dientes.push(new DienteModel(18 - i, i * 25, 0,resultPemeriksaan));	
            }
            // BARIS 2 COLUMN 1
            for(var i = 3; i < 8; i++){
                var resultPemeriksaan = "";
                itemElemenGigi.find((value, index) => {
                    if (value == 58 - i) {
                        resultPemeriksaan= itemPemeriksaan[index];
                    }
                    
                });

                dientes.push(new DienteModel(58 - i, i * 25, 1 * 40,resultPemeriksaan));	
            }
            for(var i = 3; i < 8; i++){
                var resultPemeriksaan = "";
                itemElemenGigi.find((value, index) => {
                    if (value == 88 - i) {
                        resultPemeriksaan= itemPemeriksaan[index];
                    }
                    
                });
                dientes.push(new DienteModel(88 - i, i * 25, 2 * 40,resultPemeriksaan));	
            }
            for(var i = 0; i < 8; i++){
                var resultPemeriksaan = "";
                itemElemenGigi.find((value, index) => {
                    if (value == 48 - i) {
                        resultPemeriksaan= itemPemeriksaan[index];
                    }
                    
                });
                dientes.push(new DienteModel(48 - i, i * 25, 3 * 40,resultPemeriksaan));	
            }
            //Dientes derechos
            for(var i = 0; i < 8; i++){
                var resultPemeriksaan = "";
                itemElemenGigi.find((value, index) => {
                    if (value == 21 + i) {
                        resultPemeriksaan= itemPemeriksaan[index];
                    }
                    
                });
                dientes.push(new DienteModel(21 + i, i * 25 + 210, 0,resultPemeriksaan));	
            }
            for(var i = 0; i < 5; i++){
                var resultPemeriksaan = "";
                itemElemenGigi.find((value, index) => {
                    if (value == 61 + i) {
                        resultPemeriksaan= itemPemeriksaan[index];
                    }
                    
                });
                dientes.push(new DienteModel(61 + i, i * 25 + 210, 1 * 40,resultPemeriksaan));	
            }
            for(var i = 0; i < 5; i++){
                var resultPemeriksaan = "";
                itemElemenGigi.find((value, index) => {
                    if (value == 71 + i) {
                        // console.log("True ", itemPemeriksaan[index]);
                        resultPemeriksaan= itemPemeriksaan[index];
                    }
                    
                });
                dientes.push(new DienteModel(71 + i, i * 25 + 210, 2 * 40,resultPemeriksaan));	
            }
            for(var i = 0; i < 8; i++){
                var resultPemeriksaan = "";
                itemElemenGigi.find((value, index) => {
                    if (value == 31 + i) {
                        // console.log("True ", itemPemeriksaan[index]);
                        resultPemeriksaan= itemPemeriksaan[index];
                    }
                    
                });

                dientes.push(new DienteModel(31 + i, i * 25 + 210, 3 * 40,resultPemeriksaan));	
            }

            self.dientes = ko.observableArray(dientes);
        };

        vm = new ViewModel();

        //Inicializo SVG
        $('#odontograma').svg({
            settings:{ width: '620px', height: '250px' }
        });

        ko.applyBindings(vm);

        //TODO: Cargo el estado del odontograma
        renderSvg();



        });
</script>

@endsection