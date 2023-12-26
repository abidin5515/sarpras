
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
              <h3 class="card-title">Permintaan_pelayanan</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              
                     <form action="{{url("permintaan-pelayanan/".$data->id)}}"   method="post"  id="form">

{{csrf_field()}}
{{method_field("PUT")}}
<div class="row">
  
<div class="col-lg-6">
  <div class="form-group">
<label>Ruangan</label>

<select class='form-control select2 ruangan' data-url='{{url('ruangan/select2')}}' name='id_ruang'>
@foreach($ruangan as $ruangan)
<option value="{{$ruangan->id}}">{{$ruangan->nama}}</option>
@endforeach</select>
</div>
<div class="form-group">
<label>Kerusakan Alat</label>
<textarea class="form-control" name="kerusakan_alat">{{$data->kerusakan_alat}}</textarea>
</div>
<div class="form-group">
<label>Alat Kesehatan</label>

<select class='form-control select2 alat' data-url='{{url('data-alkes/select2')}}' name='id_alkes'>

@foreach($alkes as $alkes)
<option selected="" value="{{$alkes->id}}">{{$alkes->alat->nama}}</option>
@endforeach</select>
</div>
<div class="form-group">
<label>merk</label>
<input type='text' class='form-control merk' name='merk' value='{{$data->merk}}' readonly="">
</div>


<div class="form-group">
<label>Model</label>
<input type='text' class='form-control tipe' name='model' value='{{$data->model}}' readonly="">
</div>
<div class="form-group">
<label>no_seri</label>
<input type='text' class='form-control nomor_seri' name='no_seri' value='{{$data->no_seri}}' readonly="">
</div>
<div class="form-group">
<label>lain_lain</label>
<textarea class="form-control">{{$data->lain_lain}}</textarea>
</div>
</div>

<div class="col-lg-6">
  <div class="form-group">
<label>kerusakan_awal</label>
{{-- <input type='text' class='form-control' name='kerusakan_awal' value='{{$data->kerusakan_awal}}'> --}}
<textarea class="form-control" name="kerusakan_awal">{{$data->kerusakan_awal}}</textarea>
</div>
<div class="form-group">
<label>tanggal_ajuan</label>
<input type='date' class='form-control' name='tanggal_ajuan' value='{{$data->tanggal_ajuan}}'>
</div>
<div class="form-group">
<label>batas_waktu_perbaikan</label>
<input type='date' class='form-control' name='batas_waktu_perbaikan' value='{{$data->batas_waktu_perbaikan}}'>
</div>
<div class="form-group">
<label>data_kerusakan_tanggal</label>
<input type='date' class='form-control' name='data_kerusakan_tanggal' value='{{$data->data_kerusakan_tanggal}}'>
</div>
<div class="form-group">
<label>opsi_kerusakan</label>

<select class='form-control' name='opsi_kerusakan'><option {{$data->opsi_kerusakan == "Perbaikan" ? "selected":""}} value="Perbaikan">Perbaikan</option>
<option {{$data->opsi_kerusakan == "Pergantian" ? "selected":""}} value="Pergantian">Pergantian</option>
</select>
</div>
<div class="form-group">
<label>catatan_tambahan</label>
{{-- <input type='text' class='form-control' name='catatan_tambahan' value='{{$data->catatan_tambahan}}'> --}}
<textarea class="form-control" name="catatan_tambahan">{{$data->catatan_tambahan}}</textarea>
</div>
</div>
</div>

<button data-redirect-to="{{url("permintaan-pelayanan/")}}"  class="btn btn-primary save-btn" data-redirect="true">Update</button>;
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