
@extends('layouts.app')
@section('title')
<h1>{{@$title}}</h1>
@endsection

@section('content')

<style type="text/css">
    thead tr:first-child th {
    position: sticky;
    z-index: 12;
    top: 0;
}
</style>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Penggunaan Genset</h3>
              <div class="card-tools">
                {{-- <a href="{{ route('penggunaan_genset.create') }}" class="btn btn-primary">+ TAMBAH</a> --}}

                <input type="hidden" name="" class="data-src" value="{{ url('penggunaan_genset/print-filter?') }}">
                {{-- <button class="btn btn-danger create-btn btn-print" data-iframe="true" data-title="Cetak Catatan Pemeliharaan" data-src="{{ url('penggunaan_genset/print-filter?pdf=true&') }}" data-lg="true" data-actions="false" data-save="false"><i class="fas fa-print" ></i> EXPORT PDF</button> --}}
                <button type="button" class="btn btn-danger btn-print-pdf"><i class="fas fa-print"></i> EXPORT PDF</button>

                {{-- <button type="button" class="btn btn-success print-excel" data-title="Cetak Catatan Pemeliharaan" ><i class="fas fa-file-excel" ></i> EXPORT EXCEL</button> --}}
                <a class="btn btn-primary" href="{{ url('penggunaan_genset/create') }}" data-title="Tambah">+ Input Data</a>  
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
            	{{-- <form style="margin-bottom: 6px;" class="form-filter" onsubmit="return false">
                  <div class="form-row">
                    <div class="col-lg-2">
                        <label>Cari Tanggal Perbaikan</label>
                      <input type="date" class="form-control" name="tanggal">
                    </div>
                    <div class="col-lg-2">
                        <br>
                        <button class="btn btn-primary btn-filter float-left" style="margin-top: 7px;margin-right: 2px;"><i class="fas fa-search"></i></button>
                        <button type="reset" class="btn btn-primary btn-warning float-left btn-reset" style="margin-top: 7px;"><i class="fas fa-times"></i></button>
                    </div>
                  </div>
                </form> --}}

                <div class="row col-md-12">
                    <form style="margin-bottom: 6px;" class="form-filter" id="form-filter" onsubmit="return false">
                        <div class="row">
                            <div class="form-group px-1">
                                <label >Dari Tanggal</label>
                                <input type="date" class="form-control tanggal" id="dari_tanggal" name="dari_tanggal" value="{{ date('Y-m-d') }}">
                            </div>

                            <div class="form-group px-1">
                                <label >Sampai Tanggal</label>
                                <input type="date" class="form-control tanggal" id="sampai_tanggal" name="sampai_tanggal" value="{{ date('Y-m-d') }}">
                            </div>
                        </div>
                    </form>
                </div>

            	<div class="table table-responsive">
            			<table class="table table-bordered" id="table">
            		    <thead>
                      <th>START</th>
                      <th>SELESAI</th>
                      <th>VOL</th>
                      <th>FREK</th>
                      <th>SUHU</th>
                      <th>AMP</th>
                      <th>PETUGAS</th>
                      <th>JUMLAH <br>BBM TERAKHIR</th>
                      <th>KETERANGAN</th>
                      <th>Opsi</th>
            		    </thead>
            	  </table>
            	</div>
            </div>
        </div>
    </div>
</div>
</div>
</section>

<style type="text/css">
    .modal-dialog{
        max-width: 85% !important;
        width: 85% !important;
    }
    span.select2-container{z-index: 0}
</style>
@endsection

@push('scripts')
<script>
  load();
  function load() {
  $('#table').DataTable({
        processing: true,
        serverSide: true,
        destroy:true,

        ajax: {
            url:'{!! route("penggunaan_genset.json") !!}',
            data: function ( d ) {
            $.each($('.form-filter').serializeArray(), function(i, obj){
              d[obj['name']] = obj['value'];
          });

        },
        },
        columns: [
        // {data: 'DT_RowIndex', searchable: false, orderable: false},
        {data:'start',name:'start'},
        {data:'selesai',name:'selesai'},
        {data:'vol',name:'vol'},
        {data:'frek',name:'frek'},
        {data:'suhu',name:'suhu'},
        {data:'amp',name:'amp'},
        {data:'petugas',name:'petugas'},
        {data:'bbm_terakhir',name:'bbm_terakhir'},
        {data:'keterangan',name:'keterangan'},
        {data:'action',name:'action'}
     
        ]
    });
}

$(document).on('change', '.tanggal', function() {
    load();
});

$(document).on('click', '.btn-print-pdf', function(){
        var dari_tanggal = $('#dari_tanggal').val();
        var sampai_tanggal = $('#sampai_tanggal').val();
        var url = '?pdf=true&dari_tanggal='+dari_tanggal+'&sampai_tanggal='+sampai_tanggal;
        var url_lengkap = '{{ url('penggunaan_genset/print-filter') }}'+url;
        // alert(url);
        window.open(url_lengkap);
    });
</script>
@endpush




