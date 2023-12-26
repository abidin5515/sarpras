
@extends('layouts.app')
@section('title')
<h1>{{@$title}}</h1>

@endsection

@section('content')

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header">

              <h3 class="card-title">jadwal_pemeliharaan</h3>
            </div>
            <form id="form_simpan">
            <!-- /.card-header -->
            <div class="card-body">
                <div class="col-md-4 offset-8">
                <div class="form-group">
		            <label for="bulan">Bulan</label>
		            <select name="bulan" id="bulan" class="form-control">
                    <?php
foreach ($bulan as $key => $value) {
    ?><option value="<?php echo $key; ?>" <?php echo $key == $bulans ? 'selected' : ''; ?>><?php echo $value; ?></option><?php
}
?>
		            </select>
		          </div>
		          <div class="form-group">
		            <label for="tahun">Tahun</label>
		            <select name="tahun" id="tahun" class="form-control">
                     <?php
for ($x = 2017; $x <= date('Y'); $x++) {
    ?><option value="<?php echo $x; ?>" <?php echo $x == $tahuns ? 'selected' : ''; ?>><?php echo $x; ?></option><?php
}
?>
		            </select>
		          </div>
		          <div class="form-group">
		            <label for="alat">alat</label>
		            <select name="alat" id="alat" class="form-control">
		              <option value="">Semua alat</option>
		              <?php
foreach ($alat as $key => $value) {
    ?><option value="<?php echo $value->id; ?>" <?php echo $value->id == @$_GET['alat'] ? 'selected' : ''; ?>><?php echo $value->nama; ?></option><?php
}
?>
		            </select>
		          </div>
                  </div>
                  <table border="1px" width="100%" style="margin-bottom: 10px;">
      	<thead>
      		<tr>
      			<th rowspan="2">No</th>
      			<th rowspan="2">Kode Alat</th>
            <th rowspan="2">Nama</th>
            <th rowspan="2">Ruang</th>
      			<th colspan="<?php echo $day; ?>">Tanggal</th>
      		</tr>
          <tr>
            <?php
for ($i = 1; $i <= $day; $i++) {
    ?><th><?php echo $i; ?></th><?php
}
?>
          </tr>
      	</thead>
      	<tbody>
      		<?php
$no = $offset + 1;
foreach ($proses as $key => $data) {
    $kode = $data['kode'];

    $hari_libur = [];
    $d_jadwal = $data['hari_jadwal'];

    foreach ($d_jadwal as $kekey => $valval) {
        $hari_libur[] = $valval;
    }
    ?>
      				<tr>
      					<td align="center"><?php echo $no; ?></td>
                <td><?php echo $data['kode']; ?></td>
                <td><?php echo $data['nama_alat']; ?></td>
              	<td><?php echo $data['nama_ruang']; ?><input type="hidden" name="kode[]" id="kode_<?php echo $data['kode']; ?>" value="<?php echo $data['kode']; ?>" readonly="true"></td>
                <?php
for ($i = 1; $i <= $day; $i++) {
        $checked = '';
        if (in_array($i, $hari_libur)) {
            $checked = 'checked="true"';
        }
        ?>
                    <td>
                    	<input type="checkbox"  name="jadwal[<?php echo $data['kode']; ?>][]" value="<?php echo $i; ?>" class="cekbok" id="checkbox_<?php echo $data['kode']; ?>" data-id="<?php echo $data['kode']; ?>" data-tanggal="<?php echo $i; ?>" <?php echo $checked; ?> onclick="return false;">
                    </td>
                    <?php
}
    ?>
      				</tr>
      			<?php
$no++;
}
?>
      	</tbody>
      </table>
      <!-- <div class="row">
        <div class="col-md-6">
          Halaman &nbsp;
          <?php
              $link = "http://$_SERVER[HTTP_HOST]/alkes/public/jadwal-kalibrasi?";
              if (isset($_GET['bulan'])) {
                  $link .= '&bulan=' . $_GET['bulan'];
              }

              if (isset($_GET['tahun'])) {
                  $link .= '&tahun=' . $_GET['tahun'];
              }

              for ($x = 1; $x <= $jumlah_page; $x++) {
                  ?><a href="<?php echo $link . '&page=' . $x; ?>"><?php echo $x; ?></a> | <?php
              }
              ?>
        </div>
        <div class="col-md-6">
          <button id="simpan" type="submit" class="btn btn-primary" style="float: right;">Simpan</button>
        </div>
      </div> -->

            </div>
            </form>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->


          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    </section>


                @endsection



@push('scripts')

<script>
$(document).ready(function() {
    console.log('ready');
		$(document).on('change', '#bulan, #tahun, #alat', function(){
			var bulan = $('#bulan').val();
			var tahun = $('#tahun').val();
			var alat = $('#alat').val();

			window.location = '?bulan='+bulan+'&tahun='+tahun+'&alat='+alat;
		});

		// $(document).on('click', '#simpan', function(){
		// 	var bulan = $('#bulan').val();
		// 	var tahun = $('#tahun').val();

		// 	console.log(bulan + ' == ' + tahun);
		// });

    $(document).on('submit', '#form_simpan', function(e){
      e.preventDefault();
      $.ajax({
        url: 'jadwal-kalibrasi/store',
        dataType: 'json',
        type: 'post',
        data: $(this).serialize(),
        success: function(data) {
          if(data.success) {
            alert('Data berhasil disimpan');
          } else {
            alert('Data gagal disimpan');
          }

          location.reload();
        },
        error: function(xhr) {
          console.log(xhr.status);
        }
      });
    });
	});
</script>
@endpush


