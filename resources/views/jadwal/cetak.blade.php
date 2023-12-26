<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		ul {
			margin: 0px;
			padding: 0px;
		}
		ul li {
			list-style: none;
		}
		ol li {
			padding: 3px;
		}
	</style>
</head>
<body>
	<center>
		<h2 style="margin-top: 0; padding-top: 0">JADWAL INSPEKSI & PEMELIHARAAN PREVENTIF ALAT KESEHATAN BULANAN <br/> INSTALASI ALAT KESEHATAN</h2>	
	</center>
	{{-- <br> --}}
	<table border="1" class="" style="width: 100%" cellpadding="2" cellspacing="0">
  <thead>
    <tr>
      <th width="4%" rowspan="2">NO</th>
      <th width="20%" rowspan="2">NAMA PETUGAS</th>
      <th colspan="4">MINGGU</th>
      <th width="18%" rowspan="2">KETERANGAN</th>
    </tr>
    <tr>
        <th>I</th>
        <th>II</th>
        <th>III</th>
        <th>IV</th>
    </tr>
      

  </thead>

  <tbody>
    @if ($data)
    @php
      $no=1;
    @endphp
      @foreach ($data as $val)
        <tr>
          <td valign="top">{{$no++}}.</td>
          <td valign="top">{{$val->petugas->nama}}</td>
          <td valign="top">
            @php
              $detail = App\JadwalDetail::where('id_jadwal', $val->id)->where('minggu', 1)->get();
            @endphp
            @if ($detail)
             <ul>
             @foreach ($detail as $element)
               <li>{{$element->ruangan->nama}}</li>
             @endforeach
              </ul>
            @endif
          </td>
          <td valign="top">
            @php
              $detail2 = App\JadwalDetail::where('id_jadwal', $val->id)->where('minggu', 2)->get();
            @endphp
            @if ($detail2)
             <ul>
             @foreach ($detail2 as $element)
               <li>{{$element->ruangan->nama}}</li>
             @endforeach
              </ul>
            @endif
          </td>
          <td valign="top">
            @php
              $detail3 = App\JadwalDetail::where('id_jadwal', $val->id)->where('minggu', 3)->get();
            @endphp
            @if ($detail3)
             <ul>
             @foreach ($detail3 as $element)
               <li>{{$element->ruangan->nama}}</li>
             @endforeach
              </ul>
            @endif
          </td>
          <td valign="top">
            @php
              $detail4 = App\JadwalDetail::where('id_jadwal', $val->id)->where('minggu', 4)->get();
            @endphp
            @if ($detail4)
             <ul>
             @foreach ($detail4 as $element)
               <li>{{$element->ruangan->nama}}</li>
             @endforeach
              </ul>
            @endif
          </td>
          <td valign="top">{{$val->keterangan}}</td>
          
        </tr>
      @endforeach
    @endif
  </tbody>
</table>
{{-- <br> --}}
<table width="100%" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td valign="top" width="70%">
			Ket :
			<ol type="1">
				<li>Jadwal ini bersifat umum untuk ruangan.
					<br>
					Sedangan jadwal iPP perorangan diatus dan disesuaikan dengan jadwal sendiri <br/> oleh masing-masing petugas Elektromedis Instalasi ALKES.
				</li>
				<li>Nomor hp yang bisa dihubungi :
					<br>
					<ol type="a">
						@foreach ($data as $element)
							<li>{{$element->petugas->nama }} : {{@$element->petugas->hp}}</li>
						@endforeach
					</ol>
				</li>
			</ol>
		</td>
		<td align="center">
			<b>Pati, {{@$bulannya}} {{@$_GET['tahun']}}</b>
			<br>
			<b>Kepala Instalasi Alat Kesehatan</b>
			<br>
      <center>
        <img width="80" src="{{url(@$kepala->kepala_teknisi->ttd)}}">
        <br>
        <b><u>{{@$kepala->kepala_teknisi->nama}}</u></b>
        <br>
      <b>NIP. {{@$kepala->kepala_teknisi->nip}}</b>  
      </center>
      
		</td>
	</tr>
</table>
</body>
</html>