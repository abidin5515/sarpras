<form action="{{url("supplier")}}" method="post"    id="form" onsubmit="return true">

{{csrf_field()}}


<div class="form-group">
<label>nama</label>
<input type='text' class='form-control' name='nama' value=''>
</div>
<div class="form-group">
<label>alamat</label>
<input type='text' class='form-control' name='alamat' value=''>
</div>
		
</form>