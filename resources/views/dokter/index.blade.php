@extends('layout.apps')
@section('content')
<div class="mr-auto">
    <h2 class="text-black font-w600">Dokter</h2>
</div>


<!-- Add -->
<div class="modal fade" id="addOrderModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Dokter Baru</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{Route('dokter.store')}}" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label class="text-black font-w500">NIP</label>
                        <input type="text" name="nip" class="form-control">
                        @error('nip')
                        <div class="invalid-feedback animated fadeInUp"
                        style="display: block;">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="text-black font-w500">Nama Dokter*</label>
                        <input type="text" name="nama" required class="form-control">
                        @error('nama')
                        <div class="invalid-feedback animated fadeInUp"
                        style="display: block;">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="text-black font-w500">Poli*</label>
                        <select name="poli" class="form-control">
                            @foreach ($poli as $item)
                                <option value="{{$item->nama}}">{{$item->nama}}</option>
                            @endforeach
                        </select>
                        @error('poli')
                        <div class="invalid-feedback animated fadeInUp"
                        style="display: block;">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="text-black font-w500">No HP (Login)*</label>
                        <input type="text" name="no_hp" required class="form-control">
                        @error('no_hp')
                        <div class="invalid-feedback animated fadeInUp"
                        style="display: block;">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="text-black font-w500">Password Login*</label>
                        <input type="password" name="password" required class="form-control">
                        @error('password')
                        <div class="invalid-feedback animated fadeInUp"
                        style="display: block;">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="text-black font-w500">Alamat</label>
                        <textarea name="alamat" class="form-control" id="alamat" cols="30" rows="3"></textarea>
                        @error('alamat')
                        <div class="invalid-feedback animated fadeInUp"
                        style="display: block;">{{$message}}</div>
                        @enderror
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
                    <a href="javascript:void(0)" class="btn btn-primary mr-3" data-toggle="modal" data-target="#addOrderModal">+Tambah Dokter</a>

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
                                <th><strong>NIP</strong></th>
                                <th><strong>Nama Dokter</strong></th>
                                <th><strong>No. HP</strong></th>
                                <th><strong>Alamat</strong></th>
                                <th><strong>Poli</strong></th>
                                <th><strong>Status</strong></th>
                                <th><strong>Aksi</strong></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($datas as $key=>$row)
                                <tr>
                                    <td>
                                        {{$key+1}}
                                    </td>
                                    <td>{{$row->nip}}</td>
                                    <td>{{$row->nama}}</td>
                                    <td>{{$row->no_hp}}</td>
                                    <td>{{$row->alamat}}</td>
                                    <td>{{$row->poli}}</td>
                                    <td>{{$row->status_display()}}</td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="javascript:void(0)" data-toggle="modal" data-target="#key{{$row->user_id}}" 
                                                class="btn btn-warning shadow btn-xs sharp mr-1"><i class="fa fa-key"></i></a>

                                            <a href="javascript:void(0)" data-toggle="modal" data-target="#edit{{$row->id}}" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i></a>
                                            <a href="#" class="btn btn-danger shadow btn-xs sharp delete" r-name="{{$row->nama}}" r-id="{{$row->id}}"><i class="fa fa-trash"></i></a>

                                            <div class="modal fade" id="key{{$row->user_id}}">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Ganti Password Login Dokter</h5>
                                                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{Route('dokter.gantipassword',$row->user_id)}}" method="POST">
                                                                {{ csrf_field() }}
                                                               
                                                                <div class="form-group">
                                                                    <label class="text-black font-w500">Password Baru*</label>
                                                                    <input type="password" name="password"
                                                                    required class="form-control">
                                                                    @error('password')
                                                                    <div class="invalid-feedback animated fadeInUp"
                                                                    style="display: block;">{{$message}}</div>
                                                                    @enderror
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="text-black font-w500">Password Konfirmasi*</label>
                                                                    <input type="password" name="password_konfirm"
                                                                    required class="form-control">
                                                                    @error('password_konfirm')
                                                                    <div class="invalid-feedback animated fadeInUp"
                                                                    style="display: block;">{{$message}}</div>
                                                                    @enderror
                                                                </div>
                                                                
                                                                <div class="form-group">
                                                                    <button type="submit" class="btn btn-primary">GANTI PASSWORD</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modal fade" id="edit{{$row->id}}">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Edit Dokter</h5>
                                                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{Route('dokter.update',$row->id)}}" method="POST">
                                                                {{ csrf_field() }}
                                                                <div class="form-group">
                                                                    <label class="text-black font-w500">NIP</label>
                                                                    <input type="text" name="nip" class="form-control">
                                                                    @error('nip')
                                                                    <div class="invalid-feedback animated fadeInUp"
                                                                    style="display: block;">{{$message}}</div>
                                                                    @enderror
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="text-black font-w500">Nama Dokter*</label>
                                                                    <input type="text" name="nama" value="{{$row->nama}}" required class="form-control">
                                                                    @error('nama')
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
                                                                    <label class="text-black font-w500">No HP (Login)*</label>
                                                                    <input type="text" name="no_hp" required class="form-control" value="{{$row->no_hp}}">
                                                                    @error('no_hp')
                                                                    <div class="invalid-feedback animated fadeInUp"
                                                                    style="display: block;">{{$message}}</div>
                                                                    @enderror
                                                                </div>
                                                               
                                                                <div class="form-group">
                                                                    <label class="text-black font-w500">Alamat</label>
                                                                    <textarea name="alamat" class="form-control" id="alamat" cols="30" rows="3">{{$row->alamat}}</textarea>
                                                                    @error('alamat')
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
                      window.location = "{{Route('dokter.delete',"+id+")}}" ;
                  }
                });
            });
        } );
    </script>
@endsection