<form action="{{url("user")}}" method="post"    id="form">

{{csrf_field()}}


<div class="form-group">
<label>username</label>
<input type='text' class='form-control' name='username' value=''>
</div>

<div class="form-group">
<label>password</label>
<input type='password' class='form-control' name='password' value=''>
</div>


<div class="form-group">
<label>Role</label>
<select class="form-control" name="role">
	
	@foreach ($roles->get() as $role)
		{{-- expr --}}
		<option value="{{$role->id}}">{{$role->name}}</option>
	@endforeach
</select>
</div>



<div class="form-group">
<label>Ruangan</label>
<select class="form-control select2" name="ruangan" data-url="{{ url('ruangan/select2') }}">
	<option value=""></option>
</select>
</div>

		
</form>