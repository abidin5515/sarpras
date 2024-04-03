

@extends('layouts.app')
@section('title')
<h1>{{@$title}}</h1>
@endsection

@section('content')

  <style type="text/css">
    /*td {
      font-size: 14px;
    }*/
     span.select2-container {
    z-index: 0;
}

  table td {
    padding: 0;
    font-size: 11px;
  }
  </style>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title data_ceklis_title">Data Ceklis</h3>
              <div class="card-tools">

                {{-- <form class="form-filter" action="{{ url('data_ceklis') }}" method="get">
                   <label>Tanggal</label>
                   <input type="date" name="tanggal" id="filter-tanggal" value="{{ @$tanggal }}"> 
                </form> --}}

              </div>

            </div>
            <!-- /.card-header -->
            <div class="card-body">
              
                    
{{-- <div class="col-md-6 row">
  <form action="{{url('data_ceklis/updateKepala')}}" method="post" id="form" class="form" style="width: 100%">
    <div class="form-group row">
      <label class="col-sm-3 col-form-label">set Kepala</label>
      <div class="col-sm-6">
      <select class="form-control select2" name="id_petugas" data-url="{{ url('data_ceklis/select2') }}">
        @if ($kepala != NULL)
          <option value="{{$kepala->id}}">{{$kepala->nama}}</option>
        @endif
        </select>
      </div>
      <div class="col-sm-3">
        <button class="btn btn-sm btn-primary save-btn">Simpan</button>
      </div>
    </div>
    </form>
</div>
  
 <hr>                 
 --}}

 <div class="row">
  <form style="margin-right: 10px" class="form-filter" action="{{ url('data_ceklis') }}" method="get">
    <label>Tanggal</label>
    <input class="form-control" type="date" name="tanggal" id="filter-tanggal" value="{{ @$tanggal }}"> 
 </form>
  <form class="form-cari-shift" action="" method="get">
    <label>Pilih Shift</label>
    <select name="shift" id="pilih-shift" class="form-control">
      <option value="">-- Pilih Shift --</option>
      <option value="1">Shift Pagi</option>
      <option value="2">Shift Siang</option>
      <option value="3">Shift Malam</option>
    </select>
 </form>
</div> 
 <div class="row"> 

  <div class="col-md-6 shift-1" style="display: none">
      <table style="margin-top: 10px" class="" style="font-size: 11px;" width="100%">
        <thead>
          <th>Shift Pagi</th>

        </thead>

        <tbody>
            <tr>
              <td>
                <table width="100%">
                    <tr>
                      <th>Ceklis</th>
                      <th>Jumlah</th>
                      <th>Catatan</th>
                    </tr>
                  @foreach(@$master_ceklis as $m)
                    <tr>
                      <td>{{ @$m->nama_ceklis }}</td>
                      <td><input size="8" data-shift="1" data-id="{{ @$m->id }}" data-tipe="jumlah" class="edit" type="text" name="" value="{{ @$datanya[$m->id][1]['jumlah'] }}"></td>
                      <td><input data-shift="1" data-id="{{ @$m->id }}" class="edit" size="" type="text" data-tipe="keterangan" name="" value="{{ @$datanya[$m->id][1]['keterangan'] }}"></td>
                    </tr>
                  @endforeach
                </table>
              </td>

            </tr>
        </tbody>
      </table>
  </div>

  <div class="col-md-6 shift-2" style="display: none">
    <table style="margin-top: 10px" class="" style="font-size: 11px;" width="100%">
        <thead>
          <th>Shift Siang</th>

        </thead>

        <tbody>
            <tr>
              <td>
                <table width="100%">
                    <tr>
                      <th>Ceklis</th>
                      <th>Jumlah</th>
                      <th>Catatan</th>
                    </tr>
                  @foreach(@$master_ceklis as $m)
                    <tr>
                      <td>{{ @$m->nama_ceklis }}</td>
                      <td><input size="8" data-shift="2" data-id="{{ @$m->id }}" data-tipe="jumlah" class="edit" type="text" name="" value="{{ @$datanya[$m->id][2]['jumlah'] }}"></td>
                      <td><input data-shift="2" data-id="{{ @$m->id }}" class="edit" size="" type="text" data-tipe="keterangan" name="" value="{{ @$datanya[$m->id][2]['keterangan'] }}"></td>
                    </tr>
                  @endforeach
                </table>
              </td>

            </tr>
        </tbody>
    </table>
  </div>

  <div class="col-md-6 shift-3" style="display: none">
    <table style="margin-top: 10px" class="" style="font-size: 11px;" width="100%">
        <thead>
          <th>Shift Malam</th>

        </thead>

        <tbody>
            <tr>
              <td>
                <table width="100%">
                    <tr>
                      <th>Ceklis</th>
                      <th>Jumlah</th>
                      <th>Catatan</th>
                    </tr>
                  @foreach(@$master_ceklis as $m)
                    <tr>
                      <td>{{ @$m->nama_ceklis }}</td>
                      <td><input size="8" data-shift="3" data-id="{{ @$m->id }}" data-tipe="jumlah" class="edit" type="text" name="" value="{{ @$datanya[$m->id][3]['jumlah'] }}"></td>
                      <td><input data-shift="3" data-id="{{ @$m->id }}" class="edit" size="" type="text" data-tipe="keterangan" name="" value="{{ @$datanya[$m->id][3]['keterangan'] }}"></td>
                    </tr>
                  @endforeach
                </table>
              </td>

            </tr>
        </tbody>
    </table>
  </div>

 </div>


 <div class="table table-responsive">

</div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

         
          <!-- /.card -->
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
        ajax: '{!! route("data_ceklis.json") !!}',
        columns: [
        {data: 'DT_RowIndex', searchable: false, orderable: false},
        {data:'tanggal',name:'data_ceklis.tanggal'},
        {data:'ceklis',name:'data_ceklis.ceklis'},
        {data:'shif',name:'data_ceklis.shif'},
        {data:'jumlah',name:'data_ceklis.jumlah'},
        {data:'keterangan',name:'data_ceklis.keterangan'},
        {data:'action',name:'action'}
     
        ]
    });
});

$(document).on('change', '#filter-tanggal', function(){
  $(".form-filter").submit();
});

$(document).on('change', '#pilih-shift', function(){
   var valuenya = $(this).val();
   var target = '.shift-'+valuenya;
   if(valuenya == '1'){
    $(target).show();
    $('.shift-2').hide();
    $('.shift-3').hide();
  }
  if(valuenya == '2'){
    $(target).show();
    $('.shift-1').hide();
    $('.shift-3').hide();
  }
  if(valuenya == '3'){
    $(target).show();
    $('.shift-1').hide();
    $('.shift-2').hide();
  }
});


</script>
@endpush


