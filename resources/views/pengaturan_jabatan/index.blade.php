

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
              <h3 class="card-title">Pengaturan Jabatan</h3>
              <div class="card-tools">
{{--  <button class="btn create-btn btn-primary" data-src="{{ url('teknisi/create') }}" data-title="Tambah">+ Tambah</button> --}}

              </div>

            </div>
            <!-- /.card-header -->
            <div class="card-body">
              
                    
<div class="col-md-6 row">
  <form action="{{url('pengaturan_jabatan/1')}}" method="post" id="form" class="form" style="width: 100%">
    {{csrf_field()}}
    {{method_field("PUT")}}
    <div class="form-group row">
      <label class="col-sm-3 col-form-label">Kepala Instalasi Alkes</label>
      <div class="col-sm-6">
      <select class="form-control select2" name="kepala_instalasi_alkes" data-url="{{ url('teknisi/select2') }}">
        @if ($data != NULL)
          <option value="{{$data->kepala_instalasi_alkes}}">{{$data->kepala_teknisi->nama}}</option>
        @endif
        </select>
      </div>
      <div class="col-sm-3">
       
      </div>
    </div>
    <div class="form-group row">
       <button class="btn btn-sm btn-primary save-btn">Simpan</button>
    </div>
</div>
  </form>             
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

