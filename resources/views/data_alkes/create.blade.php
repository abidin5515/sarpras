
@extends('layouts.app')


@section('content')
 

    <!-- Main content -->
    <section class="content">
    	<div class="card">
            <div class="card-header">
              <h3 class="card-title">Tambah Alat</h3>
            </div>
            <!-- /.box-header -->
            <div class="card-body">
            	
      <div class="container-fluid">
        <form style="width: 100%" action="{{url("data-alkes/store")}}" method="post" id="form" enctype="multipart/form-data">

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
						<input type="text" value="" class="form-control" name="no_invent">
						</div>
						</div>

						
						<div class="form-group row">
						<label class="col-sm-4 col-form-label">Nama alat</label>
						<div class="col-sm-7">
						<select class="form-control select2" name="id_alat" data-url="{{ url('alat/select2') }}">
							</select>
						</div>
						</div>

						<div class="form-group row">
						<label class="col-sm-4 col-form-label">Merk</label>
						<div class="col-sm-7">
							<input type='text' class='form-control' name='merk' value=''>
						</div>
						
						</div>

						<div class="form-group row">
						<label class="col-sm-4 col-form-label">Tipe</label>
						<div class="col-sm-7">
						<input type='text' class='form-control' name='tipe' value=''>
						</div>
						</div>

						<div class="form-group row">
						<label class="col-sm-4 col-form-label">Nomor Seri</label>
						<div class="col-sm-7">
						<input type='text' class='form-control' name='nomor_seri' value=''>
						</div>
						</div>

						<div class="form-group row">
						<label class="col-sm-4 col-form-label">Manufacture</label>
						<div class="col-sm-7">
						<input type='text' class='form-control' name='manufacture' value=''>
						</div>
						</div>

						<div class="form-group row">
						<label class="col-sm-4 col-form-label">Lokasi</label>
						<div class="col-sm-7">
						<select class="form-control select2" name="id_ruangan" data-url="{{ url('ruangan/select2') }}">
						</select>
						</div>
						</div>

						<div class="form-group row">
						<label class="col-sm-4 col-form-label">Kondisi</label>
						<div class="col-sm-7">
						<select class="form-control" name="kondisi">
							<option value="Baik">Baik</option>
							<option value="Kurang baik">Kurang baik</option>
							<option value="Rusak">Rusak</option>
						</select>
						</div>
						</div>

						<div class="form-group row">
						<label class="col-sm-4 col-form-label">Supplier</label>
						<div class="col-sm-7">
						<select class="form-control select2" name="id_supplier" data-url="{{ url('supplier/select2') }}">
						</select>
						</div>
						</div>

						<div class="form-group row">
						<label class="col-sm-4 col-form-label">Gambar</label>
						<div class="col-sm-7">
						<input type="file" onchange="previewFile(this);" name="gambar" class="form-control">
						<img style="max-width: 250px" id="previewImg" alt="Placeholder">
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
						<input type='date' class='form-control' name='tahun_pengadaan' value=''>
						</div>
						</div>

						<div class="form-group row">
						<label class="col-sm-4 col-form-label">Harga Beli</label>
						<div class="col-sm-7">
						<input type='number' class='form-control' name='harga_beli' value=''>
						</div>
						</div>

						<div class="form-group row">
						<label class="col-sm-4 col-form-label">Sumber Dana</label>
						<div class="col-sm-7">
						<select class="form-control select2" name="id_sumber_dana" data-url="{{ url('sumber_dana/select2') }}">
						</select>
						</div>
						</div>

						<div class="form-group row">
						<label class="col-sm-4 col-form-label">Expected Life Time</label>
						<div class="col-sm-7">
						<input type='number' class='form-control' name='expected_life_time' value=''>
						</div>
						</div>

						<div class="form-group row">
						<label class="col-sm-4 col-form-label">Present Year</label>
						<div class="col-sm-7">
						<input type='text' class='form-control' name='present_year' value=''>
						</div>
						</div>

						<div class="form-group row">
						<label class="col-sm-4 col-form-label">Penyusutan/tahun</label>
						<div class="col-sm-7">
						<input type='number' class='form-control' name='penyusutan_pertahun' value=''>
						</div>
						</div>

						<div class="form-group row">
						<label class="col-sm-4 col-form-label">Nilai Akumulasi</label>
						<div class="col-sm-7">
						<input type='number' class='form-control' name='nilai_akumulasi' value=''>
						</div>
						</div>

						<div class="form-group row">
						<label class="col-sm-4 col-form-label">Nilai Buku</label>
						<div class="col-sm-7">
						<input type='number' class='form-control' name='nilai_buku' value=''>
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
							{{-- <div class="form-group row">
							<label class="col-sm-4 col-form-label">SOP alat</label>
							<div class="col-sm-7">
	                          <input class="form-check-input" type="radio" name="sop_alat" value="Ada">
	                          <label class="form-check-label">Ada</label>
	                          <br>
	                          <input class="form-check-input" type="radio" name="sop_alat" value="Tidak ada">
	                          <label class="form-check-label">Tidak ada</label>
                       
							</div>
							</div> --}}

							<div class="form-group row">
							<label class="col-sm-4 col-form-label">SOP</label>
							<div class="col-sm-7">
							<input type="file" name="sop" accept="application/pdf" class="form-control"/>
							</div>
							</div>		

							<div class="form-group row">
							<label class="col-sm-4 col-form-label">Operating Manual</label>
							<div class="col-sm-7">
								<input type="file" name="operating_manual" accept="application/pdf" class="form-control"/>
							</div>
							</div>

							<div class="form-group row">
							<label class="col-sm-4 col-form-label">Service Manual</label>
							<div class="col-sm-7">
								<input type="file" name="service_manual" accept="application/pdf" class="form-control"/>
							</div>
							</div>

							<div class="form-group row">
							<label class="col-sm-4 col-form-label">Warranty Expired</label>
							<div class="col-sm-7">
							<input type='date' class='form-control' name='warranty_expired' value=''>
							</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group row">
							<label class="col-sm-4 col-form-label">Kepemilikan</label>
							<div class="col-sm-7">
							<select class="form-control select2" name="id_kepemilikan" data-url="{{ url('kepemilikan/select2') }}">
							</select>
							</div>
							</div>

							<div class="form-group row">
							<label class="col-sm-4 col-form-label">Status</label>
							<div class="col-sm-7">
							<select class="form-control" name="status">
								<option value="active">active</option>
								<option value="non active">non active</option>
							</select>
							</div>
							</div>

							<div class="form-group row">
							<label class="col-sm-4 col-form-label">Daya Listrik</label>
							<div class="col-sm-7">
							<input type='number' class='form-control' name='daya_listrik' value=''>
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
	      		<button type="button" class="btn btn-danger"> BATAL</button>
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
