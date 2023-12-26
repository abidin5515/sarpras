
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
              <h3 class="card-title">roles</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              
                     <a class="btn  btn-primary" href="{{ url('roles/create') }}" data-title="Tambah">Tambah</a>
              

<table class="table table-striped" id="table">
  <thead>
     <th>no</th>
<th>name</th>
<th>title</th>
<th>level</th>
<th>scope</th>

  
  
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
    </section>

    
                @endsection



@push('scripts')
<script>

$(function() {
    $('#table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route("roles.json") !!}',
        columns: [
         { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable:false },
{data:'name',name:'roles.name'},
{data:'title',name:'roles.title'},
{data:'level',name:'roles.level'},
{data:'scope',name:'roles.scope'},
{data:'action',name:'action'}
     
        ]
    });
});


</script>
@endpush


