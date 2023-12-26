@extends('layouts.app')
@section('title')
<h1>{{@$title}}</h1>
@endsection

@section('content')
  <style type="text/css">
    td {
      font-size: 14px;
    }
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
              <h3 class="card-title">Data Alkes</h3>
              <div class="card-tools">
                <a href="{{ url('data-alkes/create') }}" class="btn btn-sm btn-primary" >+ TAMBAH</a> 
                <button type="button" class="btn btn-sm btn-info create-btn" data-lg="true" data-iframe="true" data-src="{{ url('cetak-alkes') }}" data-save="false"><i class="nav-icon fas fa-print"></i> Cetak</button>
              </div>
            </div>

            <!-- /.card-header -->
            <div class="card-body">
                <form method="get">
                    {{ csrf_field() }}
                  
                  <div class="row">
                    
                    <div class="col">
                      <label>Cetak Berdasarkan</label>
                      <select class="form-control filter-print" name="filter">
                        <option value="">-- Berdasarkan --</option>
                        <option value="supplier">Supplier</option>
                        <option value="alat">Alat</option>
                        <option value="ruangan">Ruangan</option>
                      </select>
                    </div>
                    <div class="col">
                      <label>Tentukan</label>
                      <div id="isi-pilihan">
                        <p>Berdasarkan apa ?</p>
                      </div>
                    </div>

                    <div class="col">
                      <button style="margin-top: 30px" type="button" class="btn create-btn btn-sm btn-info btn-cetak-custom" data-lg="true" data-iframe="true" data-save="false"  data-src="{{ url('cetak-alkes') }}"><i class="nav-icon fas fa-print"></i> Cetak</button>
                      <button style="margin-top: 30px" type="button" class="btn btn-sm btn-danger btn-reset"> Reset</button>
                    </div>
                  </div>
                    </form>            

                    <div class="table-responsive">
                      <table class="table table-striped" id="table" style="width: 100%">
  <thead>
      <th>KODE</th>
      <th>NO.INVENT</th>
     <th>NAMA ALAT</th>
     <th>MERK</th>
    <th>TIPE</th>
    <th>NO.SERI</th>
    <th>MANUFACTURE</th>
    <th>LOKASI</th>
    <th>SUPPLIER</th>
    <th>Opsi</th>

  </thead>

  <tbody>
  </tbody>
</table>
                    </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

         
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    </section>

    
                @endsection



@push('scripts')
<script>
getData('n', 'n');
function getData(tipe, id){
  $('#table').DataTable({
        destroy:true,
        processing: true,
        serverSide: true,
        ajax: '{!! url("data-alkes/json") !!}/'+tipe+'/'+id,
        columns: [
          {data:'kode',name:'kode'},
          {data:'no_invent',name:'no_invent'},
          {data:'nama_alat',name:'alat.nama'},
          {data:'merk',name:'merk'},
          {data:'tipe',name:'tipe'},
          {data:'nomor_seri',name:'nomor_seri'},
          {data:'manufacture',name:'manufacture'},
          {data:'lokasi',name:'ruangan.nama'},
          {data:'nama_supplier',name:'supplier.nama'},
          {data:'action',name:'action'}
     
        ]
    });
}


// $(document).on('click', '.show-alat', function(){
//   // alert('tes');
//   var id_alat = $(this).attr('data-id');
//   // $('#table-history').DataTable({
//   //       processing: true,
//   //       serverSide: true,
//   //       ajax: '{!! url("alat/history/") !!}'+id_alat,
//   //       columns: [
//   //         {data:'nama_ruangan',name:'nama_ruangan'},
//   //         {data:'tgl_masuk',name:'tgl_masuk'},
//   //         {data:'tgl_keluar',name:'tgl_keluar'},
     
//   //       ]
//   //   });
// });

$(document).on('change', '.filter-print', function(){
  var tipe = $(this).val();
  // $(".tentukan-pilihan").removeAttr('data-url');
  // $(".tentukan-pilihan").val(null).trigger('change');
  // $(".tentukan-pilihan").select2("val", "");
  // $(".tentukan-pilihan").attr('data-url', "{{ url('') }}/"+tipe+"/select2");
  if(tipe != ''){
      $.ajax({
      url: '{{ url('filter-type') }}/'+tipe,
      type: 'GET',
      dataType: 'HTML',
      // data: form,
      success:function(res){
        // alert(res);
        $("#isi-pilihan").html(res);
        select2Load();
      }
    });
    }else {
      $("#isi-pilihan").html('<p>Berdasarkan apa ?</p>');
    }
  
  var src = '{{ url('cetak-alkes') }}';
  $(".btn-cetak-custom").attr('data-src', src);
});

$(document).on('change', '.tentukan-pilihan', function(){
  var tipe = $('.filter-print').val();
  var id = $(this).val();
  var src = '{{ url('cetak-alkes-custom') }}/'+tipe+'/'+id;
  if(id){
    $(".btn-cetak-custom").attr('data-src', src);
    getData(tipe, id);  
  }  
});

$(".btn-reset").click(function(){
  $(".filter-print").val("");
  // $(".tentukan-pilihan").val(null).trigger('change');
  $("#isi-pilihan").html("<p>Berdasarkan apa ?</p>");
   var src = '{{ url('cetak-alkes') }}';
  $(".btn-cetak-custom").attr('data-src', src);
  getData('n', 'n');  
});
</script>
@endpush


