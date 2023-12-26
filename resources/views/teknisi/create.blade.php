<form action="{{url("teknisi")}}" method="post"  enctype="multipart/form-data"  id="form">

{{csrf_field()}}


<div class="form-group">
<label>Nama Teknisi</label>
<input type='text' class='form-control' name='nama' value=''>
</div>
<div class="form-group">
<label>Nomor Whatsapp</label>
<input type='text' class='form-control' name='hp' value=''>
</div>
{{-- <div class="form-group">
<label>nip</label>
<input type='text' class='form-control' name='nip' value=''>
</div>
<div class="form-group">
<label>ttd</label>
<input type='file' class='form-control  ttd' name='ttd' value='' style="width: 100%;">
<img id="blah" src="#" alt="your image" /> --}}


</div>

		
</form>


<script type="text/javascript">
	function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    
    reader.onload = function(e) {
      $('#blah').attr('src', e.target.result);
      $('#blah').attr('width', '100%');
    }
    
    reader.readAsDataURL(input.files[0]); // convert to base64 string
  }
}



	$(".ttd").change(function() {
  readURL(this);
  // alert("X");
});
</script>