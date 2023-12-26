
@extends('layouts.app')

@section('title')
<h1>{{@$title}}</h1>
@endsection

@section('content')



    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Permintaan Pelayanan</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              
                     <form action="{{url("permintaan-pelayanan")}}" method="post"    id="form">

{{csrf_field()}}

<div class="row">
  
<div class="col-lg-6">
  
<div class="form-group">
<label>Ruangan</label>

<select class='form-control select2 ruangan' data-url='{{url('ruangan/select2')}}' name='id_ruang'></select>
</div>
<div class="form-group">
<label>Kerusakan Alat</label>
<textarea class="form-control" name="kerusakan_alat"></textarea>
</div>
<div class="form-group">
<label> Alat Kesehatan</label>

<select class='form-control select2 alat' data-url='{{url('data-alkes/select2')}}' name='id_alkes'></select>
</div>
<div class="form-group">
<label>Merk</label>
<input type='text' class='form-control merk' name='merk' value='' readonly="">
</div>

<div class="form-group">
<label>Model</label>
<input type='text' class='form-control tipe' name='model' value='' readonly="">
</div>
<div class="form-group">
<label>No Seri</label>
<input type='text' class='form-control nomor_seri' name='no_seri' value='' readonly="">
</div>
<div class="form-group">
<label>Lain-lain</label>
<textarea class="form-control" name="lain_lain"></textarea>
</div>
</div>


<div class="col-lg-6">
  
<div class="form-group">
<label>Kerusakan awal</label>
<textarea class="form-control" name="kerusakan_awal"></textarea>
</div>
<div class="form-group">
<label>Tanggal ajuan</label>
<input type='date' class='form-control' name='tanggal_ajuan' value='{{date('Y-m-d')}}'>
</div>
<div class="form-group">
<label>Batas waktu perbaikan</label>
<input type='date' class='form-control' name='batas_waktu_perbaikan' value=''>
</div>
<div class="form-group">
<label>Kerusakan Terakhir pada tanggal</label>
<input type='date' class='form-control' name='data_kerusakan_tanggal' value=''>
</div>
<div class="form-group">
<label>Opsi Kerusakan</label>

<select class='form-control' name='opsi_kerusakan'>
  <option value="">Pilih Opsi Kerusakan</option>
  <option value="Perbaikan">Perbaikan</option>
<option value="Pergantian">Pergantian</option>
</select>
</div>
<div class="form-group">
<label>Catatan Tambahan</label>
{{-- <input type='text' class='form-control' name='catatan_tambahan' value=''> --}}
<textarea class="form-control" name="catatan_tambahan"></textarea>
</div>
</div>
</div>

<button data-redirect-to="{{url("permintaan-pelayanan")}}" class="btn btn-primary save-btn" data-redirect="true">Simpan</button>;		
</form>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

         
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>

    
                @endsection

@push('scripts')
<script type="text/javascript">
  $(document).on('change', '.ruangan', function() {
    var val = $(this).val();
    var url ="{{ url('data-alkes/select2') }}?ruangan="+val;

    $(".alat").attr('data-url', url);
  });
  $(document).on('change', '.alat', function() {
    // event.preventDefault();

          var adds = $(this).attr('data-additional');
        // alert(adds);
        var parse = JSON.parse(adds);



        $.each(parse, function(index, val) {
            $("."+index).val(val);
             /* iterate through array or object */
        });
    /* Act on the event */
  });
</script>
  {{-- expr --}}
@endpush