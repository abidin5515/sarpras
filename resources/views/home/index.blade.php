
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
              <h3 class="card-title" style="margin-top: 5px;">Home</h3>
              <div class="card-tools">
                {{-- <button class="btn create-btn btn-primary" data-src="{{ url('ruangan/create') }}" data-title="Tambah">+ Tambah Master Ruang</button> --}}
              </div>
            </div>
            <!-- /.box-header -->
            <div class="card-body">
                <div class="row">
                  <div class="col-lg-7">
                    <div class="col-md-12">
                      <b style="font-size: 14px; ">Permintaan Pending</b>
                    <a style="float: right;" class="btn btn-sm btn-info" href="{{ url('permintaan') }}">Selengkapnya</a>
                    <div id="permintaan-pending"></div>
                    </div>

                    <hr>

                    <div class="col-md-12">
                      <b style="font-size: 14px; ">Perbaikan Hari Ini</b>
                    <a style="float: right;" class="btn btn-sm btn-info" href="{{ url('catatan-pemeliharaan') }}">Selengkapnya</a>
                    <div id="perbaikan"></div>
                    </div>

                  </div>

                  <div class="col-md-5">
                    <div class="card shadow-sm mb-4">
                      <div class="card-header fw-bold">
                          Rekap Teknisi ({{ tgl_indo($dari) }} - {{ tgl_indo($sampai) }})
                      </div>

                      <div class="card-body">

                          {{-- FILTER --}}
                          <form method="GET" class="row g-2 mb-3">
                              <div class="col-md-4">
                                  <input type="date" name="dari" value="{{ $dari }}" class="form-control">
                              </div>
                              <div class="col-md-4">
                                  <input type="date" name="sampai" value="{{ $sampai }}" class="form-control">
                              </div>
                              <div class="col-md-4">
                                  <button class="btn btn-primary w-100">
                                      Filter
                                  </button>
                              </div>
                          </form>

                          {{-- TABEL --}}
                          <div class="table-responsive">
                              <table class="table table-bordered table-striped">
                                  <thead class="table-light">
                                      <tr>
                                          <th class="bg-dark">Nama Teknisi</th>
                                          <th class="bg-dark" class="text-center">Jumlah Perbaikan</th>
                                          <th class="bg-dark" class="text-center">Jumlah Kegiatan</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      @foreach($dataTeknisi as $t)
                                          <tr>
                                              <td>{{ $t->nama }}</td>
                                              <td class="text-center">{{ $t->jumlah_perbaikan }}</td>
                                              <td class="text-center">{{ $t->jumlah_kegiatan }}</td>
                                          </tr>
                                      @endforeach

                                      @if($dataTeknisi->isEmpty())
                                          <tr>
                                              <td colspan="3" class="text-center text-muted">
                                                  Tidak ada data
                                              </td>
                                          </tr>
                                      @endif
                                  </tbody>
                              </table>
                          </div>

                      </div>
                  </div>
                  </div>


                  


                  
                </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

         
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>

      <div class="row">
        <div class="col-lg-12">
                    <b style="font-size: 14px; ">Jadwal IPSRS</b>

                    @if ($url_jadwal)
                      <iframe width="100%" height="400px" src="{{ @$url_jadwal }}" title="W3Schools Free Online Web Tutorials"></iframe>
                    @else
                      <p class="alert alert-info">Tidak ada jadwal aktif</p>  
                    @endif

                    {{-- <img style="width: 100%" src="{{ $url_jadwal }}"> --}}
                    
                  </div>
      </div>

      </div>
      <!-- /.row -->
    </section>

    
                @endsection



@push('scripts')
<script>
  setInterval(function () {
      ambil_perbaikan();
      permintaan_pending();    
    }
    , 100000);
ambil_perbaikan();
permintaan_pending();

function ambil_perbaikan(){
  $.ajax({
      url:"perbaikan_hariini",
      method: "GET",
      dataType: "HTML",
      success:function(res){
          $("#perbaikan").html(res);
      },
      error:function(){
        // $.notify({message: 'Terjadi kesalahan'},{type: 'danger'});
      }
  })
}

function permintaan_pending(){
  $.ajax({
      url:"permintaan-pending",
      method: "GET",
      dataType: "HTML",
      success:function(res){
          $("#permintaan-pending").html(res);
      },
      error:function(){
        // $.notify({message: 'Terjadi kesalahan'},{type: 'danger'});
      }
  })
}

</script>
@endpush


