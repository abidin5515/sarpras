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
              <h3 class="card-title">Edit Inventaris</h3> 
              <div class="card-tools">
                <a class="btn btn-warning" href="{{ URL::previous() }}"><i class="fas fa-arrow-left" ></i> KEMBALI</a>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form action="{{url("inventaris/".$data->id)}}" method="post"  enctype="multipart/form-data"  id="form">

{{csrf_field()}}
{{method_field("PUT")}}

<div class="row">
  <div class="col-md-6">
{{--     <div class="form-group">
<label>Nama Barang</label>
<input type='text' class='form-control' name='nama_barang' value='{{ @$data->nama_barang }}'>
</div> --}}

<div class="form-group">
      <label>Nama Barang <a href="{{ url('master-barang') }}">(<u>Lihat Master Barang</u>)</a></label>
      <select class='form-control select2 master-barang' data-url='{{url('master-barang/select2')}}' name='master_barang_id'>
        <option value="{{ @$data->master_barang_id }}">{{ @$data->masterbarang->nama }}</option>
      </select>
    </div>

<div class="form-group">
  <label>Merk <a href="{{ url('master-merk') }}">(<u>Lihat Master Merk Disini</u>)</a></label>
  <select class='form-control select2 merk' data-url='{{url('master-merk/select2')}}' name='merk'>
      @if ($data->merk)
        <option selected="selected" value="{{@$data->merk}}">{{ @$data->mastermerk->nama }}</option>
      @endif
  </select>
 
</div>

<div class="form-group">
<label>Tipe</label>
<input type='text' class='form-control' name='tipe' value='{{ @$data->tipe }}'>
</div>

<div class="form-group">
<label>Kapasitas</label>
<input type='text' class='form-control' name='kapasitas' value='{{ @$data->kapasitas }}'>
</div>



  </div>

  <div class="col-md-6">
  <div class="form-group">
      <label>Ruang <a href="{{ url('ruangan') }}">(<u>Lihat Master Ruang Disini</u>)</a></label>
        <select class='form-control select2 ruangan' data-url='{{url('ruangan/select2')}}' name='ruang'>
          @if ($data->ruang)
            <option selected="selected" value="{{@$data->ruang}}">{{ @$data->masterruang->nama }}</option>
          @endif
        </select>
    </div>
    <div class="form-group">
<label>Jumlah</label>
<input type='number' class='form-control' name='jumlah' value='{{ @$data->jumlah }}'>
</div>

<div class="form-group">
<label>Kondisi</label>
<select class="form-control" name="kondisi">
  <option value="">-- Pilih Kondisi --</option>
  <option {{ (@$data->kondisi == 'Baik' ? 'selected' : '' ) }} value="Baik">Baik</option>
  <option {{ (@$data->kondisi == 'Rusak' ? 'selected' : '' ) }} value="Rusak">Rusak</option>
</select>
</div>

<div class="form-group">
<label>Keterangan</label>
<textarea class="form-control" name="keterangan">{{ @$data->keterangan }}</textarea>
</div>
  </div>

  
            </div>
            <div class="row">
              <center>
    <button data-redirect="true" data-redirect-to="{{ route('inventaris.index') }}" class="btn btn-primary save-btn">Simpan</button>

  <a style="margin-left: 10px" class="btn btn-warning" href="{{ URL::previous() }}"><i class="fas fa-arrow-left" ></i> BATAL</a>
  </center>
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

@endpush
