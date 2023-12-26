<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
@php
	$titik = '....................................';
@endphp
<style type="text/css">
	.nopaddingmargin{
		padding: 0;
		margin: 0;
	}
	.separed {
		padding-top: 15px;
	}
</style>
<div style="width: 100%;">
		<div style="width: 25%;" class="quem-somos-content-wrapper">
			<h3 class="nopaddingmargin">INSTALASI ALAT KESEHATAN</h3>
			<h3 class="nopaddingmargin">RSUD RAA SOEWONDO PATI</h3>
			<hr>
		</div>
		{{-- <br>
		Surat Tugas Pemeliharaan / Perbaikan <br>
		Nomor : --}} 
		<br>
	
		<br>
	{{-- <div style="width: 100%;display: block;">
		 <div style="width: 50%;float: left;">
		 	<table style="width: 100%;">
		 		<tr>
		 			<td>Nama / NIP / Pemesan / User</td><td>:</td><td>-</td>
		 		</tr>
		 		<tr>
		 			<td>SMF /  BAG / Bid/ Inst / Ruang</td><td>:</td>
		 		</tr>


		 		<tr>
		 			<td>Nama / Spesifikasi Alat</td><td>:</td>
		 		</tr>

		 		<tr>
		 			<td>Laporan Kerusakan Awal</td><td>:</td>
		 		</tr>

		 		<tr>
		 			<td>Batas waktu perbaikan yang diminta</td><td>:</td>
		 		</tr>
		 		
		 		
		 		
		 	</table>
		 
		 
		 </div>
		 <div style="width: 50%;float: left;margin-left: 50%;">
		 	<table style="width: 100%;">
		 		<tr>
		 			<td>Nama / NIP / Pemesan / User</td><td>:</td><td>-</td>
		 		</tr>
		 		<tr>
		 			<td>SMF /  BAG / Bid/ Inst / Ruang</td><td>:</td>
		 		</tr>


		 		<tr>
		 			<td>Nama / Spesifikasi Alat</td><td>:</td>
		 		</tr>

		 		<tr>
		 			<td>Laporan Kerusakan Awal</td><td>:</td>
		 		</tr>

		 		<tr>
		 			<td>Batas waktu perbaikan yang diminta</td><td>:</td>
		 		</tr>
		 		
		 		
		 		
		 	</table>
		 
		 
		 </div>
	</div>
	<div style="width: 100%;float: left;display: block;">
		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
	</div> --}}
	<table  border="0" cellpadding="0" cellspacing="" width="80%"> 
		<tr>
			<td colspan="4">Surat Tugas Pemeliharaan / Perbaikan</td>
		</tr>
		<tr>
			<td colspan="2">Nomor : </td>
			<td colspan="2">SWAKELOLA</td>
		</tr>
		<tr >
			<td class="separed"></td>
			<td class="separed"></td>
			<td class="separed"></td>
			<td class="separed"></td>
		</tr>
		<tr>
			<td width="25%">Nama / NIP / Pemesan / USer</td>
			<td width="25%">: {{@$perbaikan->nama_pemesan}}</td>
			<td width="25%">Tindakan Perbaikan</td>
			<td width="25%">:{{$catatanPemeliharaan->tindakan}}</td>
		</tr>
		<tr>
			<td>SMF / BAG / Bid / Inst / Ruang</td>
			<td>: {{@$catatanPemeliharaan->ruangan->nama}}</td>
			<td>Suku cadang yang diperlukan</td>
			<td>:{{@$perbaikan->suku_cadang}}</td>
		</tr>

		<tr>
			<td>Nama / Spesifikasi Alat</td>
			<td>: {{$catatanPemeliharaan->data_alkes->alat->nama}}</td>
			
		</tr>
		<tr >
			<td class="separed"></td>
			<td class="separed"></td>
			<td class="separed"></td>
			<td class="separed"></td>
		</tr>
		<tr>
			<td>Laporan Kerusakan awal</td>
			<td>:{{$catatanPemeliharaan->keluhan}}</td>
			<td>Nilai dalam (rupiah)</td>
			<td>:{{number_format($catatanPemeliharaan->jumlah_biaya,0,'.','.')}}</td>
		</tr>
		<tr>
			<td colspan="2"></td>
			{{-- <td></td> --}}
			<td>Hasil perbaikan</td>
			<td>:{{@$perbaikan->hasil_perbaikan}}</td>
		</tr>
		<tr >
			<td class="separed"></td>
			<td class="separed"></td>
			<td class="separed"></td>
			<td class="separed"></td>
		</tr>
		<tr>
			<td>Batas waktu perbaikan yang diminta</td>
			<td>:{{@$perbaikan->batas_waktu_perbaikan}}</td>
			<td>Saran dari petugas</td>
			<td>:{{@$perbaikan->saran_dari_petugas}}</td>
		</tr>

	</table>	
	<hr>
	<table border="0" cellpadding="0" cellspacing="" width="100%" style="float: left;"> 
		
		<tr>
			<td width="20%">Terima oleh nama / NIP</td>
			<td width="20%">:{{@$catatanPemeliharaan->teknisi->nama}}</td>
			<td width="20%">Laporan keterangan </td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td>Sifat / Jenis Pekerjaan</td>
			<td>:{{@$catatanPemeliharaan->jenis_pekerjaan->nama}}</td>
			<td>Ka.SMF / Bid / Inst / Ruang</td>
			<td>: {{@$perbaikan->nama_smf_bag}}</td>
		</tr>

		<tr>
			<td>Catatan</td>
			<td>:{{@$perbaikan->catatan}}</td>
			<td>Mulai dikerjakan</td>
			<td>: {{tgl_indo($catatanPemeliharaan->mulai)}}</td>
			<td></td>
		</tr>
		<tr>
			<td colspan="2"></td>
			<td>Selesai dikerjakan</td>
			<td>: {{tgl_indo($catatanPemeliharaan->selesai)}}</td>
			<td></td>
		</tr>
		<tr >
			<td class="separed"></td>
			<td class="separed"></td>
			<td class="separed"></td>
			<td class="separed"></td>
			<td></td>
		</tr>

		<tr>
			<td>Pemberi tugas</td>
			<td>Kepala Instalasi Alat Kesehatan</td>
			<td style="text-align: right;" colspan="2">Pati,{{tgl_indo($catatanPemeliharaan->tanggal)}}</td>
			{{-- <td>:Hari / Tgl....................</td> --}}
			<td></td>
		</tr>
		<tr>
			<td>Pesan pemberi tugas</td>
			<td>: {{@$perbaikan->pesan_pemberi_tugas}}</td>
		</tr>
		<tr >
			<td class="separed"></td>
			<td class="separed"></td>
			<td class="separed"></td>
			<td class="separed"></td>
		</tr>
		<tr>
			<td valign="top">Diteruskan Kepada</td>
			<td valign="top">:{{$titik}}</td>
			<td align="center" valign="top" rowspan="2">
				Petugas Gudang
					<div style="height: 70px;">
						
					</div>
				( {{@$perbaikan->nama_petugas_gudang}} )
			</td>
			<td align="center" valign="top" rowspan="2">
				Penanggung Jawab
				<br> Tim/ Petugas Teknik
				
					<div style="height: 50px;">
						
					</div>
				( {{@$catatanPemeliharaan->teknisi->nama}} )
			</td>
			<td align="center" valign="top" rowspan="2">
				Mengetahui <br>	
				SMF / Bag / Bid / Inst
				
					<div style="height: 50px;">
						
					</div>
				({{@$perbaikan->nama_smf_bag}})
			</td>
		</tr>
		<tr>
			<td valign="top">Nama Petugas</td>
			<td valign="top">:
				<ol style="margin: 0; " type="1">
					@if ($perbaikanPetugas->count())
						{{-- expr --}}
						@foreach ($perbaikanPetugas->get() as $pp)
							{{-- expr --}}
							<li>{{$pp->petugas->nama}}</li>
						@endforeach
					@endif
				</ol>
			</td>
		</tr>

	</table>
</div>
</body>
</html>