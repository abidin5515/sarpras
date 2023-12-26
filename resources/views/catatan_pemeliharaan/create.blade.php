

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
              <h3 class="card-title">Tambah Catatan Perbaikan</h3> 
              <div class="card-tools">
                <a class="btn btn-warning" href="{{ URL::previous() }}"><i class="fas fa-arrow-left" ></i> KEMBALI</a>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form action="{{ url('catatan-pemeliharaan') }}" id="form" enctype="multipart/form-data">
            	
                @if ($permintaan!=null)
                    <input type="hidden" name="id_permintaan" value="{{ @$permintaan->id }}">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-warning">
                            <b style="font-size: 14px">Mengerjakan Permintaan : </b>
                             <table class="bg-warning" width="300px">
                                 <tr>
                                     <th>Ruang </th>
                                     <td>:</td>
                                     <td>{{ @$permintaan->ruangan->nama }}</td>
                                 </tr>

                                 <tr>
                                     <th>Permasalahan </th>
                                     <td>:</td>
                                     <td>{{ @$permintaan->masalah }}</td>
                                 </tr>

                                 <tr>
                                     <th>Lantai </th>
                                     <td>:</td>
                                     <td>{{ @$permintaan->lantai }}</td>
                                 </tr>
                             </table> 
                         </div>
                        </div>   
                    </div>
                @endif


                <div class="row">
            		<div class="col-lg-6">
            			<div class="form-group">
                            <label>Tanggal</label>
                            <input type="date" name="tanggal" class="form-control tanggal" value="{{ date('Y-m-d') }}">
                        </div>
                        <div class="form-group">
            				<label>Perbaikan / Pekerjaan</label>
                            <input type="text" name="perbaikan" class="form-control perbaikan" value="">
            			</div>
            			<div class="form-group">
            				<label>Jam Mulai</label>
            				<input type="time" name="jam_mulai" class="form-control jam_mulai" value="">
            			</div>
            			<div class="form-group">
            				<label>Jam Selesai</label>
            				<input type="time" name="jam_selesai" class="form-control jam_selesai" value="">

            			</div>
                        <div class="form-group">
                            <label>Lokasi</label>
                            <input type="text" name="lokasi" class="form-control lokasi" value="">
                        </div>

                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-control" name="status">
                                <option value="">Status</option>
                                <option value="selesai">Selesai</option>
                                <option value="pending">Pending</option>
                            </select>
                        </div>
            			{{-- <div class="form-group">
            				<label>No. Seri</label>
            				<input type="text" name="no_seri" class="form-control nomor_seri"  readonly="" value="">
                            <input type="hidden" name="id_alat" class="id_alat" value="">
            			</div> --}}
                                             <br>

                    <br>
            		</div>

            		<div class="col-lg-6">
                        <div class="form-group">
                            <label>Keterangan</label>
                            <textarea class="form-control" name="keterangan"></textarea>
                        </div>

                        <div class="form-group">
                            <label>Biaya</label>
                            <input type="number" name="biaya" class="form-control">
                        </div>
            		   

            			<div class="form-group">
            				<label>Foto</label>
            				<input type="file" name="foto" class="form-control" >
            			</div>

                        {{-- <div class="form-group">
                            <label>Teknisi <a href="{{ url('teknisi') }}">(<u>Lihat Master Teknisi Disini</u>)</a></label>

                            <select class='form-control select2 ruangan' data-url='{{url('teknisi/select2')}}' name='id_teknisi'></select>
                        </div> --}}

                        <div class="form-group">
                            <label>Teknisi <a href="{{ url('teknisi') }}">(<u>Lihat Master Teknisi Disini</u>)</a></label><br>
                            @foreach ($teknisi as $r)
                                <input type="checkbox" class="" name="id_teknisi[]" value="{{$r->id}}"> {{ $r->nama }}
                                <br>
                            @endforeach
                            {{-- <input type="" name="">     --}}
                        </div>

            		</div>
                   
            	</div>
            </form>
            <button data-redirect="true" data-redirect-to="{{ route('catatan-pemeliharaan.index') }}" class="btn btn-primary save-btn">Simpan</button>

            <a class="btn btn-warning" href="{{ URL::previous() }}"><i class="fas fa-arrow-left" ></i> KEMBALI</a>
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
<script type="text/javascript">
	// alert("x");

    $(document).on('change', '.alat', function() {
        var adds = $(this).attr('data-additional');
        // alert(adds);
        var parse = JSON.parse(adds);



        $.each(parse, function(index, val) {
            $("."+index).val(val);
             /* iterate through array or object */
        });

        /* Act on the event */
    });
	$(document).on('change', '.tahun', function() {
		// event.preventDefault();
      
            // loadForm();
        // var pec
        // console.log(JSON.parse(adds));
		/* Act on the event */
	});
            // loadForm();

    // function loadForm(){
    //       var value = $(".tahun").val();

    //     var alkes  = $(".alat").val();
    //     var jenis_pekerjaan = $(".jenis_pekerjaan").val();
        
    //     $.get("{{ url('catatan-pemeliharaan/getChecklist') }}?tahun="+value+"&alkes="+alkes+"&jenis_pekerjaan="+jenis_pekerjaan+"&permintaan_pelayanan={{Request::get('permintaan_pelayanan')}}",function(res){
    //             $(".wrap-results").html(res.view);
    //             select2Load();
    //     });


       

    // }
    // $(document).on('change', '.teknisi', function() {
    //     // event.preventDefault();

    //     var adds = $(this).attr('data-additional');
    //     var target = $(this).attr('data-target');
    //     // alert(adds);
    //     var parse = JSON.parse(adds);

    //     // console.log(parse);
    //     $("."+target).show();

    //     $("."+target).attr('src',"{{ url('/') }}/"+parse.ttd);
    //     $(".ttd-"+target).val(parse.ttd);

    //     /* Act on the event */
    // });

$(document).on('change', '.pelaksana', function() {
    // event.preventDefault();
    var val = $(this).val();
    // alert("X");
    $.get("{{ url('catatan-pemeliharaan/form') }}?type="+val,function(res){
        $(".pelaksana_result").html(res);

        select2Load();

    })
    /* Act on the event */
});
</script>
	{{-- expr --}}
@endpush
