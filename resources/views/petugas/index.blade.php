@extends('layout.apps')
@section('content')
<div class="mr-auto">
    <h2 class="text-black font-w600">Petugas</h2>
</div>
    

<!-- Add -->
<div class="modal fade" id="addOrderModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Petugas Baru</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{Route('petugas.store')}}" method="POST">
                    {{ csrf_field() }}
                   
                    <div class="form-group">
                        <label class="text-black font-w500">Nama*</label>
                        <input type="text" name="name" required class="form-control">
                        @error('name')
                        <div class="invalid-feedback animated fadeInUp"
                        style="display: block;">{{$message}}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label class="text-black font-w500">No HP (Login)*</label>
                        <input type="text" name="phone" required class="form-control">
                        @error('phone')
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
                        <label class="text-black font-w500">Role Akses*</label>
                        <select name="role" class="form-control">
                            <option value="1">Admin</option>
                            <option value="2">Pendaftaran</option>
                            <option value="4">Apotek</option>
                        </select>
                        @error('role')
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
                    <a href="javascript:void(0)" class="btn btn-primary mr-3" data-toggle="modal" data-target="#addOrderModal">+Tambah Petugas</a>

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
                                <th>Nama</th>
                                <th>No. HP</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($datas as $key=>$row)
                                <tr>
                                    <td>
                                        {{$key+1}}
                                    </td>
                                    <td>{{$row->name}}</td>
                                    <td>{{$row->phone}}</td>
                                    <td>{{$row->role_display()}}</td>
                                    <td>{{$row->status_display()}}</td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="javascript:void(0)" data-toggle="modal" data-target="#key{{$row->id}}" 
                                                class="btn btn-warning shadow btn-xs sharp mr-1"><i class="fa fa-key"></i></a>

                                            <a href="javascript:void(0)" data-toggle="modal" data-target="#edit{{$row->id}}" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i></a>
                                            <a href="#" class="btn btn-danger shadow btn-xs sharp delete" r-link="{{Route('petugas.delete',$row->id)}}"
                                            r-name="{{$row->nama}}" r-id="{{$row->id}}"><i class="fa fa-trash"></i></a>

                                            <div class="modal fade" id="key{{$row->id}}">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Ganti Password</h5>
                                                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{Route('gantipassword',$row->id)}}" method="POST">
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
                                                            <h5 class="modal-title">Edit Petugas</h5>
                                                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{Route('petugas.update',$row->id)}}" method="POST">
                                                                {{ csrf_field() }}
                                                               
                                                                <div class="form-group">
                                                                    <label class="text-black font-w500">Nama*</label>
                                                                    <input type="text" name="name" value="{{$row->name}}" required class="form-control">
                                                                    @error('name')
                                                                    <div class="invalid-feedback animated fadeInUp"
                                                                    style="display: block;">{{$message}}</div>
                                                                    @enderror
                                                                </div>
                                                                
                                                                <div class="form-group">
                                                                    <label class="text-black font-w500">No HP (Login)*</label>
                                                                    <input type="text" name="phone" required class="form-control" value="{{$row->phone}}">
                                                                    @error('phone')
                                                                    <div class="invalid-feedback animated fadeInUp"
                                                                    style="display: block;">{{$message}}</div>
                                                                    @enderror
                                                                </div>
                                                               
                                                                <div class="form-group">
                                                                    <label class="text-black font-w500">Role Akses*</label>
                                                                    <select name="role" class="form-control">
                                                                        <option value="1" {{$row->role==1 ? 'selected' : ''}}>Admin</option>
                                                                        <option value="2" {{$row->role==2 ? 'selected' : ''}}>Petugas Registrasi</option>
                                                                        <option value="4" {{$row->role==4 ? 'selected' : ''}}>Apotek</option>
                                                                    </select>
                                                                    @error('role')
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