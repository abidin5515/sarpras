
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
              <h3 class="card-title">Tambah Jadwal</h3>
            </div>
            <!-- /.box-header -->
            <div class="card-body">
            	
      <div class="container-fluid">
        <form style="width: 100%" action="{{url("jadwal/store")}}" method="post" id="form" enctype="multipart/form-data">

		{{csrf_field()}}

		<div class="col-lg-12">
			<div class="row">
				<div class="col-md-6">
					<fieldset>
					  {{-- <legend>Equipment Profile:</legend> --}}
						
						{{-- <div class="form-group row">
						<label class="col-sm-4 col-form-label">Kode Alat</label>
					    <div class="col-sm-7">
					      <input type="text" class="form-control" name="kode_alat">
					    </div>
						</div> --}}
						{{-- <div class="form-group row">
						<label class="col-sm-4 col-form-label">No Inventarisasi</label>
						<div class="col-sm-7">
						<input type="text" value="" class="form-control" name="no_invent">
						</div>
						</div>
 --}}
						
						<div class="form-group row">
						<label class="col-sm-4 col-form-label">Petugas</label>
						<div class="col-sm-7">
						<select class="form-control select2" name="id_petugas" data-url="{{ url('teknisi/select2') }}">
							</select>
						</div>
						</div>

						<div class="form-group row">
						<label class="col-sm-4 col-form-label">Bulan </label>
						<div class="col-sm-7">
							<select class="form-control" name="bulan">
								@if ($bulan)
									@foreach ($bulan as $key => $value)
										<option {{(date('m') == $key ? 'selected' : '')}} value="{{$key}}">{{$value}}</option>
									@endforeach
								@endif
							</select>
						</div>
						</div>

						<div class="form-group row">
						<label class="col-sm-4 col-form-label">Tahun </label>
						<div class="col-sm-7">
							<select class="form-control" name="tahun">
								@if ($tahun)
									@foreach ($tahun as $key => $value)
										<option {{(date('Y') == $value ? 'selected' : '')}} value="{{$value}}">{{$value}}</option>
									@endforeach
								@endif
							</select>
						</div>
						</div>

						<div class="form-group row">
						<label class="col-sm-4 col-form-label">Keterangan</label>
						<div class="col-sm-7">
							<textarea class="form-control" name="keterangan" rows="6"></textarea>
							{{-- <input type='text' class='form-control' name='merk' value=''> --}}
						</div>
						
						</div>	
					</fieldset>
					
				</div>

				<div class="col-md-6">
					<fieldset>
						{{-- <legend>Administratif Information:</legend> --}}
						
					

						<div class="form-group row">
						<label class="col-sm-4 col-form-label">Minggu 1</label>
						<div class="col-sm-7">
						<select multiple="true" class="form-control select2" name="minggu1[]" data-url="{{ url('ruangan/select2') }}">
						</select>
						</div>
						</div>

						<div class="form-group row">
						<label class="col-sm-4 col-form-label">Minggu 2</label>
						<div class="col-sm-7">
						<select multiple="true" class="form-control select2" name="minggu2[]" data-url="{{ url('ruangan/select2') }}">
						</select>
						</div>
						</div>

						<div class="form-group row">
						<label class="col-sm-4 col-form-label">Minggu 3</label>
						<div class="col-sm-7">
						<select multiple="true" class="form-control select2" name="minggu3[]" data-url="{{ url('ruangan/select2') }}">
						</select>
						</div>
						</div>

						<div class="form-group row">
						<label class="col-sm-4 col-form-label">Minggu 4</label>
						<div class="col-sm-7">
						<select multiple="true" class="form-control select2" name="minggu4[]" data-url="{{ url('ruangan/select2') }}">
						</select>
						</div>
						</div>

												
					</fieldset>
				</div>

				
			</div>

		</div>
		</form>
	      <div class="row">
	      	<div class="col-lg-12">
	      		<button type="submit" data-redirect="true" data-redirect-to="{{ url('/jadwal') }}" class="btn btn-primary save-btn"> SIMPAN</button>
	      		<a href="{{url('jadwal')}}" class="btn btn-danger"> BATAL</a>
	      	</div>
	      	
	      </div>  
      </div><!-- /.container-fluid -->
            </div>
        </div>

    </section>
    <!-- /.content -->

@endsection