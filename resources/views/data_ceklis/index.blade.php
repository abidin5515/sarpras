

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

                <form class="form-filter" action="{{ url('data_ceklis') }}" method="get">
                   <label>Tanggal</label>
                   <input type="date" name="tanggal" id="filter-tanggal" value="{{ @$tanggal }}"> 
                </form>

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

  <div class="col-md-4">
      <table style="margin-top: 10px" class="" style="font-size: 11px;" width="100%">
        <thead>
          <th>Shift 1</th>

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
                      <td><input data-shift="1" data-id="{{ @$m->id }}" class="edit" size="15" type="text" data-tipe="keterangan" name="" value="{{ @$datanya[$m->id][1]['keterangan'] }}"></td>
                    </tr>
                  @endforeach
                </table>
              </td>

            </tr>
        </tbody>
      </table>
  </div>

  <div class="col-md-4">
    <table style="margin-top: 10px" class="" style="font-size: 11px;" width="100%">
        <thead>
          <th>Shift 2</th>

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
                      <td><input data-shift="2" data-id="{{ @$m->id }}" class="edit" size="15" type="text" data-tipe="keterangan" name="" value="{{ @$datanya[$m->id][2]['keterangan'] }}"></td>
                    </tr>
                  @endforeach
                </table>
              </td>

            </tr>
        </tbody>
    </table>
  </div>

  <div class="col-md-4">
    <table style="margin-top: 10px" class="" style="font-size: 11px;" width="100%">
        <thead>
          <th>Shift 3</th>

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
                      <td><input data-shift="3" data-id="{{ @$m->id }}" class="edit" size="15" type="text" data-tipe="keterangan" name="" value="{{ @$datanya[$m->id][3]['keterangan'] }}"></td>
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


</script>
@endpush


