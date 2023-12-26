<form action="{{url("teknisi/".$data->id)}}"  enctype="multipart/form-data" method="post"  id="form">

{{csrf_field()}}
{{method_field("PUT")}}

<div class="form-group">
<label>Nama Teknisi</label>
<input type='text' class='form-control' name='nama' value='{{$data->nama}}'>
</div>
<div class="form-group">
<label>Nomor Whatsapp</label>
<input type='text' class='form-control' name='hp' value='{{$data->hp}}'>
</div>
{{-- <div class="form-group">
<label>nip</label>
<input type='text' class='form-control' name='nip' value='{{$data->nip}}'>
</div>
<div class="form-group">
<label>ttd</label>
<input type='file' class='form-control ttd' name='ttd'>
	
  <img id="blah" src="{{ url($data->ttd) }}" alt="your image" style="width: 100%;" />


</div> --}}


</form>

<script type="text/javascript">
	function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    
    reader.onload = function(e) {
      $('#blah').attr('src', e.target.result);
    }
    
    reader.readAsDataURL(input.files[0]); // convert to base64 string
  }
}



	$(".ttd").change(function() {
  readURL(this);
});
</script>