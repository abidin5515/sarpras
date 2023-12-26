<style type="text/css">
	.left{
		text-align: left;;
	}
</style>

<label>
	<input type="checkbox" name="" class="active-checklist-delete" >
	Aktifkan Penghapusan Checklist
</label>


<table class="table table-bordered" border="1">

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
				<th class="left">{{$key}}</th>
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
				@php
					$indexxx= 1;
				@endphp
				@foreach ($d1 as $indexx=>$key2)
					{{-- expr --}}

@php
	$rand = Str::random(10);
@endphp

										<td class="hovere" data-target="{{$rand}}_1">



						<center>

							<div class="icheck-primary d-inline">
                        <input class="radios radio-{{$rand}}_1" type="radio" id="{{$key2['id']}}_{{$indexx+1}}_1" name="nama_checklist[{{$key2['id_kategori']}}][{{$key2['id']}}][{{$indexx+1}}]"  value="1-{{$key2['idne']}}" {{$key2['status']=='1'?'checked':""}}>
                        <label for="{{$key2['id']}}_{{$indexx+1}}_1">
                        </label>
<br>
                                                 <button data-target="{{$rand}}_1" type="button" style="display: none;" class="btn btn-danger btn-xs btn-hover-{{$rand}}_1 btn-hover"><i class="fas fa-times"></i></button>



                      </div>
						</center>
					

					</td>
					<td class="hovere" data-target="{{$rand}}_2">
						<center>

							<div class="icheck-primary d-inline">
                        <input class="radios radio-{{$rand}}_2" type="radio" id="{{$key2['id']}}_{{$indexx+1}}_2" name="nama_checklist[{{$key2['id_kategori']}}][{{$key2['id']}}][{{$indexx+1}}]"  value="2-{{$key2['idne']}}" {{$key2['status']=='2'?'checked':""}}>
                        <label for="{{$key2['id']}}_{{$indexx+1}}_2">
                        </label>
                        <br>
                         <button data-target="{{$rand}}_2" type="button" style="display: none;" class="btn btn-danger btn-xs btn-hover btn-hover-{{$rand}}_2"><i class="fas fa-times"></i></button>

                       @php
                       	

                       @endphp
                      </div>
						</center>
					</td>


				@endforeach
			</tr>

			@endforeach


	@endforeach
@endif

@if ($MaintenanceInspection->count())
	{{-- expr --}}
	<tr>
	<td>DILAKUKAN TANGGAL</td>
	@foreach ($MaintenanceInspection->get() as $mi)
		{{-- expr --}}
		<td colspan="2"><input type="date" name="date[{{$mi->id}}][]" class="form-control" value="{{$mi->tanggal}}"></td>

	@endforeach

</tr>
@endif

@if ($MaintenanceInspection->count())
	{{-- expr --}}

<tr>
	<td>NAMA & TANDA TANGAN TEKNISI</td>
	@foreach ($MaintenanceInspection->get() as $mix)
	
		{{-- expr --}}
		<td colspan="2">
			<center>
				<div style="width: 60px;height: 60px;">
					@if (!empty($mix->ttd_teknisi))
						{{-- expr --}}
											<img src="{{url($mix->ttd_teknisi)}}" class="teknisi-{{$mix->id}}" style="width: 100%;height:100%;" >


			<input type="hidden" name="teknisiData[{{$mix->id}}][ttd][]" class="form-control ttd-teknisi-{{$mix->id}}" value="{{$mix->ttd_teknisi}}">
											@else
			
			<img src="" class="teknisi-{{$mix->id}}" style="width: 100%;height:100%;display: none;" >
			<input type="hidden" name="teknisiData[{{$mix->id}}][ttd][]" class="form-control ttd-teknisi-{{$mix->id}}">
					@endif

				</div>
			</center>
			<select class="form-control select2 teknisi" data-target="teknisi-{{$mix->id}}" name="teknisiData[{{$mix->id}}][id][]" data-url="{{ url('teknisi/select2') }}">
				@if (!empty($mix->id_teknisi))
					{{-- expr --}}
					<option value="{{$mix->id_teknisi}}">{{$mix->teknisi->nama}}</option>
				@endif
			</select>
		</td>

	@endforeach
	

<tr>
	<td>NAMA & TANDA TANGAN USER</td>
	@foreach ($MaintenanceInspection->get() as $mixx)
		{{-- expr --}}
		<td colspan="2">

			<center>
				<div style="width: 60px;height: 60px;">

				</div>
			</center>
			<input type="text" name="user[{{$mixx->id}}][]" class="form-control" value="{{@$mixx->user}}">
		</td>

	@endforeach
</tr>
</tr>
@endif
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