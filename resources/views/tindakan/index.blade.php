@extends('layout.apps')
@section('content')
<div class="mr-auto">
    <h2 class="text-black font-w600">Tindakan</h2>
</div>


<!-- Add -->
<div class="modal fade" id="addOrderModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tindakan Baru</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{Route('tindakan.store')}}" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label class="text-black font-w500">Kode*</label>
                        <input type="text" name="kode" class="form-control">
                        @error('kode')
                        <div class="invalid-feedback animated fadeInUp"
                        style="display: block;">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="text-black font-w500">Nama Tindakan*</label>
                        <input type="text" name="nama" required class="form-control">
                        @error('nama')
                        <div class="invalid-feedback animated fadeInUp"
                        style="display: block;">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="text-black font-w500">Harga*</label>
                        <input type="number" name="harga" value="0" class="form-control">
                        @error('harga')
                        <div class="invalid-feedback animated fadeInUp"
                        style="display: block;">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="text-black font-w500">Poli*</label>
                        <select name="poli" class="form-control">
                            @foreach ($poli as $item)
                                <option value="{{$item->nama}}" {{$item->nama=='Poli Gigi' ? 'selected' : ''}}>{{$item->nama}}</option>
                            @endforeach
                        </select>
                        @error('poli')
                        <div class="invalid-feedback animated fadeInUp"
                        style="display: block;">{{$message}}</div>
                        @enderror
                    </div>
                    
                    
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">SIMPAN</button>
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
                    <a href="javascript:void(0)" class="btn btn-primary mr-3" data-toggle="modal" data-target="#addOrderModal">+Tambah Tindakan</a>

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
                                
                                <th>No</th>
                                <th>KODE</th>
                                <th>Nama Tindakan</th>
                                <th>Harga</th>
                                <th>Poli</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($datas as $key=>$row)
                                <tr>
                                    <td>
                                        {{$key+1}}
                                    </td>
                                    <td>{{$row->kode}}</td>
                                    <td>{{$row->nama}}</td>
                                    <td>{{number_format($row->harga)}}</td>
                                    <td>{{$row->poli}}</td>
                                    <td>
                                        <div class="d-flex">
                                          

                                            <a href="javascript:void(0)" data-toggle="modal" data-target="#edit{{$row->id}}" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i></a>
                                            <a href="#" class="btn btn-danger shadow btn-xs sharp delete" r-link="{{Route('tindakan.delete',$row->id)}}"
                                             r-name="{{$row->nama}}" r-id="{{$row->id}}"><i class="fa fa-trash"></i></a>

                                            <div class="modal fade" id="edit{{$row->id}}">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Edit Tindakan</h5>
                                                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{Route('tindakan.update',$row->id)}}" method="POST">
                                                                {{ csrf_field() }}
                                                                <div class="form-group">
                                                                    <label class="text-black font-w500">Kode</label>
                                                                    <input type="text" name="kode" value="{{$row->nama}}" class="form-control">
                                                                    @error('kode')
                                                                    <div class="invalid-feedback animated fadeInUp"
                                                                    style="display: block;">{{$message}}</div>
                                                                    @enderror
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="text-black font-w500">Nama Tindakan</label>
                                                                    <input type="text" name="nama" value="{{$row->nama}}" required class="form-control">
                                                                    @error('nama')
                                                                    <div class="invalid-feedback animated fadeInUp"
                                                                    style="display: block;">{{$message}}</div>
                                                                    @enderror
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="text-black font-w500">Harga</label>
                                                                    <input type="number" name="harga" value="{{$row->harga}}" required class="form-control">
                                                                    @error('harga')
                                                                    <div class="invalid-feedback animated fadeInUp"
                                                                    style="display: block;">{{$message}}</div>
                                                                    @enderror
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="text-black font-w500">Poli*</label>
                                                                    <select name="poli" class="form-control">
                                                                        @foreach ($poli as $item)
                                                                            @if ($item->nama == $row->poli)
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
        } );
    </script>
@endsection