
@extends('layouts.app')


@section('content')
 <style type="text/css">
 	span.select2-container {
    z-index: 0;
}
 </style>

    <!-- Main content -->
    <section class="content">
    	<div class="card">
            <div class="card-header">
              <h3 class="card-title">Input Hasil Peninjauan</h3>
            </div>
            <!-- /.box-header -->
            <div class="card-body">
            	
      <div class="container-fluid">
        <form style="width: 100%" action="{{url("permintaan-pelayanan/updateTinjauan")}}" method="post" id="form" enctype="multipart/form-data">

		{{csrf_field()}}
		<input type="hidden" name="id" value="{{$data->id}}">
		<input type="hidden" name="id_permintaan_pelayanan" value="{{Request::segment(2)}}">
		<div class="col-lg-12">
			<div class="row">
				<div class="col-md-6">
					<fieldset>
					  	{{-- <legend></legend> --}}
						<div class="form-group row">
						<label class="col-sm-4 col-form-label">Oleh Instalasi Alkes</label>
						<div class="col-sm-7">
						<textarea class="form-control" name="oleh_instalasi_alkes" rows="3">{{@$data->oleh_instalasi_alkes}}</textarea>
						</div>
						</div>

						<div class="form-group row">
						<label class="col-sm-4 col-form-label">Oleh Seksi Penunjang Non Medik</label>
						<div class="col-sm-7">
							<textarea class="form-control" name="oleh_seksi_penunjang" rows="3">{{@$data->oleh_seksi_penunjang_non_medik}}</textarea>
						</div>
						
						</div>


							
					</fieldset>
					
				</div>

				<div class="col-md-6">
					<fieldset>
						{{-- <legend>Administratif Information:</legend> --}}
						
					

						<div class="form-group row">
						<label class="col-sm-4 col-form-label">Kesimpulan</label>
						<div class="col-sm-7">
						<input {{(@$data->kesimpulan == 'bisa' ? 'checked' : '')}} type="radio" name="kesimpulan" value="bisa"> Alat bisa diperbaiki
						<br>
						<input {{(@$data->kesimpulan == 'tidak' ? 'checked' : '')}} type="radio" name="kesimpulan" value="tidak"> Alat tidak bisa diperbaiki
						<div class="row">
							<label>Alasannya:</label>
						<textarea class="form-control" name="kesimpulan_alasan">{{@$data->alasan_kesimpulan}}</textarea>
						</div>
						</div>
						</div>

						<div class="form-group row">
						<label class="col-sm-4 col-form-label">Diperbaiki Oleh</label>
						<div class="col-sm-7">
						<select class=" form-control" name="diperbaiki_oleh" id="diperbaiki_oleh">
							<option value="">-- Pilih --</option>
							<option {{(@$data->alat_diperbaiki_oleh == '1' ? 'selected' : '')}} value="1">Instalasi Alkes</option>
							<option {{(@$data->alat_diperbaiki_oleh == '2' ? 'selected' : '')}} value="2">Pihak Ketiga</option>
						</select>
						<div id="form-diperbaiki"></div>
						</div>
						</div>					
					</fieldset>
				</div>

				
			</div>
			<hr>
			<div class="row">
				<div class="col-md-6">
					<fieldset >
						<legend>Proses Perbaikan</legend>
						<div class="form-group row">
						<label class="col-sm-4 col-form-label">RAB</label>
						<div class="col-sm-7">
							<input type="text" class="form-control" name="rab" value="{{@$data->rab}}">
						</div>
						</div>

						<div class="form-group row">
						<label class="col-sm-4 col-form-label">Tanggal</label>
						<div class="col-sm-7">
							<input type="date" class="form-control" name="proses_perbaikan_tanggal" value="{{@$data->proses_perbaikan_tanggal}}">
						</div>
						</div>

						<div class="form-group row">
						<label class="col-sm-4 col-form-label">Mulai dikerjakan</label>
						<div class="col-sm-7">
							<input type="date" class="form-control" name="mulai_dikerjakan" value="{{@$data->mulai_dikerjakan}}">
						</div>
						</div>

						<div class="form-group row">
						<label class="col-sm-4 col-form-label">Perkiraan Selesai</label>
						<div class="col-sm-7">
							<input type="date" class="form-control" name="perkiraan_selesai" value="{{@$data->perkiraan_selesai}}">
						</div>
						</div>

						{{-- <div class="form-group row">
						<label class="col-sm-4 col-form-label">Pelaksanaan Swakelola</label>
						<div class="col-sm-7">
							<input type="text" class="form-control" name="pelaksanaan_swakelola" value="{{@$data->pelaksanaan_swakelola}}">
						</div>
						</div> --}}
					</fieldset>
				</div>
				<div class="col-md-6">
					<fieldset >
						<legend>Hasil Akhir</legend>
						<div class="form-group row">
						<label class="col-sm-4 col-form-label">Uji Fungsi</label>
						<div class="col-sm-7">
							<input type="text" class="form-control" name="uji_fungsi" value="{{@$data->uji_coba}}">
						</div>
						</div>

						<div class="form-group row">
						<label class="col-sm-4 col-form-label">Kondisi Akhir</label>
						<div class="col-sm-7">
							<input type="text" class="form-control" name="kondisi_akhir" value="{{@$data->kondisi_akhir}}">
						</div>
						</div>

						<div class="form-group row">
						<label class="col-sm-4 col-form-label">Waktu Jaminan</label>
						<div class="col-sm-7">
							<input type="text" class="form-control" name="waktu_jaminan" value="{{@$data->waktu_jaminan}}">
						</div>
						</div>

						<div class="form-group row">
						<label class="col-sm-4 col-form-label">Catatan Tambahan</label>
						<div class="col-sm-7">
							<textarea class="form-control" name="catatan_tambahan">{{@$data->catatan_tambahan}}</textarea>
						</div>
						</div>

						
					</fieldset>
				</div>
			</div>

		</div>
		</form>
	      <div class="row">
	      	<div class="col-lg-12">
	      		<button type="submit" data-redirect="true" data-redirect-to="{{ url('permintaan-pelayanan') }}" class="btn btn-primary save-btn"> SIMPAN</button>
	      		<a href="{{url('permintaan-pelayanan')}}" class="btn btn-danger"> BATAL</a>
	      	</div>
	      	
	      </div>  
      </div><!-- /.container-fluid -->
            </div>
        </div>

    </section>
    <!-- /.content -->

@endsection
@push('scripts')
<script>
	$("#diperbaiki_oleh").on('change', function(){
		var id = $(this).val();
		if(id != ''){
			$.ajax({
		      url: '{{ url('get-form') }}/'+id,
		      type: 'GET',
		      dataType: 'HTML',
		      // data: form,
		      success:function(res){
		        // alert(res);
		        $("#form-diperbaiki").html(res);
		        select2Load();
		      }
		    });
		}else {
			$("#form-diperbaiki").html('');
		}
	});

	var diperbaiki_oleh = '{{@$data->alat_diperbaiki_oleh}}';
	var id_tinjau = '{{@$data->id}}';

	getForm(diperbaiki_oleh, id_tinjau);
	function getForm(id, id_tinjau){
		if(id != ''){
			$.ajax({
		      url: '{{ url('get-form') }}/'+id,
		      type: 'GET',
		      dataType: 'HTML',
		      data: {id_tinjau : id_tinjau},
		      success:function(res){
		        // alert(res);
		        $("#form-diperbaiki").html(res);
		        select2Load();
		      }
		    });
		}else {
			$("#form-diperbaiki").html('');
		}
	}
		
</script>
@endpush