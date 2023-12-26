
@extends('layouts.app')


@section('content')
 

    <!-- Main content -->
    <section class="content">
    	<div class="card">
            <div class="card-header">
              <h3 class="card-title">Edit Alat</h3>
            </div>
            <!-- /.box-header -->
            <div class="card-body">
            	
      <div class="container-fluid">
        <form style="width: 100%" action="{{url("data-alkes/".Request::segment(2)."/update")}}" method="post" id="form" enctype="multipart/form-data">

		{{csrf_field()}}

		<div class="col-lg-12">
			<div class="row">
				<div class="col-md-6">
					<fieldset>
					  <legend>Equipment Profile:</legend>
						
						{{-- <div class="form-group row">
						<label class="col-sm-4 col-form-label">Kode Alat</label>
					    <div class="col-sm-7">
					      <input type="text" class="form-control" name="kode_alat">
					    </div>
						</div> --}}

						<div class="form-group row">
						<label class="col-sm-4 col-form-label">No Inventarisasi</label>
						<div class="col-sm-7">
							<input type='text' class='form-control' name='no_invent' value='{{ $data->no_invent }}'>
						</div>
						
						</div>

						<div class="form-group row">
						<label class="col-sm-4 col-form-label">Nama alat</label>
						<div class="col-sm-7">
						<select class="form-control select2" name="id_alat" data-url="{{ url('alat/select2') }}">
							<option value="{{ $data->id_alat }}"> {{ $data->alat->nama }} </option>
							</select>
						</div>
						</div>

						<div class="form-group row">
						<label class="col-sm-4 col-form-label">Merk</label>
						<div class="col-sm-7">
							<input type='text' class='form-control' name='merk' value='{{ $data->merk }}'>
						</div>
						
						</div>

						<div class="form-group row">
						<label class="col-sm-4 col-form-label">Tipe</label>
						<div class="col-sm-7">
						<input type='text' class='form-control' name='tipe' value='{{ $data->tipe }}'>
						</div>
						</div>

						<div class="form-group row">
						<label class="col-sm-4 col-form-label">Nomor Seri</label>
						<div class="col-sm-7">
						<input type='text' class='form-control' name='nomor_seri' value='{{ $data->nomor_seri }}'>
						</div>
						</div>

						<div class="form-group row">
						<label class="col-sm-4 col-form-label">Manufacture</label>
						<div class="col-sm-7">
						<input type='text' class='form-control' name='manufacture' value='{{ $data->manufacture }}'>
						</div>
						</div>

						<div class="form-group row">
						<label class="col-sm-4 col-form-label">Lokasi</label>
						<div class="col-sm-7">
						<select class="form-control select2" name="id_ruangan" data-url="{{ url('ruangan/select2') }}">
							@if (@$data->id_ruangan)
								<option value="{{ @$data->id_ruangan }}">{{ @$data->ruangan->nama }}</option>
							@endif
						</select>
						</div>
						</div>

						<div class="form-group row">
						<label class="col-sm-4 col-form-label">Kondisi</label>
						<div class="col-sm-7">
						<select class="form-control" name="kondisi">
							<option {{ ($data->kondisi == 'Baik' ? 'selected' : '') }} value="Baik">Baik</option>
							<option {{ ($data->kondisi == 'Kurang baik' ? 'selected' : '') }} value="Kurang baik">Kurang baik</option>
							<option {{ ($data->kondisi == 'Rusak' ? 'selected' : '') }} value="Rusak">Rusak</option>
						</select>
						</div>
						</div>

						<div class="form-group row">
						<label class="col-sm-4 col-form-label">Supplier</label>
						<div class="col-sm-7">
						<select class="form-control select2" name="id_supplier" data-url="{{ url('supplier/select2') }}">
							@if ($data->id_supplier)
							<option value="{{ $data->id_supplier }}">{{ $data->supplier->nama }}</option>
							@endif
						</select>
						</div>
						</div>

						<div class="form-group row">
						<label class="col-sm-4 col-form-label">Gambar</label>
						<div class="col-sm-7">
						<input type="file" onchange="previewFile(this);" name="gambar" class="form-control">
						<img src="{{ (!empty($data->gambar) ? url($data->gambar) : '' ) }}" style="max-width: 250px" id="previewImg" alt="Gambar alat">
						</div>
						</div>

								
					</fieldset>
				</div>

				<div class="col-md-6">
					<fieldset>
						<legend>Administratif Information:</legend>
						
						<div class="form-group row">
						<label class="col-sm-4 col-form-label">Tahun Pengadaan</label>
						<div class="col-sm-7">
						<input type='date' class='form-control' name='tahun_pengadaan' value='{{ $data->tahun_pengadaan }}'>
						</div>
						</div>

						<div class="form-group row">
						<label class="col-sm-4 col-form-label">Harga Beli</label>
						<div class="col-sm-7">
						<input type='number' class='form-control' name='harga_beli' value='{{ $data->harga_beli }}'>
						</div>
						</div>

						<div class="form-group row">
						<label class="col-sm-4 col-form-label">Sumber Dana</label>
						<div class="col-sm-7">
						<select class="form-control select2" name="id_sumber_dana" data-url="{{ url('sumber_dana/select2') }}">
							@if ($data->id_sumber_dana)
							<option value="{{ $data->id_sumber_dana }}">{{ $data->sumber_dana->nama }}</option>
							@endif
						</select>
						</div>
						</div>

						<div class="form-group row">
						<label class="col-sm-4 col-form-label">Expected Life Time</label>
						<div class="col-sm-7">
						<input type='number' class='form-control' name='expected_life_time' value='{{ $data->expected_life_time }}'>
						</div>
						</div>

						<div class="form-group row">
						<label class="col-sm-4 col-form-label">Present Year</label>
						<div class="col-sm-7">
						<input type='text' class='form-control' name='present_year' value='{{ $data->present_year }}'>
						</div>
						</div>

						<div class="form-group row">
						<label class="col-sm-4 col-form-label">Penyusutan/tahun</label>
						<div class="col-sm-7">
						<input type='number' class='form-control' name='penyusutan_pertahun' value='{{ $data->penyusutan_pertahun }}'>
						</div>
						</div>

						<div class="form-group row">
						<label class="col-sm-4 col-form-label">Nilai Akumulasi</label>
						<div class="col-sm-7">
						<input type='number' class='form-control' name='nilai_akumulasi' value='{{ $data->nilai_akumulasi }}'>
						</div>
						</div>

						<div class="form-group row">
						<label class="col-sm-4 col-form-label">Nilai Buku</label>
						<div class="col-sm-7">
						<input type='number' class='form-control' name='nilai_buku' value='{{ $data->nilai_buku }}'>
						</div>
						</div>								
					</fieldset>
				</div>

				
			</div>
			<hr>
			<div class="row">
				<div class="col-md-12">
					<fieldset>
						<legend>Documents Information:</legend>
						<div class="row">
							<div class="col-md-6">

								<div class="form-group row">
								<label class="col-sm-4 col-form-label">SOP baru</label>
								<div class="col-sm-7">
								<input type="file" name="sop" accept="application/pdf" class="form-control">
								</div>
								</div>	
						
							{{-- <div class="form-group row">
							<label class="col-sm-4 col-form-label">SOP alat</label>
							<div class="col-sm-7">
	                          <input {{ ($data->sop_alat == 'Ada' ? 'checked' : '') }} class="form-check-input" type="radio" name="sop_alat" value="Ada">
	                          <label class="form-check-label">Ada</label>
	                          <br>
	                          <input {{ ($data->sop_alat == 'Tidak ada' ? 'checked' : '') }} class="form-check-input" type="radio" name="sop_alat" value="Tidak ada">
	                          <label class="form-check-label">Tidak ada</label>
                       
							</div>
							</div> --}}

							<div class="form-group row">
							<label class="col-sm-4 col-form-label">Operating Manual baru</label>
							<div class="col-sm-7">
								<input type="file" name="operating_manual" accept="application/pdf" class="form-control">
							</div>
							</div>

							<div class="form-group row">
							<label class="col-sm-4 col-form-label">Service Manual baru</label>
							<div class="col-sm-7">
								<input type="file" name="service_manual" accept="application/pdf" class="form-control">
							</div>
							</div>

							<div class="form-group row">
							<label class="col-sm-4 col-form-label">Warranty Expired</label>
							<div class="col-sm-7">
							<input type='date' class='form-control' name='warranty_expired' value='{{ $data->warranty_expired }}'>
							</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group row">
							<label class="col-sm-4 col-form-label">Kepemilikan</label>
							<div class="col-sm-7">
							<select class="form-control select2" name="id_kepemilikan" data-url="{{ url('kepemilikan/select2') }}">
								@if ($data->id_kepemilikan)
								<option value="{{ $data->id_kepemilikan }}">{{ $data->pemilik->nama }}</option>
								@endif
							</select>
							</div>
							</div>

							<div class="form-group row">
							<label class="col-sm-4 col-form-label">Status</label>
							<div class="col-sm-7">
							<select class="form-control" name="status">
								<option {{ ($data->status == 'active' ? 'selected' : '') }} value="active">active</option>
								<option {{ ($data->status == 'non active' ? 'selected' : '') }} value="non active">non active</option>
							</select>
							</div>
							</div>

							<div class="form-group row">
							<label class="col-sm-4 col-form-label">Daya Listrik</label>
							<div class="col-sm-7">
							<input type='number' class='form-control' name='daya_listrik' value='{{ $data->daya_listrik }}'>
							</div>
							</div>

							
						</div>	
						</div>
						
					</fieldset>
				</div>
			</div>
		</div>
		</form>
	      <div class="row">
	      	<div class="col-lg-12">
	      		<button type="submit" data-redirect="true" data-redirect-to="{{ url('/data-alkes') }}" class="btn btn-primary save-btn"> SIMPAN</button>
	      		<a href="{{url('data-alkes')}}" class="btn btn-danger"> BATAL</a>
	      	</div>
	      	
	      </div>  
      </div><!-- /.container-fluid -->
            </div>
        </div>

    </section>
    <!-- /.content -->

@endsection
@push('scripts')
	<script type="text/javascript">
		function previewFile(input){
        var file = $("input[type=file]").get(0).files[0];
 
        if(file){
            var reader = new FileReader();
 
            reader.onload = function(){
                $("#previewImg").attr("src", reader.result);
            }
 
            reader.readAsDataURL(file);
        }
    }
	</script>
@endpush
