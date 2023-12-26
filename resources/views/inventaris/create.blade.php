

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
              <h3 class="card-title">Tambah Catatan Perbaikan</h3> 
              <div class="card-tools">
                <a class="btn btn-warning" href="{{ URL::previous() }}"><i class="fas fa-arrow-left" ></i> KEMBALI</a>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form action="{{url("inventaris")}}" method="post"  enctype="multipart/form-data"  id="form">

{{csrf_field()}}

<div class="row">
  <div class="col-md-6">
{{--     <div class="form-group">
<label>Nama Barang</label>
<input type='text' class='form-control' name='nama_barang' value=''>
</div> --}}

  <div class="form-group">
      <label>Nama Barang <a href="{{ url('master-barang') }}">(<u>Lihat Master Barang</u>)</a></label>
      <select class='form-control select2 master-barang' data-url='{{url('master-barang/select2')}}' name='master_barang_id'></select>
    </div>

<div class="form-group">
      <label>Merk <a href="{{ url('master-merk') }}">(<u>Lihat Master Merk Disini</u>)</a></label>

        <select class='form-control select2 merk' data-url='{{url('master-merk/select2')}}' name='merk'></select>
    </div>

<div class="form-group">
<label>Tipe</label>
<input type='text' class='form-control' name='tipe' value=''>
</div>

<div class="form-group">
<label>Kapasitas</label>
<input type='text' class='form-control' name='kapasitas' value=''>
</div>



  </div>

  <div class="col-md-6">
  <div class="form-group">
      <label>Ruang <a href="{{ url('ruangan') }}">(<u>Lihat Master Ruang Disini</u>)</a></label>
      <select class='form-control select2 ruangan' data-url='{{url('ruangan/select2')}}' name='ruang'></select>
    </div>
    <div class="form-group">
<label>Jumlah</label>
<input type='number' class='form-control' name='jumlah' value=''>
</div>

<div class="form-group">
<label>Kondisi</label>
<select class="form-control" name="kondisi">
  <option value="">-- Pilih Kondisi --</option>
  <option value="Baik">Baik</option>
  <option value="Rusak">Rusak</option>
</select>
</div>

<div class="form-group">
<label>Keterangan</label>
<textarea class="form-control" name="keterangan"></textarea>
</div>
  </div>

   <button data-redirect="true" data-redirect-to="{{ route('inventaris.index') }}" class="btn btn-primary save-btn">Simpan</button>

            <a style="margin-left: 10px" class="btn btn-warning" href="{{ URL::previous() }}"><i class="fas fa-arrow-left" ></i> BATAL</a>
            </div>
</div>


{{-- <div class="form-group">
<label>nip</label>
<input type='text' class='form-control' name='nip' value=''>
</div>
<div class="form-group">
<label>ttd</label>
<input type='file' class='form-control  ttd' name='ttd' value='' style="width: 100%;">
<img id="blah" src="#" alt="your image" /> --}}


</div>

        
</form>

           
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
<script type="text/javascript">
  // alert("x");

    $(document).on('change', '.alat', function() {
        var adds = $(this).attr('data-additional');
        // alert(adds);
        var parse = JSON.parse(adds);



        $.each(parse, function(index, val) {
            $("."+index).val(val);
             /* iterate through array or object */
        });

        /* Act on the event */
    });
  $(document).on('change', '.tahun', function() {
    // event.preventDefault();
      
            // loadForm();
        // var pec
        // console.log(JSON.parse(adds));
    /* Act on the event */
  });
            // loadForm();

    // function loadForm(){
    //       var value = $(".tahun").val();

    //     var alkes  = $(".alat").val();
    //     var jenis_pekerjaan = $(".jenis_pekerjaan").val();
        
    //     $.get("{{ url('catatan-pemeliharaan/getChecklist') }}?tahun="+value+"&alkes="+alkes+"&jenis_pekerjaan="+jenis_pekerjaan+"&permintaan_pelayanan={{Request::get('permintaan_pelayanan')}}",function(res){
    //             $(".wrap-results").html(res.view);
    //             select2Load();
    //     });


       

    // }
    // $(document).on('change', '.teknisi', function() {
    //     // event.preventDefault();

    //     var adds = $(this).attr('data-additional');
    //     var target = $(this).attr('data-target');
    //     // alert(adds);
    //     var parse = JSON.parse(adds);

    //     // console.log(parse);
    //     $("."+target).show();

    //     $("."+target).attr('src',"{{ url('/') }}/"+parse.ttd);
    //     $(".ttd-"+target).val(parse.ttd);

    //     /* Act on the event */
    // });

$(document).on('change', '.pelaksana', function() {
    // event.preventDefault();
    var val = $(this).val();
    // alert("X");
    $.get("{{ url('catatan-pemeliharaan/form') }}?type="+val,function(res){
        $(".pelaksana_result").html(res);

        select2Load();

    })
    /* Act on the event */
});
</script>
  {{-- expr --}}
@endpush
