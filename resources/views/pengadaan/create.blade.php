<form action="{{url("pengadaan")}}" method="post" id="form" enctype="multipart/form-data">

{{csrf_field()}}

<div class="form-group">
	<label>Nama Barang</label>
	<input type='text' class='form-control' name='nama_barang' >
</div>

<div class="form-group">
	<label>Qty</label>
	<input type='number' class='form-control' name='qty' >
</div>

<div class="form-group">
	<label>Ruang</label>
	<input type='text' class='form-control' name='ruang' >
</div>

<div class="form-group">
	<label>Status</label>
	<input type='text' class='form-control' name='status' >
</div>

<div class="form-group">
	<label>Foto</label>
	<input type='file' class='form-control' name='foto' accept="application/pdf, image/png, image/jpeg, image/jpg">
</div>

<div class="form-group">
	<label>Keterangan</label>
	<textarea class="form-control" name="keterangan"></textarea>
</div>



		
</form>