
@extends('layouts.app')
@section('title')
{{@$title}}
@endsection

@section('content')



    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Kategori Checklist</h3>
              <div class="card-tools">
                <button class="btn create-btn btn-primary" data-src="{{ url('kategori-checklist/create') }}" data-title="Tambah">+ TAMBAH</button>
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
        ajax: '{!! route("kategori_checklist.json") !!}',
        columns: [
         { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable:false },
         {data:'nama',name:'kategori_checklist.nama'},
{data:'action',name:'action'}
     
        ]
    });
});


</script>
@endpush


