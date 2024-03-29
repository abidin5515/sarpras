

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
              <h3 class="card-title">Daftar Master Ceklis</h3>
              <div class="card-tools">
 <button class="btn create-btn btn-primary" data-src="{{ url('master_ceklis/create') }}" data-title="Tambah">+ Tambah Ceklis</button>

              </div>

            </div>
            <!-- /.card-header -->
            <div class="card-body">
              
                    
{{-- <div class="col-md-6 row">
  <form action="{{url('Ceklis/updateKepala')}}" method="post" id="form" class="form" style="width: 100%">
    <div class="form-group row">
      <label class="col-sm-3 col-form-label">set Kepala</label>
      <div class="col-sm-6">
      <select class="form-control select2" name="id_petugas" data-url="{{ url('Ceklis/select2') }}">
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
 <div class="table table-responsive">
<table class="table table-striped" id="table">
  <thead>
     <th>No</th>
    <th>Nama</th>
{{--     <th>NIP</th>
    <th>TTD</th> --}}

  
  
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
    </div>
      <!-- /.row -->
    </section>

    
                @endsection



@push('scripts')
<script>

$(function() {
    $('#table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route("master_ceklis.json") !!}',
        columns: [
        {data: 'DT_RowIndex', searchable: false, orderable: false},
        {data:'nama_ceklis',name:'master_ceklis.nama_ceklis'},
        // {data:'nip',name:'Ceklis.nip'},
        // {data:'ttd',name:'Ceklis.ttd'},
        {data:'action',name:'action'}
     
        ]
    });
});


</script>
@endpush


