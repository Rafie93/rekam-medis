<!-- Add -->
<div class="modal fade" id="addDiagnosa">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cari Diagnosa </h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{Route('diagnosa.update')}}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" id="rekamId" name="rekam_id" value="0">
                    <input type="hidden" id="pasienId" name="pasien_id" value="{{$pasien->id}}">
                    <div class="form-group">
                        {{-- <textarea name="diagnosa"  required
                        id="editor" 
                        class="form-control" 
                        rows="10"></textarea> --}}
                        <div class="row">
                            <table class="display white-border table-responsive-sm"
                                style="width: 100%"
                             id="icd-table">
                                <thead>
                                    <tr>
                                        <th style="width: 5%">#</th>
                                        <th style="width: 15%">Kode</th>
                                        <th style="width: 80%">Nama</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        @error('diagnosa')
                        <div class="invalid-feedback animated fadeInUp"
                        style="display: block;">{{$message}}</div>
                        @enderror
                       
                    </div>
                    
                   
                </form>
            </div>
        </div>
    </div>
</div>
