<form action="{{url("user/".$data->id)}}"   method="post"  id="form">

{{csrf_field()}}
{{method_field("PUT")}}

<div class="form-group">
<label>username</label>
<input type='text' class='form-control' name='username' value='{{$data->username}}'>
</div>
<div class="form-group">
<label>password</label>
<input type='password' class='form-control' name='password'>
</div>



<div class="form-group">
<label>Role</label>
<select class="form-control" name="role">
	
	@foreach ($roles->get() as $role)
		{{-- expr --}}
		<option {{@$data->getRoles()[0]== $role->name? 'selected':''}} value="{{$role->id}}">{{$role->name}}</option>
	@endforeach
</select>
</div>



<div class="form-group">
<label>Ruangan</label>
<select class="form-control select2" name="ruangan" data-url="{{ url('ruangan/select2') }}">
	@if (!empty($data->id_ruangan))
		{{-- expr --}}
		<option value="{{$data->id_ruangan}}">{{$data->ruangan->nama}}</option>
	@endif
	{{-- <option value=""></option> --}}
</select>
</div>



</form>