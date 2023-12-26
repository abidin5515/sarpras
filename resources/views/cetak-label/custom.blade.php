<style type="text/css" media="all">
	@page { margin: 0px; }
	body { margin: 0px; }
	.kotak-label {
		width: 32.5%;
		margin: 3px; 
		float: left;
	}
	.kotak-label-atas {
		text-align: center;
		padding-top: 2px;
		padding-bottom: 2px;
		width: 100%;
		border: 1px solid #000;
		font-size: 14px;
	}
	.kotak-label-bawah {
		width: 100%;
		border-bottom: 1px solid #000;
		border-left: 1px solid #000;
		border-right: 1px solid #000;
		/*font-size: 20px;*/
	}
	.kotak-label-bawah table {
		font-size: 14px;
	}
</style>

<div style="width: 100%; ">

	@if ($data)
		@foreach ($data as $item)
			<div class="kotak-label">
				<div class="kotak-label-atas">
					<b>UPT RSUD RAA Soewondo Pati</b>
				</div>

				<div class="kotak-label-bawah">
					<table border="0" width="100%" cellpadding="0" cellspacing="0">
						<tr>
							<td style="padding: 2px; padding-left: 3px" width="60" rowspan="4"> 
								@php
										echo QrCode::size(50)->generate($item->kode);
									@endphp	
							 </td>
							<td style="padding-top: 3px" align="left"> {{ @$item->alat->nama }} </td>
						</tr>
						<tr>
							<td>tes nama</td>
						</tr>

						<tr>
							<td>tes nama</td>
						</tr>

						<tr>
							<td style="padding-bottom: 3px"> {{ @$item->nomor_seri }} </td>
						</tr>
					</table>
				</div>
			</div>
		@endforeach
	@endif
	
</div>

<script type="text/javascript">
	window.print();
</script>


