<form action="{{url("data_ceklis")}}" method="post"  enctype="multipart/form-data"  id="form">

{{csrf_field()}}


<div class="form-group">
<label>Tanggal</label>
<input type='date' class='form-control' name='tanggal' value="{{ date('Y-m-d') }}">
</div>

<div class="form-group">
  <label>Master Ceklis</label>
  <select class="form-control" name="id_master_ceklis">
    <option value="">-- Pilih --</option>
    @if(@$master_ceklis)
      @foreach(@$master_ceklis as $m)
        <option value="{{ @$m->id }}">{{ @$m->nama_ceklis }}</option>
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
  <input type='text' class='form-control' name='jumlah'>
</div>

<div class="form-group">
  <label>Keterangan</label>
  <input type='text' class='form-control' name='keterangan'>
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