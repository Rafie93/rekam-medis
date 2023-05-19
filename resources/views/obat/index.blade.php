@extends('layout.apps')
@section('content')
<div class="mr-auto">
    <h2 class="text-black font-w600">Data Obat</h2>
</div>


<!-- Add -->
<div class="modal fade" id="addOrderModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Obat Baru</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{Route('obat.store')}}" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label class="text-black font-w500">Kode Obat*</label>
                        <input type="text" name="kd_obat" required class="form-control" value="{{old('kd_obat')}}">
                        @error('kd_obat')
                        <div class="invalid-feedback animated fadeInUp"
                        style="display: block;">{{$message}}</div>
                        @enderror
                       
                    </div>
                    <div class="form-group">
                        <label class="text-black font-w500">Nama Obat*</label>
                        <input type="text" name="nama" required class="form-control" value="{{old('nama')}}">
                        @error('nama')
                        <div class="invalid-feedback animated fadeInUp"
                        style="display: block;">{{$message}}</div>
                        @enderror
                       
                    </div>
                   <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="text-black font-w500">Satuan*</label>
                            <input type="text" name="satuan" required class="form-control" value="{{old('satuan')}}">
                            @error('satuan')
                            <div class="invalid-feedback animated fadeInUp"
                            style="display: block;">{{$message}}</div>
                            @enderror
                           
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="text-black font-w500">Stok*</label>
                            <input type="number" name="stok" required class="form-control" value="{{old('stok')}}">
                            @error('stok')
                            <div class="invalid-feedback animated fadeInUp"
                            style="display: block;">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                   </div>

                   <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="text-black font-w500">Harga*</label>
                                <input type="number" name="harga" required class="form-control" value="{{old('harga')?old('harga') :'0'}}">
                                @error('harga')
                                <div class="invalid-feedback animated fadeInUp"
                                style="display: block;">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="text-black font-w500">Untuk BPJS*</label>
                                <select name="is_bpjs" class="form-control">
                                    <option value="1">Ya</option>
                                    <option value="0">Tidak</option>
                                </select>
                                @error('is_bpjs')
                                <div class="invalid-feedback animated fadeInUp"
                                style="display: block;">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                   </div>
                    
                   
                    
                    
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">BUAT</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <div class="form-group col-lg-6" style="float: left">
                    <a href="javascript:void(0)" class="btn btn-primary mr-3" data-toggle="modal" data-target="#addOrderModal">+Tambah Obat</a>

                </div>
                <div class="form-group col-lg-6" style="float: right">
                    <form method="get" action="{{ url()->current() }}">
                        <div class="input-group">
                            <input type="text" class="form-control gp-search" name="keyword" value="{{request('keyword')}}" placeholder="Cari" value="" autocomplete="off">
                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-default no-border btn-sm gp-search">
                                <i class="ace-icon fa fa-search icon-on-right bigger-110"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                </div>

                <div class="table-responsive">
                    <table  class="table table-responsive-md">
                        <thead>
                            <tr>
                                
                                <th><strong>No</strong></th>
                                <th><strong>Kd Obat</strong></th>
                                <th><strong>Nama Obat</strong></th>
                                <th><strong>Satuan</strong></th>
                                <th><strong>Stok</strong></th>
                                <th><strong>Harga</strong></th>
                                <th><strong>Untuk BPJS</strong></th>
                                <th><strong>Aksi</strong></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($datas as $key=>$row)
                                <tr>
                                    <td align="center">{{ $datas->firstItem() + $key }}</td>
                                    <td>{{$row->kd_obat}}</td>
                                    <td>{{$row->nama}}</td>
                                    <td>{{$row->satuan}}</td>
                                    <td align="center">{{$row->stok}}</td>
                                    <td align="right">{{number_format($row->harga)}}</td>
                                    <td align="center">{{$row->is_bpjs==1 ? 'Ya' : 'Tidak'}}</td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="javascript:void(0)" data-toggle="modal" data-target="#editPoli{{$row->id}}" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i></a>
                                            <a href="#" class="btn btn-danger shadow btn-xs sharp delete" r-name="{{$row->nama}}" r-id="{{$row->id}}"><i class="fa fa-trash"></i></a>

                                            <div class="modal fade" id="editPoli{{$row->id}}">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Edit Obat</h5>
                                                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{Route('obat.update',$row->id)}}" method="POST">
                                                                {{ csrf_field() }}
                                                                <div class="form-group">
                                                                    <label class="text-black font-w500">Kode Obat*</label>
                                                                    <input type="text" name="kd_obat" required class="form-control" readonly value="{{old('kd_obat') ? old('kd_obat') : $row->kd_obat}}">
                                                                    @error('kd_obat')
                                                                    <div class="invalid-feedback animated fadeInUp"
                                                                    style="display: block;">{{$message}}</div>
                                                                    @enderror
                                                                   
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="text-black font-w500">Nama Obat*</label>
                                                                    <input type="text" name="nama" required class="form-control" value="{{old('nama') ? old('nama') : $row->nama}}">
                                                                    @error('nama')
                                                                    <div class="invalid-feedback animated fadeInUp"
                                                                    style="display: block;">{{$message}}</div>
                                                                    @enderror
                                                                   
                                                                </div>
                                                               <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="text-black font-w500">Satuan*</label>
                                                                        <input type="text" name="satuan" required class="form-control" value="{{old('satuan') ? old('satuan') : $row->satuan}}">
                                                                        @error('satuan')
                                                                        <div class="invalid-feedback animated fadeInUp"
                                                                        style="display: block;">{{$message}}</div>
                                                                        @enderror
                                                                       
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="text-black font-w500">Stok*</label>
                                                                        <input type="number" name="stok" required class="form-control" value="{{old('stok') ? old('stok') : $row->stok}}">
                                                                        @error('stok')
                                                                        <div class="invalid-feedback animated fadeInUp"
                                                                        style="display: block;">{{$message}}</div>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                               </div>
                                            
                                                               <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label class="text-black font-w500">Harga*</label>
                                                                            <input type="number" name="harga" required class="form-control" value="{{old('harga')?old('harga') :$row->harga}}">
                                                                            @error('harga')
                                                                            <div class="invalid-feedback animated fadeInUp"
                                                                            style="display: block;">{{$message}}</div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label class="text-black font-w500">Untuk BPJS*</label>
                                                                            <select name="is_bpjs" class="form-control">
                                                                                <option value="1" selected>Ya</option>
                                                                                <option value="0">Tidak</option>
                                                                            </select>
                                                                            @error('is_bpjs')
                                                                            <div class="invalid-feedback animated fadeInUp"
                                                                            style="display: block;">{{$message}}</div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                               </div>
                                                                
                                                                <div class="form-group">
                                                                    <button type="submit" class="btn btn-primary">UPDATE</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        
                    </table>
                    <div class="dataTables_info" id="example_info" role="status"
                     aria-live="polite">Showing {{$datas->firstItem()}} to {{$datas->perPage() * $datas->currentPage()}} of {{$datas->total()}} entries</div>

                    {{ $datas->appends(request()->except('page'))->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
        $().ready( function () {
            $(".delete").click(function() {
                 var id = $(this).attr('r-id');
                 var name = $(this).attr('r-name');
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
                      window.location = "/poliklinik/"+id+"/delete";
                  }
                });
            });
        } );
    </script>
@endsection