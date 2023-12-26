
	
@foreach ($kategoriChecklist as $kc)
	{{-- expr --}}

<table class="table table-borderless wrapper-{{$kc->id}}">
	<thead>
		<th colspan="3">{{$kc->nama}}</th>
	</thead>

     @if (!empty($checklistGroup))
          {{-- expr --}}
               @php
                    $num=1;
                    $nums=1;
                    $numss=1;
                    $numm=1;
                    $nummm=1;
                    $numb=1;
                    $nux=1;
                    $nuxxx=1;
                    $nuxxxx=1;
                    $nummx =2;
                    $numss =1;

                    // print_r($last)
               @endphp
          @foreach ($checklistGroup[$kc->id] as $index => $v)
               {{-- expr --}}
               @php
                    $last = count($checklistGroup[$kc->id]);
                    
               @endphp
          <tr id="{{$kc->id}}-{{$num++}}" class="tr">
          <td><center><span class="nums-{{$numss++}} num-{{$kc->id}}">{{$nums++}}</span></center></td>
          <td><input data-cat-id="{{$kc->id}}" type="text" class="form-control checklist  checklist-{{$kc->id}} checklist-{{$kc->id}}-{{$nummm++}}" data-last="{{$numb++==$last?'true':''}}" data-target="wrapper-{{$kc->id}}" data-id="{{$kc->id}}-{{$numm++}}" name="checklist[{{$kc->id}}][{{$nux++}}][name]" value="{{$v['nama']}}">
               <input type="hidden" name="checklist[{{$kc->id}}][{{$nuxxx++}}][id]" value="{{$v['id']}}" class="hiddenn">

          </td>
          <td>
               @if ($nuxxxx++>1)
               <button data-cat-id="{{$kc->id}}" data-target="wrapper-{{$kc->id}}" data-edit="true" data-id="{{$kc->id}}-{{$nummx++}}"  class="btn btn-danger remove_field btn-sm"><i class="fas fa-trash"></i></button>

                    {{-- expr --}}


               @endif
          </td>
     </tr>


          @endforeach
     @else

     <tr id="{{$kc->id}}-1">
          <td><center><span class="num-{{$kc->id}}">1</span></center></td>
          <td><input data-cat-id="{{$kc->id}}" type="text" class="form-control checklist  checklist-{{$kc->id}} checklist-{{$kc->id}}-1" data-last="true" data-target="wrapper-{{$kc->id}}" data-id="{{$kc->id}}-1" name="checklist[{{$kc->id}}][][name]"></td>
          <td>
            

          </td>
     </tr>
     @endif
</table>
@endforeach

<button class="btn btn-primary btn-save">Simpan</button>
