
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
              <h3 class="card-title">Rekap Kalibrasi</h3>
              <div class="card-tools">

                <div class="input-group input-group-sm">
                 
                  <form action="">
                     <select class="form-control" onchange="this.form.submit()" name="tahun">
                    <option value="">Filter Tahun</option>
                    @foreach ($getRangeYear as $year)
                      {{-- expr --}}
                      <option {{Request::get('tahun')==$year?'selected':''}} value="{{$year}}">{{$year}}</option>
                    @endforeach
                  </select>
                  </form>
                  <div class="input-group-append">

                <button data-iframe="true" class="btn create-btn btn-primary btn-sm" style="margin-left: 10px;" data-src="{{ url('rekap/kalibrasi/pdf?tahun='.Request::get('tahun')) }}" data-lg="true" data-save="false" data-title="Cetak Rekap"><i class="fas fa-print"></i> CETAK</button>
                  </div>

                </div>


              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              
                     @php
                       
// print_r($getRangeYear);


                     @endphp
              

<table class="table table-striped" id="table">
  <thead>
     <th>No</th>
     <th>Nama Alkes</th>
     <th>Merk</th>
     <th>Model/Type</th>
     <th>No.Seri</th>
     <th>Tempat Alat</th>
     <th>Tanggal</th>
     <th>PT</th>

  
  

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
        ajax: '{!! route("rekap.data","rekap=kalibrasi&tahun=".Request::get('tahun')) !!}',
        columns: [
         {data:'DT_RowIndex',name:'DT_RowIndex',orderable:false,searchable:false},
          {data:'nama',name:'alat.nama'},
          {data:'merk',name:'data_alkes.merk'},
          {data:'tipe',name:'data_alkes.tipe'},
          {data:'nomor_seri',name:'data_alkes.nomor_seri'},    
          {data:'ruangan_nama',name:'ruangan.nama'},   
          {data:'tanggal',name:'tanggal'},      
          {data:'vendor',name:'supplier.nama '}       
        ]
    });
});


</script>
@endpush


