
@extends('layouts.app')
@section('title')
<h1>{{@$title}}</h1>
@endsection

@section('content')



    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        
              <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title" style="margin-top: 5px;">Daftar Pengadaan</h3>
              <div class="card-tools">
                <a class="btn btn-success text-white print-excel"><i class="fas fa-file-excel" ></i> EXPORT EXCEL</a>
                <button class="btn create-btn btn-primary" data-src="{{ url('pengadaan/create') }}" data-title="Tambah">+ Tambah Pengadaan</button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="card-body">
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
                     
              

                  <table class="table table-striped" id="table">
                    <thead>
                      <th>No</th>
                      <th>Nama Barang</th>
                      <th>Qty</th>
                      <th>Ruang</th>
                      <th>Foto</th>
                      <th>Status</th>
                      <th>Keterangan</th>
                      <th>Tanggal Input</th>
                      <th>Opsi</th>

                    </thead>

                    <tbody>
                    </tbody>
                  </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

         
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      </div>
      <!-- /.row -->
    </section>

    
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
            url:'{!! route("pengadaan.json") !!}',
            data: function ( d ) {
             $.each($('.form-filter').serializeArray(), function(i, obj){
                  d[obj['name']] = obj['value'];
               });

              },
        },
        columns: [
          {data: 'DT_RowIndex', searchable: false, orderable: false},
          {data:'nama_barang',name:'pengadaan.nama_barang'},
          {data:'qty',name:'pengadaan.qty'},
          {data:'ruang',name:'pengadaan.ruang'},
          {data:'foto',name:'pengadaan.foto'},
          {data:'status',name:'pengadaan.status'},
          {data:'keterangan',name:'pengadaan.keterangan'},
          {data:'tanggal_input',name:'pengadaan.created_at'},
          {data:'action',name:'action'}
     
        ]
    });
}


$(document).on('change', '.tanggal', function() {
    load();
});

$(document).on('click', '.print-excel', function(){
        var dari_tanggal = $('#dari_tanggal').val();
        var sampai_tanggal = $('#sampai_tanggal').val();
        var url = '{{ url('pengadaan-excel?dari_tanggal=') }}'+dari_tanggal+'&sampai_tanggal='+sampai_tanggal;
        // alert(url);
        window.open(url);
    });

</script>
@endpush


