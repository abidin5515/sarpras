@if ($data)
<br>
<div class="table table-responsive">
	<table class="table" style="color: #000">
		<tr>
			<th>Waktu Input</th>
			{{-- <th>Ruang</th> --}}
			<th>Masalah</th>
			<th>Foto</th>
			<th>Aksi</th>
		</tr>
		@foreach ($data as $d)
			<tr>
				<td valign="top">{{ date('d-m-Y H:i', strtotime($d->created_at)) }}</td>
				{{-- <td valign="top">{{ @$d->ruangan->nama }}</td> --}}
				<td valign="top">{{ @$d->masalah }}</td>
				<td valign="top">
					@if ($d->foto)
						<img width="60px" src="{{ url(@$d->foto) }}">
					@endif
				</td>
				<td><a class="btn btn-sm btn-primary" href="{{ url('catatan-pemeliharaan/create?id_permintaan=').$d->id }}">Kerjakan</a></td>
			</tr>
		@endforeach
	</table>
</div>
@endif