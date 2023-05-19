@extends('layout.apps')
@section('content')
{{-- <div class="form-head align-items-center d-flex mb-sm-4 mb-3">
    <div class="mr-auto">
        <h2 class="text-black font-w600">Data Pasien</h2>
    </div>
    <div>
        <a href="{{Route('pasien.add')}}" class="btn btn-primary mr-3">+Pasien Baru</a>
        <a href="#" class="btn btn-outline-primary"><i class="las la-calendar-plus scale5 mr-3"></i>Filter Date</a>

    </div>
</div> --}}
<div class="mr-auto">
    <h2 class="text-black font-w600">Data Pasien</h2>
</div>

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <div class="form-group col-lg-6" style="float: left">
                    <a href="{{Route('pasien.add')}}" class="btn btn-primary mr-3">+Pasien Baru</a>
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

                <div class="table-responsive card-table"> 
                    <table class="table table-responsive-md">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>No. RM</th>
                                <th>Nama Pasien</th>
                                <th>TTL</th>
                                <th>Alamat</th>
                                <th>JK</th>
                                <th>No. HP</th>
                                <th>Pengobatan</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            @foreach ($datas as $key=>$row)
                                <tr>
                                    <td>                                           
                                        <a href="{{Route('rekam.detail',$row->id)}}" class="btn btn-primary shadow btn-xs sharp mr-1">
                                           <i class="fa fa-eye"></i></a>
                                        <a href="{{Route('pasien.edit',$row->id)}}" class="btn btn-info shadow btn-xs sharp mr-1">
                                            <i class="fa fa-pencil"></i></a>
                                        <a href="#" class="btn btn-danger shadow btn-xs sharp delete" r-link="{{Route('pasien.delete',$row->id)}}"
                                         r-name="{{$row->nama}}" r-id="{{$row->id}}"><i class="fa fa-trash"></i></a>

                                   </td>
                                   
                                   <td><a href="{{Route('rekam.detail',$row->id)}}">RM#{{$row->no_rm}}</a></td>
                                   <td>{{$row->nama}}</td>
                                   <td>{{$row->tmp_lahir}},{{$row->tgl_lahir}}</td>
                                   <td>{{$row->alamat_lengkap}}</td>
                                   <td>{{$row->jk}}</td>
                                   <td>{{$row->no_hp}}</td>
                                   <td>{{$row->cara_bayar}}
                                       @if ($row->cara_bayar=="Jaminan Kesehatan")
                                           <br>{{$row->no_bpjs}}
                                       @endif
                                   </td>
                                   <td>
                                       <span class="badge badge-outline-primary">
                                           <i class="fa fa-circle text-primary mr-1"></i>
                                           New Patient
                                       </span>
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