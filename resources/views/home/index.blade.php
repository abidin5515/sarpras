
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
                  <div class="col-lg-5">
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
                  <div class="col-lg-7">
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
  setInterval(function () {
      ambil_perbaikan();
      permintaan_pending();    
    }
    , 100000);
ambil_perbaikan();
permintaan_pending();

function ambil_perbaikan(){
  $.ajax({
      url:"{{ url('perbaikan_hariini') }}",
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
      url:"{{ url('permintaan-pending') }}",
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


