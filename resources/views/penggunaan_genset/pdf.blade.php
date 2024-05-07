<!DOCTYPE html>
<html>
<head>
	<title>Form Penggunaan Generator Set</title>
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
	table td, th {
		font-size: 11px;
	}
    table td{
        padding: 2px;
    }
</style>

<center>
	<h4 style="margin: 0">FORM PENGGUNAAN GENERATOR SET</h4>
	<h3 style="margin: 0">RS PKU MUHAMMADIYAH PAMOTAN</h3>
</center>



<div style="width: 100%;margin-top: 20px;">
	<table class="full-width" border="1" style="border-collapse: collapse;">
		<tr>
			<th>START</th>
            <th>SELESAI</th>
            <th>VOL</th>
            <th>FREK</th>
            <th>SUHU</th>
            <th>AMP</th>
            <th>PETUGAS</th>
            <th>JUMLAH <br>BBM TERAKHIR</th>
            <th>KETERANGAN</th>
		</tr>
		
			@php
			$no = 1;
			@endphp
			@foreach ($data as $r)
				<tr>
					<td valign="top">{{@date('d-m-Y H:i', strtotime($r->start))}}</td>
                    <td valign="top">{{@date('d-m-Y H:i', strtotime($r->selesai))}}</td>
					<td valign="top">{{@$r->vol}}</td>
					<td valign="top">{{@$r->frek}}</td>
					<td valign="top">{{@$r->suhu}}</td>
					<td valign="top">{{@$r->amp}}</td>
					<td valign="top">
						@php
							if ($r->petugas) {
						        $b= preg_split("/[,]/",$r->petugas);
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
					<td valign="top">{{@$r->bbm_terakhir}}</td>
					<td valign="top">{{@$r->keterangan}}</td>
					
				</tr>
			@endforeach	
		
		
	</table>
</div>

</body>
</html>