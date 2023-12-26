<!DOCTYPE html>
<html>
<head>
	<title>Inventaris</title>
	<style type="text/css">
		th, td, b {
			font-size: 12px;
		}
		/*th {
		    background-color: #537188;
		    color: #fff
		  }*/
	</style>
</head>
<body>
	<center>
		<b>Daftar Inventaris</b>
		<h4 style="margin: 0">RS PKU Muhammadiyah Pamotan</h4>
	</center>
<br>
<table border="1" cellspacing="0" width="100%" id="table">
  <tr>
    <th>No</th>
    <th>Nama Barang</th>
    <th>Merk</th>
    <th>Tipe</th>
    <th>Kapasitas</th>
    <th>Nomor Seri</th>
    <th>Ruang</th>
    <th>Jumlah</th>
    <th>Kondisi</th>
    <th>Keterangan</th>
  </tr>

  <tbody>
  	@if ($data)
  		@php
  			$no = 1;
  		@endphp
  		@foreach ($data as $r)
  			<tr>
  				<td>{{ $no++ }}</td>
  				<td>{{ @$r->masterbarang->nama }}</td>
  				<td>{{ @$r->mastermerk->nama }}</td>
  				<td>{{ @$r->tipe }}</td>
  				<td>{{ @$r->kapasitas }}</td>
          <td>{{ @$r->nomor_seri }}</td>
  				<td>{{ @$r->masterruang->nama }}</td>
  				<td>{{ @$r->jumlah }}</td>
  				<td>{{ @$r->kondisi }}</td>
  				<td>{{ @$r->keterangan }}</td>
  			</tr>
  		@endforeach
  	@endif
  </tbody>
</table>
</body>
</html>