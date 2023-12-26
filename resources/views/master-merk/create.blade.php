<form action="{{url("master-merk")}}" method="post"  enctype="multipart/form-data"  id="form">

{{csrf_field()}}


<div class="form-group">
  <label>Nama Merk</label>
  <input type='text' class='form-control' name='nama' value=''>
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