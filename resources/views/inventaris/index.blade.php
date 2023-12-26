

@extends('layouts.app')
@section('title')
<h1>{{@$title}}</h1>
@endsection

@section('content')

  <style type="text/css">
    /*td {
      font-size: 14px;
    }*/
     span.select2-container {
    z-index: 0;
}
  </style>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Daftar Inventaris</h3>
              <div class="card-tools">
                <a class="btn btn-primary" href="{{ url('inventaris/create') }}" data-title="Tambah Inventaris">+ Tambah Inventaris</a>

              </div>

            </div>
            <!-- /.card-header -->
            <div class="card-body">
              
                    
{{-- <div class="col-md-6 row">
  <form action="{{url('teknisi/updateKepala')}}" method="post" id="form" class="form" style="width: 100%">
    <div class="form-group row">
      <label class="col-sm-3 col-form-label">set Kepala</label>
      <div class="col-sm-6">
      <select class="form-control select2" name="id_petugas" data-url="{{ url('teknisi/select2') }}">
        @if ($kepala != NULL)
          <option value="{{$kepala->id}}">{{$kepala->nama}}</option>
        @endif
        </select>
      </div>
      <div class="col-sm-3">
        <button class="btn btn-sm btn-primary save-btn">Simpan</button>
      </div>
    </div>
    </form>
</div>
  
 <hr>                 
 --}}
 <div class="row">

      <div class="col-md-2">
      <form class="form-filter">
      <div class="form-group">
        <label for="formGroupExampleInput">Nama Barang</label>
        <select class='form-control select2 master-barang' data-url='{{url('master-barang/select2f')}}' name='master_barang_id'></select>
      </div>
      
    </div>
    <div class="col-md-2">
      
      <div class="form-group">
        <label for="formGroupExampleInput">Merk</label>
        <select class='form-control select2 merk' data-url='{{url('master-merk/select2f')}}' name='merk'>
        </select>
      </div>

    </div>

    <div class="col-md-2">
      
      <div class="form-group">
        <label for="formGroupExampleInput">Ruang</label>
        <select class='form-control select2 ruang' data-url='{{url('ruangan/select2f')}}' name='ruang'></select>
      </div>
      
    </div>



    </form>
    <div class="col-md-6" style="float: right;">
      <button style="margin-left: 10px;" class="btn btn-sm btn-success btn-export float-right" data-tipe="excel"><i class="fa fa-file-excel" aria-hidden="true"></i> EXCEL</button>

      <button class="btn btn-sm btn-danger btn-export float-right" data-tipe="pdf"><i class="fa fa-file-pdf" aria-hidden="true"></i> PDF</button>
    </div>
  
 </div>
 <div class="table table-responsive">

<table class="table table-striped" id="table">
  <thead>
    <th>No</th>
    <th>Nama Barang</th>
    <th>Merk</th>
    <th>Tipe</th>
    <th>Kapasitas</th>
    <th>Nomor Seri</th>
    <th>Ruang</th>
    <th>Jumlah</th>
    <th>Kondisi</th>
    <th>Keterangan</th>
    <th>Opsi</th>
  </thead>

  <tbody>
  </tbody>
</table>
</div>
  <br>
  
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

         
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
    </div>
      <!-- /.row -->
    </section>

    
                @endsection


{{-- <link rel="stylesheet" type="text/css"  href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" />
<link rel="stylesheet" type="text/css"  href="https://cdn.datatables.net/buttons/1.4.0/css/buttons.dataTables.min.css" />

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/pdfmake.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.4.0/js/dataTables.buttons.min.js"></script> --}}
{{-- <script src="https://cdn.datatables.net/buttons/1.4.0/js/buttons.flash.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.4.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.4.0/js/buttons.print.min.js"></script> --}}



@push('scripts')
<script>

$(document).on('change', '.merk', function(){
  load();
});

$(document).on('change', '.ruang', function(){
  load();
});

$(document).on('change', '.master-barang', function(){
  load();
});

$(document).ready(function() {
    load();
});

function load() {
  $('#table').DataTable({
        processing: true,
        serverSide: true,
        destroy:true,

        ajax: {
            url:'{!! route("inventaris.json") !!}',
            data: function ( d ) {
            $.each($('.form-filter').serializeArray(), function(i, obj){
              d[obj['name']] = obj['value'];
          });

        },
        },
        columns: [
        {data: 'DT_RowIndex', searchable: false, orderable: false},
        {data:'namabarang',name:'namabarang'},
        {data:'merknama',name:'merknama'},
        {data:'tipe',name:'inventaris.tipe'},
        {data:'kapasitas',name:'kapasitas'},
        {data:'nomor_seri',name:'inventaris.nomor_seri'},
        {data:'ruangnama',name:'ruangnama'},
        {data:'jumlah',name:'inventaris.jumlah'},
        {data:'kondisi',name:'kondisi'},
        {data:'keterangan',name:'keterangan'},
        {data:'action',name:'action'}
     
        ]
    });
}

$(document).on('click', '.btn-export', function(){
  var merk = $(".merk").val();
  var ruang = $(".ruang").val();
  var master_barang_id = $(".master-barang").val();
  var tipe = $(this).attr('data-tipe');
  window.open('inventaris/export?merk='+merk+'&ruang='+ruang+'&tipe='+tipe+'&master_barang_id='+master_barang_id);
});
    
</script>
@endpush


