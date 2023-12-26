
<div>
	<div class="form-group">
		<label>Upload File Kalibrasi</label>
		<input type="file" name="file_kalibrasi[]" class="form-control" multiple="">
	</div>
</div>


@if (!empty($kalibrasi))
	{{-- expr --}}
@if ($kalibrasi->count())
	{{-- expr --}}
<label>Daftar File Diupload</label>
	
	<ul class="list-group">
		@foreach ($kalibrasi->get() as $k)
			{{-- expr --}}
			<li class="list-group-item"><a target="_blank" href="{{ url($k->file) }}">{{$k->file}}</a></li>
		@endforeach
	</ul>
@endif
<br>
@endif
