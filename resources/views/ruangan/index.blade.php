
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
              <h3 class="card-title" style="margin-top: 5px;">Daftar Master Ruang</h3>
              <div class="card-tools">
                <button class="btn create-btn btn-primary" data-src="{{ url('ruangan/create') }}" data-title="Tambah">+ Tambah Master Ruang</button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="card-body">
              
                     
              

<table class="table table-striped" id="table">
  <thead>
     <th>No</th>
    <th>Nama Ruang</th>
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
        ajax: '{!! route("ruangan.json") !!}',
        columns: [
         {data: 'DT_RowIndex', searchable: false, orderable: false},
{data:'nama',name:'ruangan.nama'},
// {data:'awalan',name:'ruangan.awalan'},
{data:'action',name:'action'}
     
        ]
    });
});


</script>
@endpush


