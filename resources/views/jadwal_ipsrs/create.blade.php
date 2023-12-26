<form action="{{url("jadwal_ipsrs")}}" method="post" id="form" enctype="multipart/form-data">

{{csrf_field()}}

<div class="form-group">
	<label>Nama File</label>
	<input type='text' class='form-control' name='nama_file' >
</div>

<div class="form-group">
	<label>File</label>
	<input type='file' class='form-control' name='file' accept="application/pdf, image/png, image/jpeg, image/jpg">
</div>
		
</form>