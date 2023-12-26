<form action="{{url("master-barang/".$data->id)}}"  enctype="multipart/form-data" method="post"  id="form">

{{csrf_field()}}
{{method_field("PUT")}}

<div class="form-group">
<label>Nama Barang</label>
<input type='text' style="text-transform:uppercase" autocomplete="false" class='form-control nama' name='nama' value='{{@$data->nama}}'>
</div>

<div class="form-group">
<label>Kode <i><small>Digunakan untuk kode nomor seri</small></i></label>
<input type='text' style="text-transform:uppercase" autocomplete="false" class='form-control kode' name='kode' value='{{@$data->kode}}'>
</div>
    
</form>



<script type="text/javascript">
  $(document).on('keyup', '.nama', function () {
    var val = $(this).val();
    $(".kode").val(val);
  });
</script>