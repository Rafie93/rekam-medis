@extends('layout.apps')
@section('content')
<div class="mr-auto">
    <h2 class="text-black font-w600">ICD</h2>
</div>

<!-- Add -->
<div class="modal fade" id="addOrderModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">ICD Baru</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{Route('icd.store')}}" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label class="text-black font-w500">Kode*</label>
                        <input type="text" name="code" required class="form-control" value="{{old('code')}}">
                        @error('code')
                        <div class="invalid-feedback animated fadeInUp"
                        style="display: block;">{{$message}}</div>
                        @enderror
                       
                    </div>
                    <div class="form-group">
                        <label class="text-black font-w500">Nama ICD (Indo)*</label>
                        <input type="text" name="name_id" required class="form-control" value="{{old('name_id')}}">
                        @error('name_id')
                        <div class="invalid-feedback animated fadeInUp"
                        style="display: block;">{{$message}}</div>
                        @enderror
                       
                    </div>
                    <div class="form-group">
                        <label class="text-black font-w500">Nama ICD (English)*</label>
                        <input type="text" name="name_en" required class="form-control" value="{{old('name_en')}}">
                        @error('name_en')
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
                    <a href="javascript:void(0)" class="btn btn-primary mr-3" data-toggle="modal" data-target="#addOrderModal">+Tambah ICD</a>

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
                                <th><strong>Kode</strong></th>
                                <th><strong>Nama (Ind)</strong></th>
                                <th><strong>Nama (Eng)</strong></th>
                                <th><strong>Aksi</strong></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($datas as $key=>$row)
                                <tr>
                                    <td>{{ $datas->firstItem() + $key }}</td>
                                    <td>{{$row->code}}</td>
                                    <td>{{$row->name_id}}</td>
                                    <td>{{$row->name_en}}</td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="javascript:void(0)" data-toggle="modal" data-target="#editPoli{{$row->code}}" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i></a>
                                            <a href="#" class="btn btn-danger shadow btn-xs sharp delete" r-name="{{$row->name_id}}" r-id="{{$row->code}}"><i class="fa fa-trash"></i></a>

                                            <div class="modal fade" id="editPoli{{$row->code}}">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Edit ICD</h5>
                                                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{Route('icd.update',$row->code)}}" method="POST">
                                                                {{ csrf_field() }}
                                                                <div class="form-group">
                                                                    <label class="text-black font-w500">Code*</label>
                                                                    <input type="text" name="code" value="{{$row->code}}" required class="form-control">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="text-black font-w500">Nama (Ind)*</label>
                                                                    <input type="text" name="name_id" value="{{$row->name_id}}" required class="form-control">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="text-black font-w500">Nama (Eng)*</label>
                                                                    <input type="text" name="name_en" value="{{$row->name_en}}" required class="form-control">
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
                      window.location = "/icd/"+id+"/delete";
                  }
                });
            });
        } );
    </script>
@endsection