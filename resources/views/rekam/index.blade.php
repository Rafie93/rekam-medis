@extends('layout.apps')
@section('content')
<div class="container-fluid">
<div class="form-head align-items-center d-flex mb-sm-4 mb-3">
    <div class="mr-auto">
        <h2 class="text-black font-w600">Rekam Medis</h2>
    </div>
    <div>
        <a href="{{Route('rekam.add')}}" class="btn btn-primary mr-3">+Rekam Medis Baru</a>
    </div>
</div>

<!-- Add -->
{{-- <div class="modal fade bd-example-modal-lg" id="addOrderModal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Rekam Medis Baru</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{Route('rekam.store')}}" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label class="text-black font-w500">Tanggal Periksa</label>
                        <input type="date" name="tgl_rekam" class="form-control" value="{{date('Y-m-d')}}">
                        @error('tgl_rekam')
                        <div class="invalid-feedback animated fadeInUp"
                        style="display: block;">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-7">
                            <div class="form-group">
                                <label class="text-black font-w500">Nama Pasien*</label>
                                <select name="pasien_id"  id="single-select" required style="height: 200px">
                                    <option value="">--Cari Pasien--</option>
                                    @foreach ($pasien as $item)
                                        
                                        @php
                                            $namaDisplay = "RM#".$item->no_rm." | ".$item->nama;
                                            if ($item->cara_bayar == "BPJS") {
                                                $namaDisplay.= " | ".$item->no_bpjs;
                                            }
                                            $namaDisplay.= " | ".$item->no_hp;
                                        @endphp
                                        <option value="{{$item->id}}">{{$namaDisplay}} </option>
                                    @endforeach
                                </select>
                                @error('pasien_id')
                                <div class="invalid-feedback animated fadeInUp"
                                style="display: block;">{{$message}}</div>
                                @enderror
                                
                            </div>
                        </div>
                        <div class="col-md-5">
                            <label class="text-black font-w500">Cara Bayar*</label>
                            <select name="cara_bayar" required class="form-control">
                                <option value=""></option>
                                <option value="Umum/Mandiri">Umum/Mandiri</option>
                                <option value="Jaminan Kesehatan">Jaminan Kesehatan</option>
                            </select>
                            
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="alert alert-warning left-icon-big alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                            </button>
                            <div class="media">
                                <div class="alert-left-icon-big">
                                    <span><i class="mdi mdi-help-circle-outline"></i></span>
                                </div>
                                <div class="media-body">
                                    <p class="mb-0"><i>Jika tidak ada nama pasien / bpjs, silahkan lakukan tambah data dulu.</i>
                                        <br><a href="{{Route('pasien.add')}}">klik disini !!</a>
                                        </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    

                    <div class="form-group">
                        <label class="text-black font-w500">Keluhan*</label>
                        <textarea name="keluhan" required class="form-control"
                         rows="4">{{old('keluhan')}}</textarea>
                        @error('keluhan')
                        <div class="invalid-feedback animated fadeInUp"
                        style="display: block;">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="text-black font-w500">Poli Tujuan*</label>
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
                            
                        </div>
                        <div class="col-md-6">

                        </div>
                    </div>
                    
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">DAFTAR</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> --}}

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <ul class="nav nav-tabs" >
                    @if (auth()->user()->role_display()=="Admin" || auth()->user()->role_display()=="Pendaftaran")
                        <li class="nav-item">
                            <a href="{{Route('rekam',['tab'=>1])}}" class="nav-link {{Request('tab')==1 ? 'active' :''}}" >
                                <i class="la la-home mr-2"></i> Baru Periksa</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{Route('rekam',['tab'=>2])}}" class="nav-link {{Request('tab')==2 ? 'active' :''}}" >
                                <i class="la la-user mr-2"></i> Pemeriksaan Dokter</a>
                        </li>
                        <li  class="nav-item">
                            <a href="{{Route('rekam',['tab'=>3])}}" class="nav-link {{Request('tab')==3 ? 'active' :''}}" >
                                <i class="la la-phone mr-2"></i> Menunggu Obat</a>
                        </li>
                    
                        <li class="nav-item ">
                            <a href="{{Route('rekam',['tab'=>5])}}" class="nav-link {{Request('tab')==5 ? 'active' :''}}">
                                <i class="la la-envelope mr-2"></i> Selesai</a>
                        </li>
                    
                    @elseif(auth()->user()->role_display()=="Dokter")
                        <li class="nav-item">
                            <a href="{{Route('rekam',['tab'=>2])}}" class="nav-link {{Request('tab')==2 ? 'active' :''}}" >
                                <i class="la la-user mr-2"></i> Perlu Diperiksa</a>
                        </li>
                        <li class="nav-item ">
                            <a href="{{Route('rekam',['tab'=>5])}}" class="nav-link {{Request('tab')==5 ? 'active' :''}}">
                                <i class="la la-envelope mr-2"></i> Selesai Diperiksa</a>
                        </li>
                    @endif
                    
                </ul>

                <div class="table-responsive">
                    <table  class="table table-responsive-md">
                        <thead>
                            <tr>
                                
                                <th><strong>No</strong></th>
                                <th><strong>Tgl Periksa</strong></th>
                                <th><strong>Nama Pasien</strong></th>
                                <th><strong>Poli &<br>Dokter</strong></th>
                                <th><strong>Keluhan </strong></th>
                                <th><strong>Cara Bayar</strong></th>
                                <th><strong>Status</strong></th>
                                <th><strong>Aksi</strong></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rekams as $key=>$row)
                                <tr>
                                    <td align="center">{{ $rekams->firstItem() + $key }}</td>
                                <td>{{$row->tgl_rekam}}</td>
                                <td><a href="{{Route('rekam.detail',$row->pasien_id)}}">{{$row->pasien->nama}}</a></td>
                                <td>{{$row->poli}}
                                    <br><strong>{{$row->dokter->nama}}</strong>
                                </td>
                                <td>{{$row->keluhan}}</td>
                                <td>{{$row->cara_bayar}}</td>
                                <td>{!!$row->status_display()!!}</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{Route('rekam.detail',$row->pasien_id)}}" class="btn btn-info shadow btn-xs sharp mr-1"><i class="fa fa-eye"></i></a>

                                        {{-- <a href="javascript:void(0)" data-toggle="modal" data-target="#editPoli{{$row->id}}" class="btn btn-primary shadow btn-xs sharp mr-1">
                                            <i class="fa fa-pencil"></i></a> --}}
                                        <a href="#" class="btn btn-danger shadow btn-xs sharp delete" r-link="{{Route('rekam.delete',$row->id)}}"
                                         r-name="{{$row->pasien_nama}}" r-id="{{$row->id}}"><i class="fa fa-trash"></i></a>
                                    </div>
                                </td>
                                </tr>
                            @endforeach
                        </tbody>
                        
                    </table>
                    {{ $rekams->appends(request()->except('page'))->links() }}

                </div>

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
