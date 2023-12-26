@extends('layouts.app')
@section('title')
<h1>{{@$title}}</h1>
@endsection

@section('content')



    <!-- Main content -->
<section class="content">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Tambah Alat</h3>
              <div class="card-tools">
                {{-- <a class="btn create-btn btn-primary" href="{{ url('alat/create') }}" data-title="Tambah">+ TAMBAH</a> --}}
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              
            <form action="#" method="post" onsubmit="return false;"  enctype="multipart/form-data"  id="forms">

            {{csrf_field()}}
            {{-- {{method_field("PUT")}} --}}

            <div class="row">
            	<div class="col-lg-6">
            		
              <div class="form-group">
              <label>Nama Alat</label>
              <input type="hidden" name="id_alat" value="{{@$data->id}}">
              <input type='text' class='form-control' name='nama' value='{{@$data->nama}}'>
              </div>

              <div class="wrap-result">

  
@foreach ($kategoriChecklist as $kc)
  {{-- expr --}}

<table class="table table-borderless wrapper-{{$kc->id}}">
  <thead>
    <th colspan="3">{{$kc->nama}}</th>
  </thead>

     @if (!empty(@$checklistGroup))
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

               @if (!empty($checklistGroup[$kc->id]))
                 {{-- expr --}}
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
                <tr id="{{$kc->id}}-{{$num++}}" class="tr">
          <td><center><span class="nums-{{$numss++}} num-{{$kc->id}}">{{$nums++}}</span></center></td>
          <td><input data-cat-id="{{$kc->id}}" type="text" class="form-control checklist  checklist-{{$kc->id}} checklist-{{$kc->id}}-{{$nummm++}}" data-last="{{$numb++==$last?'true':''}}" data-target="wrapper-{{$kc->id}}" data-id="{{$kc->id}}-{{$numm++}}" name="checklist[{{$kc->id}}][{{$nux++}}][name]" value="">
               <input type="hidden" name="checklist[{{$kc->id}}][{{$nuxxx++}}][id]" value="" class="hiddenn">

          </td>
          <td>
               @if ($nuxxxx++>1)
               <button data-cat-id="{{$kc->id}}" data-target="wrapper-{{$kc->id}}" data-edit="true" data-id="{{$kc->id}}-{{$nummx++}}"  class="btn btn-danger remove_field btn-sm"><i class="fas fa-trash"></i></button>

                    {{-- expr --}}


               @endif
          </td>
     </tr>
               @endif
          
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

              </div>
            	
              </div>
            </div>
            		
            </form>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

         
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
</section>

    
                @endsection



@push('scripts')
<script>
$(document).ready(function() {
  var max_fields      = 10; //maximum input boxes allowed
  var wrapper       = $(".input_fields_wrap"); //Fields wrapper
  var add_button      = $(".add_field_button"); //Add button ID
    
  var x = 1; //initlal text box count
  $(add_button).click(function(e){ //on add input button click

    var target = $(this).attr('data-target');
    var wrapper = $("."+target);

    var length =$("."+target+' tr').length;

    var n = length-1+1;
    var last = $('.'+target+' tr:last').attr('id');
    // alert(last);

    // alert(length);
    e.preventDefault();
    if(x < max_fields){ //max input box allowed
      x++; //text box increment
      $(wrapper).append('<tr><td><center>'+n+'</center></td><td><input type="text" class="form-control" name=""></td><td><button class="btn btn-danger remove_field">-</button></td></tr>'); //add input box
    }
  });
  
  // $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
  //  // e.preventDefault(); $(this).parent('div').remove(); x--;
  //  alert("x");
  // })
});

function add_event(evt){

  
  // event.preventDefault();
  var id = evt.attr('data-id');
  var catId = evt.attr('data-cat-id');
  var target = evt.attr('data-target');
    var wrapper = $("."+target);

    var length =$("."+target+' tr:visible').length;

    var n = length-1+1;
  // alert(target);
  var is_last= evt.attr('data-last');

  if(is_last=="true"){
    $(".checklist-"+catId).removeAttr('data-last');


    var html = '<tr id="'+catId+'-'+n+'"><td><center><span class="num-'+catId+'">'+n+'</span></center></td><td><input data-cat-id="'+catId+'" type="text" class="form-control checklist checklist-'+catId+'-'+n+' checklist-'+catId+'" data-last="true" data-target="wrapper-'+catId+'" data-id="'+catId+'-'+n+'" name="checklist['+catId+']['+n+'][name]"></td><td><button data-cat-id="'+catId+'" data-target="wrapper-'+catId+'" data-id="'+catId+'-'+n+'"  class="btn btn-danger remove_field btn-sm"><i class="fas fa-trash"></i></button></td></tr>';

    $(wrapper).append(html); //add input box
  }
}


$(document).on('change', '.checklist', function() {
  // add_event($(this));
  add_event($(this));
  
});


$(document).on('click', '.checklist', function() {

  add_event($(this));
});

$(document).on('click', '.remove_field', function() {
  // event.preventDefault();
  var edit = $(this).attr('data-edit');


  var id = $(this).attr('data-id');
  var target = $(this).attr('data-target');

  // alert(id);
  var catId = $(this).attr('data-cat-id');
  var total = $(".num-"+catId).length;
  // console.log(total);

  // return;
  // return;
if(edit !=null){
  $("#"+id).hide();
  var v =  $("#"+id+" .hiddenn").val();
  $("#"+id+" .hiddenn").val(v+'-__delete');
  $("#"+id).removeAttr('class');

  $("#"+id+" span").removeAttr('class');
  // console.log(id);

  }
  else{
  $("#"+id).remove();

  } 

  $("tr:visible .checklist-"+catId).removeAttr('data-last');

  var last = $('.'+target+' tr:visible:last').attr('id');
  // console.log(last);
  // console.log("X");
  //  console.log(catId);
  //  return; 
  $("tr:visible .checklist-"+last).attr('data-last', 'true');
  // alert(last);



  $(".num-"+catId).each(function(index, el) {
    $(this).text(index+1);
  });
  /* Act on the event */
});
$(document).on('click','.btn-save',function(){
  var form = $("#forms").serialize();

  // console.log(form);
  $.ajax({
    url: '{{ url('alat').'/'.Request::segment(2) }}/update',
    type: 'POST',
    dataType: 'JSON',
    data: form,
  })
  .done(function(res) {
    if(res.success){

           
$.notify({
  // options
  message: res.msg
},{
  // settings
  z_index:100000,
  type: 'success'
});

window.location.href = '{{ url('alat') }}';
    }
    else{

$.notify({
  // options
  message: res.msg
},{
  // settings
  z_index:100000,
  type: 'danger'
});
    }
  })
  .fail(function() {
    console.log("error");
  })
  .always(function() {
    console.log("complete");
  });
  

});
3
</script>
@endpush


