@extends('layouts.app')
@section('title')
<h1>{{@$title}}</h1>
@endsection

@section('content')
  <style type="text/css">
    td {
      font-size: 14px;
    }
    span.select2-container {
    z-index: 0;
}
  th {
    text-align: center;
  }
  td ul {
    margin: 0;
  }
  ul {
      margin: 0px;
      padding: 0px;
    }
    ul li {
      list-style: none;
    }

    .modal-dialog {
      max-width: 80%;
    }
  </style>



    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Jadwal</h3>
              <div class="card-tools">
                <a href="{{ url('jadwal/create') }}" class="btn btn-sm btn-primary" >+ TAMBAH</a> 
                
              </div>
            </div>

            <!-- /.card-header -->
            <div class="card-body">
                <div class="col-lg-6">
                  
                
                <form method="get" action="{{url('jadwal')}}">
                    {{ csrf_field() }}
                  
                  <div class="row">
                    
                    <div class="col">
                      <label>Bulan</label>
                     <select class="form-control" name="bulan" id="bulan">
                        @if ($bulan)
                          @foreach ($bulan as $key => $value)
                            <option {{(!empty($_GET['bulan']) ? ($_GET['bulan'] == $key ? 'selected' : '') : (date('m') == $key ? 'selected' : ''))}} value="{{$key}}">{{$value}}</option>
                          @endforeach
                        @endif
                      </select>
                    </div>

                     <div class="col">
                      <label>Tahun</label>
                     <select class="form-control" name="tahun" id="tahun">
                        @if ($tahun)
                          @foreach ($tahun as $key => $value)
                            <option {{(!empty($_GET['tahun']) ? ($_GET['tahun'] == $value ? 'selected' : '') : (date('Y') == $value ? 'selected' : ''))}} value="{{$value}}">{{$value}}</option>
                          @endforeach
                        @endif
                      </select>
                    </div>

                    <div class="col">
                      <button style="margin-top: 34px" type="submit" class="btn btn-sm btn-info"><i class="fas fa-filter"></i> Filter</button>
                     
                     <button style="margin-top: 34px" type="button" class="btn create-btn btn-sm btn-info btn-cetak-jadwal" data-lg="true" data-iframe="true" data-save="false"><i class="nav-icon fas fa-print"></i> Cetak</button>

                    </div>
                  </div>
                    </form>   
                    </div>         
<br>
<table border="1" class="" style="width: 100%" cellpadding="2">
  <thead>
    <tr>
      <th valign="center" width="4%" rowspan="2">NO</th>
      <th valign="center" width="20%" rowspan="2">NAMA PETUGAS</th>
      <th valign="center" colspan="4">MINGGU</th>
      <th valign="center" width="18%" rowspan="2">KETERANGAN</th>
      <th valign="center" width="10%" rowspan="2">OPSI</th>
    </tr>
    <tr>
        <th>I</th>
        <th>II</th>
        <th>III</th>
        <th>IV</th>
    </tr>
      

  </thead>

  <tbody>
    @if ($data)
    @php
      $no=1;
    @endphp
      @foreach ($data as $val)
        <tr>
          <td valign="top">{{$no++}}.</td>
          <td valign="top">{{$val->petugas->nama}}</td>
          <td valign="top">
            @php
              $detail = App\JadwalDetail::where('id_jadwal', $val->id)->where('minggu', 1)->get();
            @endphp
            @if ($detail)
             <ul>
             @foreach ($detail as $element)
               <li>{{@$element->ruangan->nama}}</li>
             @endforeach
              </ul>
            @endif
          </td>
          <td valign="top">
            @php
              $detail2 = App\JadwalDetail::where('id_jadwal', $val->id)->where('minggu', 2)->get();
            @endphp
            @if ($detail2)
             <ul>
             @foreach ($detail2 as $element)
               <li>{{@$element->ruangan->nama}}</li>
             @endforeach
              </ul>
            @endif
          </td>
          <td valign="top">
            @php
              $detail3 = App\JadwalDetail::where('id_jadwal', $val->id)->where('minggu', 3)->get();
            @endphp
            @if ($detail3)
             <ul>
             @foreach ($detail3 as $element)
               <li>{{@$element->ruangan->nama}}</li>
             @endforeach
              </ul>
            @endif
          </td>
          <td valign="top">
            @php
              $detail4 = App\JadwalDetail::where('id_jadwal', $val->id)->where('minggu', 4)->get();
            @endphp
            @if ($detail4)
             <ul>
             @foreach ($detail4 as $element)
               <li>{{@$element->ruangan->nama}}</li>
             @endforeach
              </ul>
            @endif
          </td>
          <td valign="top">{{$val->keterangan}}</td>
          <td valign="top">
            <a href="{{url('jadwal/'.$val->id)}}/edit" class="btn btn-sm btn-info">Ubah</a>
            <button data-reload="true" class="btn btn-sm btn-danger delete-btn" href="{{ url('jadwal/'.$val->id) }}/destroy">Hapus</button>
          </td>
        </tr>
      @endforeach
    @endif
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

  var bulan = $("#bulan").val();
  var tahun = $("#tahun").val();
  ubah_url(bulan, tahun);

  function ubah_url(bulan, tahun) {
    var url = '{{ url('jadwal/cetak?bulan=') }}'+bulan+'&tahun='+tahun;
    $(".btn-cetak-jadwal").attr('data-src', url);
  }


  $(document).on('change', '#bulan', function(){
      var bulan = $(this).val();
      var tahun = $("#tahun").val();
      ubah_url(bulan, tahun);
  });

  $(document).on('change', '#tahun', function(){
      var bulan = $("#bulan").val();
      var tahun = $(this).val();
      ubah_url(bulan, tahun);
  });
</script>
@endpush


