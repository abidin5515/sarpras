
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
              <h3 class="card-title" style="margin-top: 5px;">Daftar Master Shift</h3>
              <div class="card-tools">
                <button class="btn create-btn btn-primary" data-src="{{ url('master_shift/create') }}" data-title="Tambah">+ Tambah Master Shift</button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="card-body">
              
                     
              

<table class="table table-striped" id="table">
  <thead>
      <th>No</th>
      <th>Nama Shift</th>
      <th>Jam Masuk</th>
      <th>Jam Pulang</th>
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

$(function() {
    $('#table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route("master_shift.json") !!}',
        columns: [
          {data: 'DT_RowIndex', searchable: false, orderable: false},
          {data:'nama',name:'master_shift.nama'},
          {data:'jam_masuk',name:'master_shift.jam_masuk'},
          {data:'jam_pulang',name:'master_shift.jam_pulang'},
          {data:'action',name:'action'}
     
        ]
    });
});


</script>
@endpush


