

	{{-- expr --}}
<label>Daftar File Diupload</label>
@if ($kalibrasi->count())
	{{-- expr --}}
	<ul class="list-group">
		@foreach ($kalibrasi->get() as $k)
			{{-- expr --}}
			<li class="list-group-item"><a target="_blank" href="{{ url($k->file) }}">{{$k->file}}</a></li>
		@endforeach
	</ul>
@endif