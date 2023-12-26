
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
              <h3 class="card-title">Sumber Dana</h3>
              <div class="card-tools">
                <button class="btn create-btn btn-primary" data-src="{{ url('sumber-dana/create') }}" data-title="Tambah">+ TAMBAH</button>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              
                     
              

<table class="table table-striped" id="table">
  <thead>
    <th>no</th>
     <th>nama</th>

  
  
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
        ajax: '{!! route("sumber_dana.json") !!}',
        columns: [
         {data:'DT_RowIndex',name:'DT_RowIndex',orderable:false}, 
         {data:'nama',name:'sumber_dana.nama'},
{data:'action',name:'action'}
     
        ]
    });
});


</script>
@endpush


