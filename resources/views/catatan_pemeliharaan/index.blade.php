
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
              <h3 class="card-title">Catatan Perbaikan</h3>
              <div class="card-tools">
                <a href="{{ route('catatan-pemeliharaan.create') }}" class="btn btn-primary">+ TAMBAH</a>

                <input type="hidden" name="" class="data-src" value="{{ url('catatan-pemeliharaan/print-filter?') }}">
                {{-- <button class="btn btn-danger create-btn btn-print" data-iframe="true" data-title="Cetak Catatan Pemeliharaan" data-src="{{ url('catatan-pemeliharaan/print-filter?pdf=true&') }}" data-lg="true" data-actions="false" data-save="false"><i class="fas fa-print" ></i> EXPORT PDF</button> --}}
                <button type="button" class="btn btn-danger btn-print-pdf"><i class="fas fa-print"></i> EXPORT PDF</a>

                <button type="button" class="btn btn-success print-excel" data-title="Cetak Catatan Pemeliharaan" ><i class="fas fa-file-excel" ></i> EXPORT EXCEL</button>
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
            			<th>Tanggal</th>
            			<th>Perbaikan</th>
            			<th>Jam Mulai</th>
            			<th>Jam Selesai</th>
            			<th>Lokasi</th>
            			<th>Status</th>
                        <th>Keterangan</th>
                        <th>Biaya</th>
            			<th>Foto</th>
                        <th>Teknisi</th>
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


// $(document).ready(function() {
//     $('#table').DataTable({
//         processing: true,
//         serverSide: true,
//         fixedHeader: {
//             header: true
//         },
//         scrollY: 400,
//         destroy:true,
//          language: {
//             'search' : 'Cari:'
//         },
//         ajax: {
//             url:'{!! route("catatan-pemeliharaan.json") !!}',
//             data: function ( d ) {
//  $.each($('.form-filter').serializeArray(), function(i, obj){
//       d[obj['name']] = obj['value'];
//    });

//   },
//         },
//         columns: [

//     {data:'tanggal',name: 'pekerjaan.tanggal' },
//     {data:'perbaikan',name: 'pekerjaan.perbaikan' },
//     {data:'jam_mulai',name: 'pekerjaan.jam_mulai' },
//     {data:'jam_selesai',name: 'pekerjaan.jam_selesai' },
//     {data:'lokasi',name: 'pekerjaan.lokasi'},
//     {data:'status',name: 'pekerjaan.status'},
//     {data:'foto',name: 'pekerjaan.foto'},
//     {data:'action',name:'action'},
//         ]
//     });
// });

load();
$(function() {
  load();
});
function load(){
      $('#table').DataTable({
        processing: true,
        serverSide: true,
        // fixedHeader: true,
        // scrollY: '600px',
        // paging: false,
        scrollCollapse: true,
        destroy:true,
         language: {
            'search' : 'Cari:' /*Empty to remove the label*/
        },
        // "order": [[ 4, "asc" ]],
        ajax: {
            url:'{!! route("catatan-pemeliharaan.json") !!}',
            data: function ( d ) {
 $.each($('.form-filter').serializeArray(), function(i, obj){
      d[obj['name']] = obj['value'];
   });

  },
        },
        columns: [
         // {data:'nama',name:'jenis_pekerjaan.nama'},

    {data:'tanggal',name: 'pekerjaan.tanggal' },
    {data:'perbaikan',name: 'pekerjaan.perbaikan' },
    {data:'jam_mulai',name: 'pekerjaan.jam_mulai' },
    {data:'jam_selesai',name: 'pekerjaan.jam_selesai' },
    {data:'lokasi',name: 'pekerjaan.lokasi'},
    {data:'status',name: 'pekerjaan.status'},
    {data:'keterangan',name: 'pekerjaan.keterangan'},
    {data:'biaya',name: 'pekerjaan.biaya'},
    {data:'foto',name: 'pekerjaan.foto'},
    {data:'teknisi',name: 'pekerjaan.id_teknisi'},
    {data:'action',name:'action'},
        ]
    });

}

// $(document).on('click', '.btn-filter', function() {
//     // event.preventDefault();
//     var  form = $(".form-filter").serialize();
//     // console.log(form);
//     var url = $(".data-src").val()+form;
//     // console.log(url);
//     $(".btn-print").attr('href',url+'&pdf=false');
//     $(".btn-print-pdf").attr('href',url+'&pdf=true');
//     load();
//     // load(form);
//     // console.log(form);

//     // alert("X");

//     /* Act on the event */
// }); 

// $(document).on('click', '.btn-reset', function() {
//     // event.preventDefault();
//      Act on the event 
//     $(".id_alkese").val(null).trigger('change');
//     load();
// });

$(document).ready(function() {
  setInterval(function() {
    load();
  }, 900000);
});


$(document).on('change', '.tanggal', function() {
    load();
});


    $(document).on('click', '.print-excel', function(){
        var dari_tanggal = $('#dari_tanggal').val();
        var sampai_tanggal = $('#sampai_tanggal').val();
        var url = '?pdf=false&dari_tanggal='+dari_tanggal+'&sampai_tanggal='+sampai_tanggal;
        var url_lengkap = '{{ url('catatan-pemeliharaan/print-filter') }}'+url;
        // alert(url_lengkap);
        window.open(url_lengkap);
    });


    $(document).on('click', '.btn-print-pdf', function(){
        var dari_tanggal = $('#dari_tanggal').val();
        var sampai_tanggal = $('#sampai_tanggal').val();
        var url = '?pdf=true&dari_tanggal='+dari_tanggal+'&sampai_tanggal='+sampai_tanggal;
        var url_lengkap = '{{ url('catatan-pemeliharaan/print-filter') }}'+url;
        // alert(url);
        window.open(url_lengkap);
    });
</script>
@endpush


