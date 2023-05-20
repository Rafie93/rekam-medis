@extends('layout.apps')
@section('content')
<div class="mr-auto">
    <h2 class="text-black font-w600">Riwayat Obat Keluar</h2>
</div>

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
               
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
                                <th>Tgl Keluar</th>
                                <th>Kd Obat</th>
                                <th>Nama Obat</th>
                                <th>Jumlah</th>
                                <th>Satuan</th>
                                <th>Harga</th>
                                <th>Sub Total</th>
                                <th>Cara Bayar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($datas as $key=>$row)
                                <tr>
                                    <td align="center">{{ $datas->firstItem() + $key }}</td>
                                    <td>{{$row->created_at}}</td>
                                    <td>{{$row->obat->kd_obat}}</td>
                                    <td>{{$row->obat->nama}}</td>
                                    <td align="center">{{$row->jumlah}}</td>
                                    <td>{{$row->obat->satuan}}</td>
                                    <td align="right">{{number_format($row->harga)}}</td>
                                    <td align="right">{{number_format($row->subtotal)}}</td>
                                    <td>{{$row->rekam->cara_bayar}}
                                        <br/>
                                        <strong>
                                            <a href="{{Route('obat.pengeluaran',$row->rekam_id)}}">{{$row->rekam->pasien->nama}}</a>

                                        </strong>
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
