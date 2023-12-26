<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<center><h4>LAPORAN KEGIATAN PERBAIKAN ALAT KESEHATAN  TAHUN {{$tahun}}

		<br>
		RSUD RAA SOEWONDO PATI
		<br>
		Jln. Dr. Soesanto No. 114 Pati, Jawa Tengah
		</h4>


	</center>
	<table style="width: 100%;border-collapse: collapse;" border="1">
		
		<tr>
			
     
    	<td>NO</td>
    	<td>Tanggal</td>
    	<td>No Laporan</td>

     	<td>Ruang</td>
     	<td>Pelapor</td>
     	<td>Alat</td>
     	<td>Keluhan</td>
     	<td>No STP</td>
     	<td>Tanggal Perbaikan</td>
     	<td>Tindakan</td>
     	<td>Suku Cadang</td>
     	<td>Selesai Dikerjakan</td>
     	<td>Petugas</td>
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
					
					<td>{{date('d/m/Y',strtotime($d->tanggal))}}</td>
					<td>{{$d->nomor}}</td>
					<td>{{$d->ruangan_nama}}</td>
					<td>{{$d->nama_pemesan}}</td>
					<td>{{$d->nama}}</td>
					<td>{{$d->keluhan}}</td>
					<td>{{$d->nomor_perbaikan}}</td>
					<td>{{date('d/m/Y',strtotime($d->perbaikan_tanggal))}}</td>
					<td>{{$d->tindakan}}</td>
					<td>{{$d->suku_cadang}}</td>
					<td>{{date('d/m/Y',strtotime($d->selesai_dikerjakan))}}</td>
					<td>{{$d->nama_teknisi}}</td>

			@endforeach
		@else
		<tr>
			<td colspan="8"><center>Data Tidak Ditemukan</center></td>
		</tr>
		@endif
	</table>

</body>
</html>