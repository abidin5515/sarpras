<form action="{{url("master-barang")}}" method="post"  enctype="multipart/form-data"  id="form">

{{csrf_field()}}


<div class="form-group">
<label>Nama Barang</label>
<input type='text' style="text-transform:uppercase" autocomplete="false" class='form-control nama' name='nama' value=''>
</div>

<div class="form-group">
<label>Kode <i><small>Digunakan untuk kode nomor seri</small></i></label>
<input type='text' style="text-transform:uppercase" autocomplete="false" class='form-control kode' name='kode' value=''>
</div>
		
</form>



<script type="text/javascript">
  $(document).on('keyup', '.nama', function () {
    var val = $(this).val();
    $(".kode").val(val);
  });
</script>