<form action="{{url("pengadaan/".$data->id)}}"   method="post"  id="form" enctype="multipart/form-data">

{{csrf_field()}}
{{method_field("PUT")}}

<div class="form-group">
	<label>Nama Barang</label>
	<input type='text' class='form-control' name='nama_barang' value="{{ @$data->nama_barang }}">
</div>

<div class="form-group">
	<label>Qty</label>
	<input type='number' class='form-control' name='qty' value="{{ @$data->qty }}">
</div>

<div class="form-group">
	<label>Ruang</label>
	<input type='text' class='form-control' name='ruang' value="{{ @$data->ruang }}">
</div>

<div class="form-group">
	<label>Status</label>
	<input type='text' class='form-control' name='status' value="{{ @$data->status }}">
</div>

<div class="form-group">
	<label>Foto</label>
	<br>
		@if ($data->foto)
			<img width="100" src="{{ url($data->foto) }}">
		@endif
	<br>
	<input type='file' class='form-control' name='foto' accept="application/pdf, image/png, image/jpeg, image/jpg">
</div>

<div class="form-group">
	<label>Keterangan</label>
	<textarea class="form-control" name="keterangan">{{ @$data->keterangan }}</textarea>
</div>


</form>