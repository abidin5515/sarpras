<form action="{{url("data_ceklis/".$data->id)}}"  enctype="multipart/form-data" method="post"  id="form">

{{csrf_field()}}
{{method_field("PUT")}}

<div class="form-group">
<label>Tanggal</label>
<input type='date' class='form-control' name='tanggal' value="{{ $data->tanggal }}">
</div>

<div class="form-group">
  <label>Master Ceklis</label>
  <select class="form-control" name="id_master_ceklis">
    <option value="">-- Pilih --</option>
    @if(@$master_ceklis)
      @foreach(@$master_ceklis as $m)
        <option {{ @$data->id_master_ceklis == $m->id ? 'selected' : '' }} value="{{ @$m->id }}">{{ @$m->nama_ceklis }}</option>
      @endforeach
    @endif
  </select>
</div>

<div class="form-group">
  <label>Shif</label>
  <select class="form-control" name="shif">
    <option value="1">1</option>
    <option value="2">2</option> 
    <option value="3">3</option> 
  </select>
</div>

<div class="form-group">
  <label>Jumlah</label>
  <input type='text' class='form-control' name='jumlah' value="{{ $data->jumlah }}">
</div>

<div class="form-group">
  <label>Keterangan</label>
  <input type='text' class='form-control' name='keterangan' value="{{ $data->keterangan }}">
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