<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"> 
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>IPSRS</title>
  <style type="text/css">
    * {
      /*font-size: 12px;*/
    }
    input {
      font-size: 12px;
    }
  </style>
  <link rel="shortcut icon" href="{{ asset('logo_rs.png') }}">
  <!-- Google Font: Source Sans Pro -->
  <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"> -->
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ url('plugins/fontawesome-free/css/all.min.css') }}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ url('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
      <link rel="stylesheet" type="text/css" href="{{ url("/src/select2/dist/css/select2.min.css") }}">
    <link rel="stylesheet" type="text/css" href="{{ url("/src/select2-bootstrap-theme/dist/select2-bootstrap.min.css") }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ url('dist/css/adminlte.min.css') }}">
  <link rel="stylesheet" href="{{ url('css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ url('css/select2-bootstrap4.min.css') }}">
  <style type="text/css">
    .error {
      color: red;
    }
  </style>
</head>
<body class="hold-transition login-page" style="background-image: url({{ asset('bgn-1.png')  }}); background-position: center;
  background-repeat: no-repeat;
  background-size: cover;">
  <div>
    

<div class="row" style="margin: auto; margin-top: 40px; z-index: 999999; font-size: 12px;">
  <div class="login-logo col-md-12">
    <img width="100" src="{{ asset('logo_rs.png') }}">
    <br>
    <span style="font-size: 20px;"><a style="color: #fff" href="{{ url('/') }}">IPSRS</a></span>

    <span style="color: #fff; font-size: 15px;display: block; margin-top: 0">Input Permintaan</span>
    
  </div>
  <!-- /.login-logo -->
  </div>
  <div class="row" style="font-size: 12px;">
    <div class="col-md-12">
        <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Data yang sudah terkirim tidak bisa dihapus, masukkan data yang benar !</p>
      <center>
        <a href="{{ url('show_jadwal_ipsrs') }}" target="_blank" class="btn btn-info">Lihat Jadwal IPSRS</a>
      </center>
      <br>

      @if(session()->has('message'))
          <div class="alert alert-success">
              {{ session()->get('message') }}
          </div>
      @endif

      @if(session()->has('error'))
          <div class="alert alert-danger">
              {{ session()->get('message') }}
          </div>
      @endif
      <form action="{{ url('minta/store') }}" onsubmit="{{ url('minta/store') }}" method="post" id="form" enctype="multipart/form-data">
        {{ csrf_field() }}
         
        {{-- <div class="form-group">
          <label>Tanggal :</label>
          <br>
          <input type="date" name="tanggal" value="{{ old('tanggal') }}" class="form-control"> 
            @error('tanggal')
              <span class="error">{{ $errors->first('tanggal') }}</span>
            @enderror 
        </div>

        <div class="form-group">
          <label>Unit/Pengirim:</label>
          <br>
          <input type="text" name="pengirim" value="{{ old('pengirim') }}" class="form-control">  
            @error('pengirim')
              <span class="error">{{ $errors->first('pengirim') }}</span>
            @enderror
        </div>   --}}

        <div class="form-group">
          <label>Ruangan:</label>
          <select class="form-control" name="id_ruang" id="id_ruang">
            <option value="">-- Pilih Ruang --</option>
            @if ($ruangan)
              @foreach ($ruangan as $d)
                <option value="{{ $d->id }}">{{ $d->nama }}</option>
              @endforeach
            @endif
          </select>
        </div>

        <div class="form-group">
          <label>Uraian Masalah:</label>
          <br>
          <textarea name="masalah" class="form-control" placeholder="Uraian Masalah">{{ old('masalah') }}</textarea>
            @error('masalah')
              <span class="error">{{ $errors->first('masalah') }}</span>
            @enderror
        </div>

        <div class="form-group">
          <label>Photo :</label>
          <input type="file" name="foto" class="form-control" placeholder="Photo" value="{{ old('foto') }}">
            @error('foto')
                <span class="error">{{ $errors->first('foto') }}</span>
            @enderror
        </div>

       {{--  <div class="form-group">
          <label>Lokasi:</label>
          <input type="text" name="lokasi" class="form-control" placeholder="lokasi">
          
        </div> --}}

        {{-- <div class="form-group">
          <label>Lantai:</label>
          <select class="form-control" name="lantai">
            <option value="">-- Pilih Lantai --</option>
            <option {{ (@old('lantai' == 'Basemant' ? 'selected' : '')) }} value="Basemant">Basemant</option>
            <option {{ (@old('lantai' == 'Lantai 1' ? 'selected' : '')) }} value="Lantai 1">Lantai 1</option>
            <option {{ (@old('lantai' == 'Lantai 2' ? 'selected' : '')) }} value="Lantai 2">Lantai 2</option>
            <option {{ (@old('lantai' == 'Lantai 3' ? 'selected' : '')) }} value="Lantai 3">Lantai 3</option>
          </select>
            @error('lantai')
              <span class="error">{{ $errors->first('lantai') }}</span>
            @enderror
        </div> --}}

        <div class="row">
          <div class="col-6">
            <a style="" class="" href="{{ url('/login') }}"><u>Login Admin</u></a>
            
          </div>

          <div class="col-6 float-right">
            <button style="" type="submit" class="btn btn-primary btn-block">KIRIM</button>
          </div>
        </div>

      </form>

    {{--   <div class="social-auth-links text-center mb-3">
        <p>- OR -</p>
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
        </a>
      </div> --}}
      <!-- /.social-auth-links -->

      {{-- <p class="mb-1">
        <a href="forgot-password.html">I forgot my password</a>
      </p>
      <p class="mb-0">
        <a href="register.html" class="text-center">Register a new membership</a>
      </p> --}}
    </div>
    <!-- /.login-card-body -->
  </div>
    </div>
  </div>


<!-- /.login-box -->

<!-- jQuery -->
<script src="{{ url('plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ url('js/bootstrap-notify.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ url('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ url('dist/js/adminlte.min.js') }}"></script>
 <script type="text/javascript" src="{{ url("/src/select2/dist/js/select2.min.js") }}"></script>
<script type="text/javascript">
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
  $(document).on('click', '.submit', function() {
            // var data = $("#form").serialize();
            // var dataform = new FormData(data);
            var form_data = new FormData($("#form")[0]);
            $(".submit").attr('disabled','disabled');
            // event.preventDefault();
            $.ajax({
                url:"{{ url('/minta/store') }}",
                method: "POST",
                data: form_data,
                dataType: "JSON",
                processData: false,
                contentType: false,
                success:function(res){
                    // $(".submit").removeAttr('disabled');
                    if (res.success) {
                      $.notify({message: 'Data berhasil dikirim'},{type: 'success'})
                      
                      setTimeout(function() {
                          window.location.reload();
                      }, 5000);
                    }
                    else{
                      $.notify({message: res.msg},{type: 'danger'});
                    }

                },
                error:function(){
                  $.notify({message: 'Terjadi kesalahan'},{type: 'danger'});
                }
            })
            /* Act on the event */
        });

$(document).on('change', '#show-hide', function(){
  if(this.checked) {
           $("#pass").attr('type', 'text'); 
        }else {
          $("#pass").attr('type', 'password');
        }
});


$('div.alert').delay(3000).slideUp(300);


    $(document).ready(function() {
        $('#id_ruang').select2();
    });

</script>
  </div>
</body>
</html>
