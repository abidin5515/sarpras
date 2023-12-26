<!DOCTYPE html>
<html>
<head>
	<title></title>
	    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>


</head>
<body>
	<style type="text/css">
	.check { font-family: DejaVu Sans; }
		.full-width{
			width: 100%;
			/*white-space: nowrap;*/
		}
		.collapse{
			border-collapse: collapse;;
		}

		.nopaddingmargin{
		padding: 0;
		margin: 0;
	}
	.only-border-bottom{
		border-bottom: 1px solid #000;
	}


	.table__only-border-bottom tr td{
		border-bottom: 1px solid #000;
	}
	.tabelll tr td{
		padding: 1px;
	}
	.tabel-right tr td{
		padding: 1px;
	}
	.table__right tr td{
/*		padding: 0;
		margin: 0;*/
			/*border-left: 1px solid #00;*/
	}
	.table-detail {
    border-collapse: collapse;
}
.table-detail td, .table-detail th {
    border: 1px solid black;
}
.table-detail tr:first-child th {
    border-top: 0;
}
.table-detail tr:last-child td {
    border-bottom: 0;
}
.table-detail tr td:first-child,
.table-detail tr th:first-child {
    border-left: 0;
}
.table-detail tr td:last-child,
.table-detail tr th:last-child {
    border-right: 0;
}
.dua td{
	/*border: 1px solid #fff;*/
	/*bori*/
}
.left-border{
	padding-left: 10px;
	border-left: 1px solid #000;
}

.right-border{
	/*padding-right: 1px solid #000;*/
	border-right: 1px solid #000;
}
.with-padding tr td{
	padding: 5px;
}
	</style>
	<table class="full-width collapse" border="1">
		<tr>
			<td rowspan="2" style="width: 15%;"></td>
			<td >
				<center>
					<h2 class="nopaddingmargin">RSUD RAA SOEWONDO PATI</h2>
					<B>INSTALASI ALAT KESEHATAN</B>
				</center>
			</td>
		<td rowspan="2" style="width: 15%;"></td>
		</tr>
		<tr>
			<td>
			<center>
				<b>Lembar Kerja Inspeksi dan Pemeliharaan Alat Kesehatan</b>
			</center>
			<br>
			</td>
		</tr>
		<tr class="dua">
			<td colspan="3" class="nopaddingmargin">
				<table class="full-width collapse" border="0"  cellspacing ="0">
					<tr>
						<td class="nopaddingmargin" style="width: 50%">
								
							<table class="full-width  table__only-border-bottom"  border="" cellspacing ="0" border="">

								<tr class=" ">
									<td class=""  style="width:50%;">Nama Alat</td>
									<td class="right-border" >: {{$catatanPemeliharaan->data_alkes->alat->nama}}</td>
								</tr>

								<tr class="">
									<td class=" ">Merek</td>
									<td class=" ">: {{$catatanPemeliharaan->data_alkes->merk}}</td>
								</tr>

								<tr class=" ">
									<td class="">Model / Type</td>
									<td class=" ">: {{$catatanPemeliharaan->data_alkes->tipe}}</td>
								</tr>

								<tr class="">
									<td class=" ">No. Seri</td>
									<td class=" ">: {{$catatanPemeliharaan->data_alkes->nomor_seri}}</td>
								</tr>
								<tr class=" ">
									<td class=" " colspan="2" >
									<center><b>CHECKLIST</b></center>
									</td>
								</tr>
							</table>
						</td>
						<td class="nopaddingmargin">
							
							<table class="full-width  table__only-border-bottom table__right" style="margin: 0;padding: 0;" border="" cellspacing ="0">
								<tr class=" ">
									<td class=" left-border" style="width: 20%;">No. Invent</td>
									<td colspan="2" class=" " style="width: 50%;">: 
										{{-- {{$catatanPemeliharaan->data_alkes->no_invent}} --}}
1.3.2.07.001.001.169.000004
									</td>
								</tr>

								<tr class="">
									<td class="  left-border">Ruang</td>
									<td colspan="2" class=" ">: {{$catatanPemeliharaan->data_alkes->ruangan->nama}}</td>
								</tr>

								<tr class=" ">
									<td class="  left-border">Masa Kalibrasi s/d</td>
									<td colspan="2" class=" ">: {{date('d-m-Y',strtotime($catatanPemeliharaan->masa_kalibrasi))}}</td>
								</tr>

								<tr class=" ">
									<td class="  left-border">Interval Pemeliharaan</td>
									<td colspan="2" class=" ">: {{$catatanPemeliharaan->interval_pemeliharaan}}</td>
								</tr>

								<tr class=" ">
									<td class="  left-border">Tahun</td>
									<td colspan="2" class=" ">: {{$catatanPemeliharaan->tahun}}</td>
								</tr>


							</table>
						</td>
						
					</tr>
					
					

				</table>
<style type="text/css">
	.left{
		text-align: left;
	}
</style>
<table class="full-width collapse" border="1">
@if (!empty($values))
	{{-- expr --}}
	@php
		$num =0;
	@endphp
	@foreach ($values as $key =>$d)
		{{-- expr --}}
		


			@if ($num++==0)
				{{-- expr --}}

			<tr>
				<th></th>
				@for ($i = 0; $i < $columns; $i++)

				<th colspan="2">{{$i+1}}</th>
				@endfor
			</tr>
				<tr>
				<th class="left" >{{$key}}</th>
				@for ($i = 0; $i < $columns; $i++)
					{{-- expr --}}
					<th>Baik</th>
					<th>Tidak Baik</th>
				@endfor
			</tr>
				@else
				<tr>
				<th class="left" colspan="7">{{$key}}</th>
			</tr>
			@endif

			@foreach ($d as $key1 => $d1)
				{{-- expr --}}
				<tr>
				<td>
					{{$key1}}
				</td>
				@foreach ($d1 as $indexx=>$key2)
					{{-- expr --}}



					<td>


						<center>

						

                      @if ($key2['status']=='1')
                      	{{-- expr --}}
                      	<span class="check">✔</span>
                      	@else

                      @endif
						</center>
					

					</td>
					<td>
						
						<center>
						
                      @if ($key2['status']=='2')
                      	{{-- expr --}}
                      	<span class="check">✔</span>
                      	@else

                      @endif
						</center>
					</td>


				@endforeach
			</tr>

			@endforeach


	@endforeach
@endif
				{{-- 	<tr>
						<td colspan="2">
							<center><b>VISUAL CHECK</b></center>
						</td>
						<td><center>BAIK</center></td>
						<td><center>TIDAK BAik</center></td>
					</tr>
					<tr>
						<td style="width: 1%">
							<center>1</center>
						</td>
						<td style="width: 38.5%;">CEK KODNISI VISIK</td>
						<td></td>
						<td>
					<center><span class="check">✔</span></center>

						</td>
					</tr>
					<tr>
						<td style="width: 1%">
							<center>1</center>
						</td>
						<td>CEK KODNISI VISIK</td>
						<td></td>
						<td></td>
					</tr>
					<tr>
						<td style="width: 1%">
							<center>1</center>
						</td>
						<td>CEK KODNISI VISIK</td>
						<td></td>
						<td></td>
					</tr> --}}
				</table>
			</td>
		</tr>



	</table>
<br>
<br>
<table class="full-width collapse with-padding"  border="1">
	
@if ($MaintenanceInspection->count())
	{{-- expr --}}


	{{-- expr --}}
	<tr>
	<td>DILAKUKAN TANGGAL</td>
	@foreach ($MaintenanceInspection->get() as $mi)
		{{-- expr --}}
		<td colspan="2"><center>{{date('d-m-Y',strtotime($mi->tanggal))}}</center></td>

	@endforeach

</tr>

<tr>
	<td>NAMA & TANDA TANGAN TEKNISI</td>
	@foreach ($MaintenanceInspection->get() as $mix)
	
		{{-- expr --}}
		<td colspan="2">
			<center>
				<div style="width: 60px;height: 60px;text-align: center;float: none;margin:0 auto;">
					@if (!empty($mix->ttd_teknisi))
						{{-- expr --}}
											<img src="{{url($mix->ttd_teknisi)}}" class="teknisi-{{$mix->id}}" style="width: 100%;height:100%;" >


											@else
											<img src="" class="teknisi-{{$mix->id}}" style="width: 100%;height:100%;display: none;" >
											
					@endif

				</div>
			</center>
				@if (!empty($mix->id_teknisi))
					{{-- expr --}}
					<center>{{$mix->teknisi->nama}}</center>
				@endif
		</td>

	@endforeach
</tr>	

<tr>
	<td>NAMA & TANDA TANGAN USER</td>
	@foreach ($MaintenanceInspection->get() as $mixx)
		<td colspan="2">

			<center>
				<div style="width: 60px;height: 60px;">

				</div>
			{{$mixx->user}}

			</center>
		</td>

	@endforeach
</tr>

@endif
</table>

<br>
<div style="width: 100%;float: left;display: none;">
	<div style="width: 20%;float: left;">
		CATATAN :
	</div>
	<div style="width: 80%;float: left;margin-left: 20%;">
		
	</div>
</div>
</body>
</html>