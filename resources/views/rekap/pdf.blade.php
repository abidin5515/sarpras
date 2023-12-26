<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<table style="width: 100%;border-collapse: collapse;" border="1">
		
		<tr>
			
     		<td>No</td>
     		<td>Nama Alkes</td>
     		<td>Merk</td>
     		<td>Model/Type</td>
     		<td>No.Seri</td>
     		<td>Tempat Alat</td>
     		<td>Tanggal</td>
     		<td>Pabrikan</td>

		</tr>

		@if ($data->count())
			{{-- expr --}}
			@php
				$num=1;
			@endphp
			@foreach ($data->get() as $d)
				{{-- expr --}}
				<tr>
					<td>{{$num++}}</td>
					<td>{{$d->nama}}</td>
					<td>{{$d->merk}}</td>
					<td>{{$d->tipe}}</td>
					<td>{{$d->nomor_seri}}</td>
					<td>{{$d->ruangan_nama}}</td>
					<td>{{tgl_indo($d->tanggal)}}</td>
					<td>{{$d->vendor}}</td>
				</tr>
			@endforeach
		@endif
	</table>

</body>
</html>