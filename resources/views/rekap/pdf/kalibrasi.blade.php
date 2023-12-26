<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>


	<center><h4>REKAP PENGUJIAN dan KALIBRASI ALKES TAHUN {{$tahun}}

		<br>
		RSUD RAA SOEWONDO PATI
		<br>
		Jln. Dr. Soesanto No. 114 Pati, Jawa Tengah
		</h4>


	</center>
	<table style="width: 100%;border-collapse: collapse;" border="1">
		
		<tr>
			
     		<td>No</td>
     		<td>Nama Alkes</td>
     		<td>Merk</td>
     		<td>Model/Type</td>
     		<td>No.Seri</td>
     		<td>Tempat Alat</td>
     		<td>Tanggal</td>
     		<td>PT</td>

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
					<td>{{date('d/m/Y',strtotime($d->tanggal))}}</td>
					<td>{{$d->vendor}}</td>
				</tr>
			@endforeach

		@else
		<tr>
			<td colspan="8"><center>Data Tidak Ditemukan</center></td>
		</tr>
		@endif
	</table>

</body>
</html>