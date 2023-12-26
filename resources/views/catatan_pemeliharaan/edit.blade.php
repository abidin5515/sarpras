
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
              <h3 class="card-title">Ubah Catatan Perbaikan</h3>
              <div class="card-tools">
                <a class="btn btn-warning" href="{{ URL::previous() }}"><i class="fas fa-arrow-left" ></i> KEMBALI</a>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form action="{{ url('catatan-pemeliharaan/'.$data->id) }}" id="form" enctype="multipart/form-data">
                    {{method_field("PUT")}}

                @if ($data->id_permintaan!=null)
                    <input type="hidden" name="id_permintaan" value="{{ @$data->permintaan->id }}">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-warning">
                            <b style="font-size: 14px">Mengerjakan Permintaan : </b>
                             <table class="bg-warning" width="300px">
                                 <tr>
                                     <th>Permasalahan </th>
                                     <td>:</td>
                                     <td>{{ @$data->permintaan->masalah }}</td>
                                 </tr>

                                 <tr>
                                     <th>Lantai </th>
                                     <td>:</td>
                                     <td>{{ @$data->permintaan->lantai }}</td>
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
                            <input type="date" name="tanggal" class="form-control tanggal" value="{{@$data->tanggal}}">
                        </div>
                        <div class="form-group">
                            <label>Perbaikan / Pekerjaan</label>
                            <input type="text" name="perbaikan" class="form-control perbaikan" value="{{@$data->perbaikan}}">
                        </div>
                        <div class="form-group">
                            <label>Jam Mulai</label>
                            <input type="time" name="jam_mulai" class="form-control jam_mulai" value="{{@$data->jam_mulai}}">
                        </div>
                        <div class="form-group">
                            <label>Jam Selesai</label>
                            <input type="time" name="jam_selesai" class="form-control jam_selesai" value="{{@$data->jam_selesai}}">

                        </div>
                        <div class="form-group">
                            <label>Lokasi</label>
                            <input type="text" name="lokasi" class="form-control lokasi" value="{{@$data->lokasi}}">
                        </div>

                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-control" name="status">
                                <option value="">Status</option>
                                <option {{ ($data->status == "selesai" ? 'selected' : '') }} value="selesai">Selesai</option>
                                <option {{ ($data->status == "pending" ? 'selected' : '') }} value="pending">Pending</option>
                            </select>
                        </div>

                        <br>

                    <br>
                    </div>

                    <div class="col-lg-6">

                         <div class="form-group">
                            <label>Keterangan</label>
                            <textarea class="form-control" name="keterangan">{{ @$data->keterangan }}</textarea>
                        </div>

                        <div class="form-group">
                            <label>Biaya</label>
                            <input type="number" name="biaya" class="form-control" value="{{ @$data->biaya }}">
                        </div>

                        <div class="form-group">
                            <label>Foto</label>
                            <br>
                            <img width="300" src="{{ asset($data->foto) }}">
                            <input type="file" name="foto" class="form-control" value="{{ ($data->foto != null ? $data->foto : '') }}">
                        </div>

                        {{-- <div class="form-group">
                            <label>Teknisi <a href="{{ url('teknisi') }}">(<u>Lihat Master Teknisi Disini</u>)</a></label>

                            <select class='form-control select2 ruangan' data-url='{{url('teknisi/select2')}}' name='id_teknisi'>
                                @if ($data->id_teknisi)
                                    <option value="{{@$data->id_teknisi}}">{{ $data->teknisi->nama }}</option>
                                @endif
                            </select>
                        </div> --}}
                        
                        <div class="form-group">
                            {{-- @php
                                print_r($teknisi_data);
                            @endphp --}}
                            <label>Teknisi <a href="{{ url('teknisi') }}">(<u>Lihat Master Teknisi Disini</u>)</a></label><br>
                            @foreach ($teknisi as $r)
                                <input type="checkbox" {{ (in_array($r->id, $teknisi_data) ? 'checked' : '') }} class="" name="id_teknisi[]" value="{{$r->id}}"> {{ $r->nama }}
                                <br>
                            @endforeach
                        </div>

                    </div>

                        <button data-redirect="true" data-redirect-to="{{ route('catatan-pemeliharaan.index') }}" class="btn btn-primary save-btn">Simpan</button>

                        <a style="margin-left: 10px;" class="btn btn-warning" href="{{ URL::previous() }}"><i class="fas fa-arrow-left" ></i> KEMBALI</a>
                    </div>
                   
                </div>
            </form>
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
    // $(".alat").val('11').trigger('change');
    

	$(document).on('change', '.alat', function() {
		// event.preventDefault();
        var value = $(this).val();
		var adds = $(this).attr('data-additional');
		// alert(adds);
        var parse = JSON.parse(adds);

        console.log("XXXX");
        $.each(parse, function(index, val) {
            $("."+index).val(val);
             /* iterate through array or object */
        });


        // console.log(parse);
            // load_checklist(parse.id_alat);
        
        // var pec
        // console.log(JSON.parse(adds));
		/* Act on the event */
	});


    load_ok($(".tahun").val(),$(".alat").val());
  $(document).on('change', '.tahun', function() {
        // event.preventDefault();
        var value = $(this).val();

        load_ok(value,$(".alat").val());
        // var pec
        // console.log(JSON.parse(adds));
        /* Act on the event */
    });

    // $(".tahun").trigger('change');
function load_ok(value,alat){
        var alkes  = alat
        var jenis_pekerjaan = $(".jenis_pekerjaan").val();
        
        $.get("{{ url('catatan-pemeliharaan/getChecklist') }}?edit=true&id={{$data->id}}&tahun="+value+"&alkes="+alkes+"&jenis_pekerjaan="+jenis_pekerjaan,function(res){
                $(".wrap-results").html(res.view);
                // console.log(res);
                $(".new").val(res.new);
                select2Load();
                
        });
        
}
$.ajax({
    url: '{{ route('catatan-pemeliharaan.getChecklist') }}',
    type: 'GET',
    dataType: 'JSON',
    data: {id: '{{$data->id}}'},
})
.done(function(res) {
    if(res.success){
        // console.log(res);
        for (var i = 0; i < res.data.length; i++) {
            var data = res.data[i];
            var status = data.status;
            var idne = data.id_checklist;
            var id = data.id;

            if(status=='1'){
            $("input[name='checklist["+idne+"]'][value=on]").attr({
                checked: 'checked',
                name: "checklist["+idne+"_"+id+"]"
            });


          $("input[name='checklist["+idne+"]']").attr({
                // checked: 'checked',
                name: "checklist["+idne+"_"+id+"]"
            });
          console.log("MANTA");

// .attr('checked', 'checked');
    
            }else{
                if(status=='2'){


  $("input[name='checklist["+idne+"]'][value=off]").attr({
                checked: 'checked',
                name: "checklist["+idne+"_"+id+"]"
            });




  $("input[name='checklist["+idne+"]']").attr({
                // checked: 'checked',
                name: "checklist["+idne+"_"+id+"]"
            });





                }
            }


        }
    }
    console.log("success");
})
.fail(function() {
    console.log("error");
})
.always(function() {
    console.log("complete");
});


// $(".alat").trigger('change');
    var v = $('.pelaksana option:selected').attr('data-value');
// var v = 
getCatatanForm($(".pelaksana").val(),v);

$(document).on('change', '.pelaksana', function() {
    // event.preventDefault();
    var val = $(this).val();
    var v = $('option:selected', this).attr('data-value');

    getCatatanForm(val,v);
    
    /* Act on the event */
});


function getCatatanForm(id,val){
    // alert(id);
         $.get("{{ url('catatan-pemeliharaan/form') }}?type="+id+"&val="+val+"&id={{$data->id}}",function(res){
        $(".pelaksana_result").html(res);

        select2Load();

    })
    }


    $(document).on('change', '.teknisi', function() {
        // event.preventDefault();

        var adds = $(this).attr('data-additional');
        var target = $(this).attr('data-target');
        // alert(adds);
        var parse = JSON.parse(adds);

        // console.log(parse);
        $("."+target).show();

        $("."+target).attr('src',"{{ url('/') }}/"+parse.ttd);
        $(".ttd-"+target).val(parse.ttd);
        $(".id-"+target).val($(this).val());

        /* Act on the event */
    });
</script>
	{{-- expr --}}
@endpush
