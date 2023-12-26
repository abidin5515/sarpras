`<!DOCTYPE html>
<html>
<head>
	<style type="text/css">
		* {
			margin: 10px;
		}
		td {
			font-size: 14px;
		}
	</style>
	<title></title>
</head>
<body>
	
	
<table border="1" width="100%" cellpadding="2" cellspacing="0">
	<tr>
		<td width="20%"></td>
		<td width="60%" align="center">
			<h3 style="margin: 0; padding: 0">Data Alat Kesehatan </h3>
			<h2 style="margin: 0; padding: 0">UPT RSUD RAA Soewondo Pati</h2>
			<p style="margin: 0; padding: 0">Jl. Dr.Soesanto No. 114 Kode Pos 59118 Pati Jawa Tengah</p>
		</td>
		<td width="20%"></td>
	</tr>
</table>

<table border="0" width="100%" cellpadding="2" cellspacing="0">
	<tr>
		<td width="20%" align="left">
			<b>Jumlah : {{ $data->count() }}</b>
		</td>
		<td width="60%" align="center">
			<b>
				@if (!empty($tipe))
					@if ($tipe == 'supplier')
					Supllier : 
					@php
							$sup = App\Supplier::where('id', $id)->first();
							echo $sup->nama;
						@endphp
					@elseif($tipe == 'ruangan')
						Lokasi : 
						@php
							$lok = App\Ruangan::where('id', $id)->first();
							echo $lok->nama;
						@endphp
					@else 
						Alat : 
						@php
							$alat = App\Alat::where('id', $id)->first();
							echo $alat->nama;
						@endphp		
					@endif
				@endif
				
			</b>
		</td>
		<td width="20%" align="right">
			<b>{{ date('d-m-Y') }}</b>
		</td>
	</tr>
</table>

{{-- <p style="float: right;">{{ date('d-m-Y') }}</p>	 --}}
<table border="1" class="table table-striped" cellspacing="0" cellpadding="4" width="100%">

	<tr>
		<td>NO</td>
		<td>KODE</td>
		<td>NO.INVENT</td>
		<td>NAMA ALAT</td>
		<td>MERK</td>
		<td>TIPE</td>
		<td>NO.SERI</td>
		<td>MANUFACTURE</td>
		<td>LOKASI</td>
		<td>SUPPLIER</td>
	</tr>


	@if ($data)
		@php
			$no = 1;
			// print_r($data);
		@endphp
		@foreach ($data as $element)
			<tr>
				<td valign="top">{{ $no++ }}</td>
				<td valign="top">{{ @$element->kode }}</td>
				<td valign="top">{{ @$element->no_invent }}</td>
				<td valign="top">{{ @$element->alat->nama }}</td>
				<td valign="top">{{ @$element->merk }}</td>
				<td valign="top">{{ @$element->tipe }}</td>
				<td valign="top">{{ @$element->nomor_seri }}</td>
				<td valign="top">{{ @$element->manufacture }}</td>
				<td valign="top">{{ @$element->ruangan->nama }}</td>
				<td valign="top">{{ @$element->supplier->nama }}</td>
			</tr>
		@endforeach
	@endif

</table>
</body>
</html>