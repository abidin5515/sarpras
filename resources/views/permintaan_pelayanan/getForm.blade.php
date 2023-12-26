@if ($id == '1')
	<label>Tanggal:</label>
	<input type="date" class="form-control" name="tanggal" value="{{@$data_tinjau->tanggal}}">
	{{-- <br> --}}
	<label>Tentukan Teknisi:</label>
	<select class="form-control select2" name="id_petugas" data-url="{{ url('teknisi/select2') }}">
	<option value="{{@$data_tinjau->id_teknisi}}">{{@$data_tinjau->petugas->nama}}</option>	
	</select>
@else 
	<label>Perusahaan:</label>
	<select class="form-control select2" name="id_supplier" data-url="{{ url('supplier/select2') }}">
	<option value="{{@$data_tinjau->id_supplier}}">{{@$data_tinjau->supplier->nama}}</option>	
	</select>	

	{{-- <label>Nama Perusahaan:</label>
	<input type="text" class="form-control" name="nama_perusahaan" value="{{@$data_tinjau->nama_perusahaan}}">
	<label>Alamat:</label>
	<textarea class="form-control" name="alamat">{{@$data_tinjau->alamat}}</textarea>	 --}}
@endif