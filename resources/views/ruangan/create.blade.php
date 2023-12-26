<form action="{{url("ruangan")}}" method="post"    id="form" >

{{csrf_field()}}


<div class="form-group">
<label>Nama Ruang</label>
<input type='text' class='form-control' name='nama' value=''>
</div>

{{-- <div class="form-group">
<label>awalan</label>
<input type='text' class='form-control' maxlength="3" name='awalan' value=''>
</div> --}}

		
</form>