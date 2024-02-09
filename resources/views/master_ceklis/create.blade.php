<form action="{{url("master_ceklis")}}" method="post"  enctype="multipart/form-data"  id="form">

{{csrf_field()}}


<div class="form-group">
<label>Nama Ceklis</label>
<input type='text' class='form-control' name='nama_ceklis' value=''>
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
