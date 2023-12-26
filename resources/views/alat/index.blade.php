
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
              <h3 class="card-title">alat</h3>
              <div class="card-tools">
                <a class="btn btn-primary" href="{{ url('alat/create') }}" data-title="Tambah">+ TAMBAH</a>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              
                     
              

<table class="table table-striped" id="table">
  <thead>
    <th>no</th>
     <th>nama</th>
{{-- <th>gambar</th>
<th>merk</th>
<th>tipe</th>
<th>nomor_seri</th>
<th>manufacture</th> --}}

  
  
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
        ajax: '{!! route("alat.json") !!}',
        columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable:false },
         {data:'nama',name:'alat.nama'},
// {data:'gambar',name:'alat.gambar'},
// {data:'merk',name:'alat.merk'},
// {data:'tipe',name:'alat.tipe'},
// {data:'nomor_seri',name:'alat.nomor_seri'},
// {data:'manufacture',name:'alat.manufacture'},
{data:'action',name:'action'}
     
        ]
    });
});


</script>
@endpush


