@if ($data)
<br>
	<table class="table" style="background-color: #FFBB5C; color: #000">
		<tr>
			<th>Perbaikan</th>
			<th>Teknisi</th>
			<th>Foto</th>
		</tr>
		@foreach ($data as $d)
			<tr>
				<td valign="top">{{ @$d->perbaikan }}</td>
				<td valign="top">
					@php
						$b= preg_split("/[,]/",$d->id_teknisi);
		                  $a = '';
		                  foreach ($b as $v) {
		                    $a .= ambil_teknisi($v).', ';
		                  }
		                echo @$a;
					@endphp
				</td>
				<td valign="top"><img width="60px" src="{{ url(@$d->foto) }}"></td>
			</tr>
		@endforeach
	</table>
@endif