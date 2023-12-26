
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
              <h3 class="card-title">supplier</h3>
              <div class="card-tools">
                <button class="btn create-btn btn-primary" data-src="{{ url('supplier/create') }}" data-title="Tambah">+ TAMBAH</button>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              
                     
              <style type="text/css">
                           </style>

<table class="table table-striped" id="table">
  <thead>
    <th>no</th>
    <th>nama</th>
    <th>alamat</th>

  
  
    <th>Opsi</th>

  </thead>

  <tbody>
  </tbody>
</table>
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

$(function() {
    $('#table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route("supplier.json") !!}',
        columns: [
         {data:'DT_RowIndex',name:'DT_RowIndex',orderable:false},

         {data:'nama',name:'supplier.nama'},
{data:'alamat',name:'supplier.alamat'},
{data:'action',name:'action'}
     
        ]
    });
});


</script>
@endpush


