
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
              <h3 class="card-title">Rekap Perbaikan</h3>
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

                <button data-iframe="true" class="btn create-btn btn-primary btn-sm" style="margin-left: 10px;" data-src="{{ url('rekap/perbaikan/pdf?tahun='.Request::get('tahun')) }}" data-lg="true" data-save="false" data-title="Cetak Rekap"><i class="fas fa-print"></i> CETAK</button>
                  </div>

                </div>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              
                     
      <div class="table-responsive">
                

<table class="table table-striped" id="table">
  <thead>
    <th>NO</th>
    <th>Tanggal</th>
    <th>No Laporan</th>
     <th>Ruang</th>
     <th>Pelapor</th>
     <th>Alat</th>
     <th>Keluhan</th>
     <th>No STP</th>
     <th>Tanggal Perbaikan</th>
     <th>Tindakan</th>
     <th>Suku Cadang</th>
     <th>Selesai Dikerjakan</th>
     <th>Petugas</th>
  </thead>

  <tbody>
  </tbody>
</table>
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
        ajax: '{!! route("rekap.perbaikanData",'rekap=perbaikan&tahun='.Request::get('tahun')) !!}',
        columns: [
         {data:'DT_RowIndex',name:'DT_RowIndex',orderable:false,searchable:false},
          {data:'tanggal',name:'catatan_pemeliharaan.tanggal'},
          {data:'nomor',name:'catatan_pemeliharaan.nomor'},
          {data:'ruangan_nama',name:'ruangan.nama'},
          {data:'nama_pemesan',name:'perbaikan.nama_pemesan'},
          {data:'nama',name:'alat.nama'},    
          {data:'keluhan',name:'catatan_pemeliharaan.keluhan'},   
          {data:'nomor_perbaikan',name:'perbaikan.nomor'},      
          {data:'perbaikan_tanggal',name:'perbaikan.tanggal'},      
          {data:'tindakan',name:'catatan_pemeliharaan.tindakan'},      
          {data:'suku_cadang',name:'perbaikan.suku_cadang'},      
          {data:'selesai_dikerjakan',name:'perbaikan.selesai_dikerjakan '},      
          {data:'nama_teknisi',name:'teknisi.nama '}       
        ]
    });
});


</script>
@endpush


