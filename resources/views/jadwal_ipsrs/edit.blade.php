<form action="{{url("ruangan/".$data->id)}}"   method="post"  id="form" >

{{csrf_field()}}
{{method_field("PUT")}}

<div class="form-group">
<label>Nama Ruang</label>
<input type='text' class='form-control' name='nama' value='{{$data->nama}}'>
</div>

{{-- <div class="form-group">
<label>awalan</label>
<input type='text' class='form-control' maxlength="3" name='awalan' value='{{$data->awalan}}'>
</div> --}}


</form>