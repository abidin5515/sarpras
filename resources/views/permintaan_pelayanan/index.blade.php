
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
              <h3 class="card-title">Permintaan Pelayanan</h3>
              <div class="card-tools">
                <a class="btn  btn-primary" href="{{ url('permintaan-pelayanan/create') }}" data-title="Tambah">+ Tambah</a>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              
                     
              
                     <div class="table-responsive">
                       
<table class="table table-striped" id="table">
  <thead>
     <th>Ruangan</th>
<th>Kerusakan Alat</th>
<th>Alat</th>
<th>Merk</th>
<th>No Seri</th>

<th>Tanggal Ajuan</th>
<th>Batas Waktu Pengajuan</th>
{{-- <th>lain_lain</th> --}}
<th>Kerusakan Awal</th>
{{-- <th>data_kerusakan_tanggal</th> --}}
<th>Opsi Kerusakan</th>
<th>Ditinjau</th>
{{-- <th>catatan_tambahan</th> --}}

  
  
    <th>Opsi</th>

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
    </section>

    
                @endsection



@push('scripts')
<script>

$(function() {
    $('#table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route("permintaan_pelayanan.json") !!}',
        columns: [
         {data:'ruangan_nama',name:'ruangan.nama'},
{data:'kerusakan_alat',name:'permintaan_pelayanan.kerusakan_alat'},
{data:'nama_alat',name:'alat.nama'},
{data:'merk',name:'permintaan_pelayanan.merk'},
{data:'no_seri',name:'permintaan_pelayanan.no_seri'},
{data:'tanggal_ajuan',name:'permintaan_pelayanan.tanggal_ajuan'},
{data:'batas_waktu_perbaikan',name:'permintaan_pelayanan.batas_waktu_perbaikan'},

// {data:'lain_lain',name:'permintaan_pelayanan.lain_lain'},
{data:'kerusakan_awal',name:'permintaan_pelayanan.kerusakan_awal'},
// {data:'data_kerusakan_tanggal',name:'permintaan_pelayanan.data_kerusakan_tanggal'},
{data:'opsi_kerusakan',name:'permintaan_pelayanan.opsi_kerusakan'},
{data:'status',name:'status'},
{data:'action',name:'action'}
     
        ]
    });
});


</script>
@endpush


