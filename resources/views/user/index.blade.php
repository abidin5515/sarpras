
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
              <h3 class="card-title">user</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              
                     <button class="btn create-btn btn-primary" data-src="{{ url('user/create') }}" data-title="Tambah">Tambah</button>
              

<table class="table table-striped" id="table">
  <thead>
     <th>no</th>
    <th>username</th>
    <th>role</th>

  
  
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
        ajax: '{!! route("user.json") !!}',
        columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable:false },
{data:'username',name:'user.username'},
{data:'role_name',name:'role.name'},
{data:'action',name:'action'}
     
        ]
    });
});


</script>
@endpush


