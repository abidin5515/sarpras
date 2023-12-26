<label>
	<input type="checkbox" name="" class="active-checklist-delete" >
	Aktifkan Penghapusan Checklist
</label>


<table class="table table-bordered">
@if ($KategoriChecklist->count())
	{{-- expr --}}
	@foreach ($KategoriChecklist as $index=> $k)
		{{-- expr --}}
		@if ($index==0)
			{{-- expr --}}
			<tr>
				<th rowspan="2">{{$k->nama}}</th>
				@for ($i = 0; $i < $checklist_qty ; $i++)
<td colspan="2"><center>{{$i+1}}</center></td>
				@endfor

			
		</tr>
				@for ($i = 0; $i < $checklist_qty ; $i++)
<td><center>Baik</center></td>
<td><center>Tidak Baik</center></td>
				@endfor


{{-- 	<tr>
			<th rowspan="2">{{$k->nama}}</th>
				@for ($i = 0; $i < $checklist_qty ; $i++)
<th><center>Baik</center></th>
<th><center>Tidak Baik</center></th>
				@endfor

		</tr> --}}
	{{-- 	<tr>
				@for ($i = 0; $i < $checklist_qty ; $i++)
<td colspan="2">{{$i+1}}</td>
				@endfor

			
		</tr> --}}
		@else
		<tr>
			<th colspan="3">{{$k->nama}}</th>
		</tr>
		@endif
			
		@php
			$checklists = App\Checklist::where('id_kategori_checklist',$k->id)->where('id_alat',$id_alat);
		@endphp
		@foreach ($checklists->get() as $indexx => $kc)
			{{-- expr --}}


							
			<tr>
				<td>{{$kc->nama}}

					<input type="hidden" name="nama_checklist[{{$k->id}}][nama][]" value="{{$kc->nama}}">
					<input type="hidden" name="nama_checklist[{{$k->id}}][id][]" value="{{$kc->id}}">

				</td>
				@for ($i = 0; $i < $checklist_qty ; $i++)
					{{-- expr --}}
					@php
	$rand = Str::random(10);
@endphp

			
															<td class="hovere" data-target="{{$rand}}_1">


						<center>

							<div class="icheck-primary d-inline">
                        <input  class="radios radio-{{$rand}}_1"  type="radio" id="{{$kc->id}}_{{$i}}_1" name="nama_checklist[{{$k->id}}][value][{{$indexx}}][{{$i}}]"  value="1">
                        <label for="{{$kc->id}}_{{$i}}_1">
                        </label>

<br>
			<button data-target="{{$rand}}_1" type="button" style="display: none;" class="btn btn-danger btn-xs btn-hover btn-hover-{{$rand}}_1"><i class="fas fa-times"></i></button>



                      </div>
						</center>
					

					</td>
															<td class="hovere" data-target="{{$rand}}_2">
						<center>
							<div class="icheck-primary d-inline">
                        <input class="radios radio-{{$rand}}_2"  type="radio" id="{{$kc->id}}_{{$i}}_2" name="nama_checklist[{{$k->id}}][value][{{$indexx}}][{{$i}}]" value="2">
                        <label for="{{$kc->id}}_{{$i}}_2">
                        </label>

<br>

				<button data-target="{{$rand}}_2" type="button" style="display: none;" class="btn btn-danger btn-xs btn-hover btn-hover-{{$rand}}_2"><i class="fas fa-times"></i></button>

                      </div>
						</center>
					</td>
				@endfor
			</tr>
		@endforeach
	@endforeach
@endif
<tr>
	<td>DILAKUKAN TANGGAL</td>
	@for ($ix = 0; $ix < $checklist_qty; $ix++)
		{{-- expr --}}
		<td colspan="2"><input type="date" name="date[{{$ix}}][]" class="form-control"></td>

	@endfor
</tr>

<tr>
	<td>NAMA & TANDA TANGAN TEKNISI</td>
	@for ($ixx = 0; $ixx < $checklist_qty; $ixx++)
		{{-- expr --}}
		<td colspan="2">
			<center>
				<div style="width: 60px;height: 60px;">
					<img src="" class="teknisi-{{$ixx}}" style="width: 100%;height:100%;display: none;" >
				</div>
			</center>
			<select class="form-control select2 teknisi" data-target="teknisi-{{$ixx}}" name="teknisiData[{{$ixx}}][id][]" data-url="{{ url('teknisi/select2') }}"></select>
			<input type="hidden" name="teknisiData[{{$ixx}}][ttd][]" class="form-control ttd-teknisi-{{$ixx}}">
		</td>

	@endfor
</tr>

<tr>
	<td>NAMA & TANDA TANGAN USER</td>
	@for ($ixxx = 0; $ixxx < $checklist_qty; $ixxx++)
		{{-- expr --}}
		<td colspan="2">

			<center>
				<div style="width: 60px;height: 60px;">

				</div>
			</center>
			<input type="text" name="user[{{$ixxx}}][]" class="form-control">
		</td>

	@endfor
</tr>
</table>





<style type="text/css">
	.btn-group-xs > .btn, .btn-xs {
  padding: .25rem .4rem;
  font-size: .875rem;
  line-height: .5;
  border-radius: .2rem;
}
</style>
<script type="text/javascript">

	// active-checklist-delete



	$(document).on('click', '.active-checklist-delete', function() {
		// event.preventDefault()

		/* Act on the event */
	});
	


	
	$(".hovere").on({
    mouseenter: function () {

			if($(".active-checklist-delete").is(':checked')){


    	var target=$(this).attr('data-target');

    	// alert(target);
    	console.log(".btn-hover-"+target);
    	$(".btn-hover-"+target).show();
			}

        //stuff to do on mouse enter
    },
    mouseleave: function () {
        //stuff to do on mouse leave

        $(".btn-hover").hide();
    }
});



$(document).on('click', '.btn-hover', function() {
	// event.preventDefault();
	var data = $(this).attr('data-target');

	// alert(data);
	$(".radio-"+data).prop('checked', false);
	/* Act on the event */
});
</script>