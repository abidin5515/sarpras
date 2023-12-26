
@extends('layouts.app')
@section('title')
<h1>{{@$title}}</h1>
@endsection

@section('content')

<style type="text/css">
  span.select2-container {
    z-index: 0;
}
</style>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Cetak Label</h3>
            </div>


            <!-- /.card-header -->
            <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <a style="float: left;" target="_blank" class="btn btn-info" href="{{ url('cetak-label/semua') }}">Cetak Semua</a>
                    </div>
                  </div>
                  <hr>
                
                  <form method="get" action="{{ url('cetak-label') }}">
                    {{ csrf_field() }}
                  
                  <div class="row">
                    
                    <div class="col">
                      <label>Cetak Berdasarkan</label>
                      <select class="form-control filter-print" name="filter">
                        <option value="">-- Berdasarkan --</option>
                        <option {{ (@$_GET['filter']=='supplier' ? 'selected' : '') }} value="supplier">Supplier</option>
                        <option {{ (@$_GET['filter']=='alat' ? 'selected' : '') }} value="alat">Alat</option>
                        <option {{ (@$_GET['filter']=='ruangan' ? 'selected' : '') }} value="ruangan">Ruangan</option>
                      </select>
                    </div>
                    <div class="col">
                      <label>Tentukan</label>
                       <div id="isi-pilihan">
                          <p>Berdasarkan apa ?</p>
                        </div>   
                      
                    </div>

                    <div class="col">
                      <button style="margin-top: 30px" type="submit" class="btn btn-info"><i class="fas fa-filter"></i> Filter</button>
                    </div>
                    </form>
                  </div>
        <hr>  
                @php
                        $tipe = @$_GET['filter'] != '' ? $_GET['filter'] : 'supplier';
                        $id = @$_GET['id_val'];
                      @endphp
                      
                        @if ($tipe != '' && $id != '')
                            <center>
                          @if ($tipe == 'supplier')
                            @php
                                $sup = App\Supplier::where('id', $id)->first();
                              @endphp
                              <b>Menampilkan Supplier : {{ @$sup->nama }}</b>
                            @elseif($tipe == 'ruangan')
                              @php
                                $lok = App\Ruangan::where('id', $id)->first();

                              @endphp
                              <b>Menampilkan Lokasi : {{ @$lok->nama }}</b>
                            @elseif($tipe == 'alat') 
                              @php
                                $alat = App\Alat::where('id', $id)->first();

                              @endphp  
                              <b>Menampilkan Alat : {{ @$alat->nama }}</b> 
                            @endif
                          </center>
                        @endif
                        
                      
                <form id="form-cetak-custom" target="_blank" method="post" action="{{ url('cetak-label/customNew') }}">
                  {{ csrf_field() }}     
                  <table class="table table-striped" id="table">
                    <thead>
                        {{-- <th><input type="checkbox" id="select_all" name=""></th> --}}
                        <th>KODE</th>
                        <th>NAMA ALAT</th>
                        <th>RUANGAN</th>
                        <th>SUPPLIER</th>
                    </thead>

                    <tbody id="isi-data">
                        @php
                        $berdasar = @$_GET['filter'];
                        $id = @$_GET['id_val'];
                        
                        if($berdasar != ''){
                          if($berdasar == 'supplier'){
                            $wherenya = 'id_supplier';
                          }else if($berdasar == 'ruangan'){
                            $wherenya = 'id_ruangan';
                          }else {
                            $wherenya = 'id_alat';
                          }

                          $data = App\DataAlkes::where($wherenya,  $id)->get(); 
                        }else {
                          $data = null;
                        }  
                          

                        @endphp

                        @if ($data != null)
                         @foreach ($data as $element)
                           <tr id="{{@$element->id}}" data-id="{{@$element->id}}">
                             <td>{{@$element->kode}}</td>
                             <td>{{@$element->alat->nama}}</td>
                             <td>{{@$element->ruangan->nama}}</td>
                             <td>{{@$element->supplier->nama}}</td>
                           </tr>
                         @endforeach
                        
                        @endif
                    </tbody>
                  </table>
                    <button type="button" class="btn float-left btn-sm btn-warning tombol-get"> Cetak Terpilih </button>
                </form>
                <div id="example-console-rows"></div>
{{-- 
        <form id="form-cetak-custom" onsubmit="return false;">
  {{ csrf_field() }}     
      <table class="table table-striped" id="table">
        <thead>
          <th>@</th>
            <th>KODE</th>
            <th>NAMA ALAT</th>
            <th>RUANGAN</th>
            <th>SUPPLIER</th>

        </thead>

  <tbody>
  </tbody>
</table>



  <button type="submit" class="btn float-left btn-sm btn-warning"> Cetak Terpilih </button>
  </form> --}}
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

$(".select2-container").css('position', 'static');

$(document).ready(function(){
  var table = $("#table").DataTable({
"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
'columnDefs': [
      {
         'targets': 0,
         'checkboxes': {
            'selectRow': true
         }
      }
   ],
   'select': {
      'style': 'multi'
   },
   'order': [[1, 'asc']]
  });

  $('.tombol-get').on('click', function(e) {
    // alert('tes');
        var form = $("#form-cetak-custom");
        $('input[name="id_alkes\[\]"]', form).remove();
        var rows = $(table.rows({
            selected: true
        }).$('input[type="checkbox"]').map(function() {
            return $(this).prop("checked") ? $(this).closest('tr').attr('data-id') : null;
        }));
        //console.log(table.column(0).checkboxes.selected())
        // Iterate over all selected checkboxes
        rows_selected = [];
        $.each(rows, function(index, rowId) {
            console.log(index)
            // Create a hidden element 
            rows_selected.push(rowId);
            $(form).append(
                $('<input>')
                .attr('type', 'hidden')
                .attr('name', 'id_alkes[]')
                .val(rowId)
            );
        });

        form.submit();
        // e.preventDefault();
    });
});



// dat();
$(document).on('change', '.filter-print', function(){
  // alert('tes');
  var tipe = $(this).val();
  // alert(tipe);
  // $(".tentukan-pilihan").val(null).trigger('change');
  // $(".tentukan-pilihan").attr('data-url', "{{ url('') }}/"+tipe+"/select2");

  if(tipe != ''){
      $.ajax({
      url: '{{ url('filter-type') }}/'+tipe,
      type: 'GET',
      dataType: 'HTML',
      // data: form,
      success:function(res){
        // alert(res);
        $("#isi-pilihan").html(res);
        select2Load();
      }
    });
    }else {
      $("#isi-pilihan").html('<p>Berdasarkan apa ?</p>');
    }
}); 


// $(document).on('change', '.tentukan-pilihan', function(){
//   var tipe = $('.filter-print').val();
//   var id = $(this).val();
//     $.ajax({
//       'method':'POST',
//       'url':'{{ url('cetak-label/getData') }}',
//       dataType : 'JSON',
//       data:{tipe:tipe, id:id},
//       success:function(res){
//         var html = '';
//         var data = res.data;
//         if(data){
//           for (var i =0; i < data.length; i++) {
//             html+='<tr id='+data[i].idne+' data-id='+data[i].idne+'>';
//             // html+='<td>'+data[i].kode+'</td>';
//            html+='<td>'+data[i].nama_alat+'</td>';
//            html+='<td>'+data[i].lokasi+'</td>';
//            html+='<td>'+data[i].nama_supplier+'</td>';
//            html+='</tr>';
//           }
          
//         }else {
//           html+='<tr><td>KOSONG !</td></tr>';
//         }

//         $("#isi-data").html(html);
//       }
//     });
// });



// $('#select_all').click(function(e){
//     $(this).toggleClass('clicked');
//     $(this).closest('table').find('input[type="checkbox"]').prop('checked', $(this).hasClass('clicked'))
// });
// Handle form submission event
   // $('#form-cetak-custom').on('submit', function(e){
   //    var form = this;
   //    alert('tes');

   // });
</script>
@endpush


