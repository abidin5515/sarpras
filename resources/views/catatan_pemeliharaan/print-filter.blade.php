<!DOCTYPE html>
<html>
<head>
	<title>Catatan Perbaikan Sarpras</title>
</head>
<body style="font-family: sans-serif;">
	<style type="text/css">
	.nopaddingmargin{
		padding: 0;
		margin: 0;
	}
	.full-width{
		width: 100%;
	}
	.center{
		text-align: center;
	}
	td, th {
		font-size: 12px;
	}
</style>

<center>
	<h4 style="margin: 0">CATATAN PERBAIKAN SARPRAS</h4>
	<h3 style="margin: 0">RS PKU MUHAMMADIYAH PAMOTAN</h3>
</center>



<div style="width: 100%;margin-top: 20px;">
	<table class="full-width" border="1" style="border-collapse: collapse;">
		<tr>
			<th>No</th>
			<th>Tanggal</th>
			<th>Perbaikan</th>
			<th>Jam Mulai</th>
			<th>Jam Selesai</th>
			<th>Lokasi</th>
			<th>Status</th>
			<th>Keterangan</th>
			<th>Biaya</th>
			<th>Foto</th>
			<th>Teknisi</th>
		</tr>
		
			@php
			$no = 1;
			@endphp
			@foreach ($data as $r)
				<tr>
					<td valign="top">{{$no++}}.</td>
					<td valign="top">{{@date('d-m-Y', strtotime($r->tanggal))}}</td>
					<td valign="top">{{@$r->perbaikan}}</td>
					<td valign="top">{{@$r->jam_mulai}}</td>
					<td valign="top">{{@$r->jam_selesai}}</td>
					<td valign="top">{{@$r->lokasi}}</td>
					<td valign="top">{{@$r->status}}</td>
					<td valign="top">{{@$r->keterangan}}</td>
					<td valign="top">{{@$r->biaya}}</td>
					<td valign="top"><img style="margin: 0" width="100" src="{{ asset(@$r->foto) }}"></td>	
					<td valign="top">
						@php
							if ($r->id_teknisi) {
						        $b= preg_split("/[,]/",$r->id_teknisi);
						          $a = '';
						          foreach ($b as $v) {
						            $a .= ambil_teknisi($v).', ';
						          }
						        	echo $a;
							      }else {
							        echo '-';
							      }
						@endphp	
					</td>
				</tr>
			@endforeach	
		
		
	</table>
</div>

</body>
</html>