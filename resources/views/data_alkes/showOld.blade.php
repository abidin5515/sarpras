<table class="table table-striped" id="table-history" style="width: 100%">
  <thead>
    <th>Ruangan</th>
    <th>Tanggal Masuk</th>
    <th>Tanggal Keluar</th>
  </thead>
  <tbody>
  </tbody>
</table>

<script type="text/javascript">
	$('#table-history').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! url("alat/history/".$id) !!}',
        columns: [
          {data:'nama_ruangan',name:'ruangan.nama'},
          {data:'tgl_masuk',name:'tgl_masuk'},
          {data:'tgl_keluar',name:'tgl_keluar'},
     
        ]
    });
</script>