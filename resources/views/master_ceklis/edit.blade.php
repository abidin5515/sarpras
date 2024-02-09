<form action="{{url("master_ceklis/".$data->id)}}"  enctype="multipart/form-data" method="post"  id="form">

{{csrf_field()}}
{{method_field("PUT")}}

<div class="form-group">
<label>Nama Ceklis</label>
<input type='text' class='form-control' name='nama_ceklis' value='{{$data->nama_ceklis}}'>
</div>

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