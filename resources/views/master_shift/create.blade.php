<form action="{{url("master_shift")}}" method="post"    id="form" >

{{csrf_field()}}


<div class="form-group">
	<label>Nama Shift</label>
	<input type='text' class='form-control' name='nama' value=''>
</div>


<div class="form-group">
	<label>Jam Masuk</label>
	<input type='time' class='form-control' name='jam_masuk' value=''>
</div>


<div class="form-group">
	<label>Jam Pulang</label>
	<input type='time' class='form-control' name='jam_pulang' value=''>
</div>

{{-- <div class="form-group">
<label>awalan</label>
<input type='text' class='form-control' maxlength="3" name='awalan' value=''>
</div> --}}

		
</form>