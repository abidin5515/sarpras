<form action="{{url("jenis-pekerjaan/".$data->id)}}"   method="post"  id="form">

{{csrf_field()}}
{{method_field("PUT")}}

<div class="form-group">
<label>nama</label>
<input type='text' class='form-control' name='nama' value='{{$data->nama}}'>
</div>


</form>