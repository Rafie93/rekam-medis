@extends('layout.apps')
@section('content')
<div class="mr-auto">
    <h2 class="text-black font-w600">Resep dan Pemberian Obat</h2>
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
                                <th>Tgl Periksa</th>
                                <th>Nama Pasien</th>
                                <th>Diagnosa</th>
                                <th>Tindakan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($datas as $key=>$row)
                                <tr>
                                    <td>{{  $key+1 }}</td>
                                    <td>{{$row->tgl_rekam}}</td>
                                    <td>{{$row->pasien->nama}}</td>
                                    <td>
                                        @if ($row->poli=="Poli Gigi")
                                            @foreach ($row->gigi() as $item)
                                                <li>{{$item->diagnosa.", ".$item->diagnosis->name_id}}</li>
                                            @endforeach
                                        @else 
                                            {{-- {{$row->diagnosa}}
                                            @if ($row->diagnosa!=null)
                                                <br/>{{$row->diagnosis->name_id}}
                                            @endif --}}
                                            @foreach ($row->diagnosa() as $item)
                                                {{$item->diagnosis->code}}<br/>{{$item->diagnosis->name_id}}
                                            <br/><br/>
                                            @endforeach
                                        @endif
                                    </td>
                                    <td>
                                        @if ($row->poli=="Poli Gigi")
                                            @if ($row->resep_obat!=null)
                                                <strong>Resep Obat :</strong> {{$row->resep_obat}}
                                                <br><br>
                                            @endif
                                            @foreach ($row->gigi() as $item)
                                                <li>{{$item->tindak->nama}}</li>
                                            @endforeach
                                        @else 
                                            {!! $row->tindakan !!}</td>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{Route('obat.pengeluaran',$row->id)}}" class="btn btn-primary shadow btn-xs">
                                                <i class="fa fa-pencil"></i> Proses</a>
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
