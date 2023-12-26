
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
              <h3 class="card-title">Pengaturan </h3>
              <div class="card-tools">
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              
                     
             <div class="row">
               <div class="col-lg-6">
                 <table class="table table-striped">
                   <tr>
                     <td>Reset Data</td><td><button class="btn  btn-outline-danger delete-btn" href="{{ url('setting/reset') }}">RESET DATA TRANSAKSI (CATATAN PEMELIHARAAN, PERMINTAAN)</button></td>
                   </tr>
                 </table>
               </div>
             </div>
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
         {data:'nama',name:'sumber_dana.nama'},
{data:'action',name:'action'}
     
        ]
    });
});


</script>
@endpush


  