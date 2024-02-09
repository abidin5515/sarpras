  <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>IPSRS RS PKU MUHAMMADIYAH PAMOTAN</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="shortcut icon" href="{{ url('logo_rs.png') }}">
  <!-- Google Font: Source Sans Pro -->
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ url('plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
{{--   <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> --}}
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{ url('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  <link rel="stylesheet" href="{{ url('css/select2-bootstrap4.min.css') }}">

  <!-- iCheck -->
  <link rel="stylesheet" href="{{ url('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ url('plugins/jqvmap/jqvmap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ url('dist/css/adminlte.min.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ url('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ url('plugins/daterangepicker/daterangepicker.css') }}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ url('plugins/summernote/summernote-bs4.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ url("/src/sweetalert2/dist/sweetalert2.min.css") }}">


    <link rel="stylesheet" type="text/css" href="{{ url("/src/select2/dist/css/select2.min.css") }}">
    <link rel="stylesheet" type="text/css" href="{{ url("/src/select2-bootstrap-theme/dist/select2-bootstrap.min.css") }}">
    <link rel="stylesheet" type="text/css" href="{{ url("/src/style.css") }}">
    <link rel="stylesheet" type="text/css" href="{{ url("/fancybox/jquery.fancybox.css") }}">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
        <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic"> -->


    <link rel="stylesheet" type="text/css" href="{{ url("/src/select2/dist/css/select2.min.css") }}">
    <link rel="stylesheet" type="text/css" href="{{ url("/src/select2-bootstrap-theme/dist/select2-bootstrap.min.css") }}">

    <link rel="stylesheet" href="{{ url('css/handsontable.full.min.css') }}">

</head>
<body class="sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed pace-primary">
  <style type="text/css">
    * {
      font-size: 12px;
    }
    .dataTables_filter {
   width: 50%;
   float: right;
   text-align: right;
} 
  td {
    font-size: 12px;
  }
  .table td, .table th {
    border : 1px solid #cfd2d4;
  }

  .notifyjs-corner {
    margin-top: 100px !important;
}
  </style>
<div class="wrapper">

  <!-- Navbar -->
  @include('layouts.header')
  <!-- /.navbar -->


  <!-- Main Sidebar Container -->
  @include('layouts.sidebar')


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <br>
    <!-- konten -->
    @yield('content')


    <div class="modal fade" id="modal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel"></h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
  <center>

<div class="sk-chase">
  <div class="sk-chase-dot"></div>
  <div class="sk-chase-dot"></div>
  <div class="sk-chase-dot"></div>
  <div class="sk-chase-dot"></div>
  <div class="sk-chase-dot"></div>
  <div class="sk-chase-dot"></div>
</div>
  </center>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-primary save-btn">Save</button>
</div>
</div>
</div>
</div>

  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2023 IT RS PKU Muhammadiyah Pamotan</strong>
    {{-- All rights reserved. --}}
    <div class="float-right d-none d-sm-inline-block">
      {{-- <b>Version</b> 3.1.0-pre --}}
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<script src="{{ url('js/handsontable.full.min.js') }}"></script>
<!-- jQuery -->
<script src="{{ url('plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ url('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ url('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ url('plugins/chart.js/Chart.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ url('plugins/sparklines/sparkline.js') }}"></script>
<!-- JQVMap -->
<script src="{{ url('plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ url('plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ url('plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ url('plugins/moment/moment.min.js') }}"></script>
<script src="{{ url('plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ url('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Summernote -->
<script src="{{ url('plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ url('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ url('dist/js/adminlte.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ url('dist/js/demo.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
{{-- <script src="{{ url('dist/js/pages/dashboard.js') }}"></script> --}}



  <script src="{{ url("/src/datatables.net/js/jquery.dataTables.min.js") }}"></script>
  <script src="{{ url("/src/datatables.net-bs4/js/dataTables.bootstrap4.min.js") }}"></script>

  <script type="text/javascript" src="{{ url("/src/bootstrap-notify.min.js") }}"></script>
  <script src="{{ url("/src/sweetalert2/dist/sweetalert2.min.js") }}"></script>
  <script type="text/javascript" src="{{ url("/src/select2/dist/js/select2.min.js") }}"></script>
  <script type="text/javascript" src="{{ url("/src/crudify.min.js?time=".time()) }}"></script>
<script type="text/javascript" src="{{ url('js/pace.min.js') }}"></script>
<script type="text/javascript" src="{{ url('fancybox/jquery.fancybox.js') }}"></script>
<script type="text/javascript">
  $(document).ajaxStart(function() { Pace.restart(); });

</script>
<style type="text/css">
  .pace {
  -webkit-pointer-events: none;
  pointer-events: none;

  -webkit-user-select: none;
  -moz-user-select: none;
  user-select: none;
}

.pace-inactive {
  display: none;
}


.pace .pace-progress {
  background: #004770;
  position: fixed;
  z-index: 2000;
  top: 0;
  right: 100%;
  width: 100%;
  height: 2px;
}

   table thead th{
                  text-transform: uppercase;

                }

                table thead tr th{
    vertical-align: middle !important;

    text-align: center;
                }

</style>


  <script type="text/javascript" src="{{ url("js/dataTables.checkboxes.min.js") }}"></script>



  <script>
  //   $(document).ready(function(){

  //       $.ajax({
  //           method:"get",
  //           url:"{{ url('reminder-kalibrasi') }}",
  //           success:function(data){
  //                   // console.log(data);
  //               $(".auo").append(data);



  //           }
  //       });

  // });
      $(document).ready(function() {
      // alert('x');
        var dataMaster = $(".data-master .nav-treeview li").length;
        if(dataMaster==0){
          $(".data-master").hide();
        }

         var dataPemeliharaan = $(".data-pemeliharaan .nav-treeview li").length;
        if(dataPemeliharaan==0){
          $(".data-pemeliharaan").hide();
        }
        // console.log("dataMaster");
        // console.log(dataMaster);
    });


      $(document).on('change', '.edit', function(){
  var val = $(this).val();
  var tipe = $(this).attr('data-tipe');
  var shif = $(this).attr('data-shift');
  var id_master_ceklis = $(this).attr('data-id');
  var tanggal = $("#filter-tanggal").val();
  $.ajax({
    method:"post",
    url:"{{ url('data_ceklis/store_update') }}",
    data:{"_token": "{{ csrf_token() }}", val:val, tipe:tipe, shif:shif, id_master_ceklis, tanggal:tanggal},
    success:function(data){
        if(data.success){
          // $.notify("Access granted", "success");
        }else {
          // swal("Gagal!", data.msg, "danger");
        }
    }
  });
});

  </script>


<style type="text/css">
  table thead {
    background-color: #537188;
    text-transform: uppercase;
    color: #fff
  }


  .sidebar-dark-success .nav-sidebar>.nav-item>.nav-link.active, .sidebar-light-success .nav-sidebar>.nav-item>.nav-link.active {
    background-color :#537188;
  }

  .card-title {
    font-size: 18px;
  }
</style>
  @stack("scripts")

</body>
</html>
