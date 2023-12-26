<!DOCTYPE html>
<html lang="en">
<head>
  <style type="text/css">
    * {
      /*font-size: 12px;*/
    }
  </style>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>IPSRS RS PKU MUHAMMADIYAH PAMOTAN</title>
  <link rel="shortcut icon" href="{{ url('muhammadiyah.jpg') }}">
  <!-- Google Font: Source Sans Pro -->
  <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"> -->
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ url('plugins/fontawesome-free/css/all.min.css') }}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ url('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ url('dist/css/adminlte.min.css') }}">
  <link rel="stylesheet" href="{{ url('css/animate.min.css') }}">
</head>
<body class="hold-transition login-page" style="background-image: url({{ asset('bgn-1.png')  }}); background-position: center;
  background-repeat: no-repeat;
  background-size: cover;">
  <div>
    

<div class="login-box" style="margin: auto; margin-top: 20px; z-index: 999999; font-size: 20px;">
  <div class="login-logo">
    <img width="100" src="{{ url('logo_rs.png') }}">
    <br>
    <a style="color: #fff; font-size: 20px; margin: 0" href="{{ url('/') }}"><b>IPSRS</b></a>
    <span style="color:#fff; font-size: 16px; display: block; margin: 0">RS PKU Muhammadiyah Pamotan</span>
    
  </div>
  <!-- /.login-logo -->
  <div class="card" style="font-size: 12px;">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Silahkan Login</p>
      <form action="#" onsubmit="return false;" method="post" id="form" >
        {{ csrf_field() }}
        <div class="input-group mb-3">
          <input type="text" name="username" class="form-control" placeholder="Username" id="username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" id="pass" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row mb-3">
          <div class="col-12" style="text-align: right;">
            {{-- <div class="icheck-primary"> --}}
              <input type="checkbox" name="" id="show-hide"> Lihat password
              <label for="remember">
                {{-- lihat password --}}
              </label>
            {{-- </div> --}}
          </div>
        </div>
        
        <div class="row">
          {{-- <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div> --}}
          <!-- /.col -->
          <div class="col-6">
            <a href="{{ url('/minta') }}">Form Ruangan</a>
          </div>
          <div class="col-6">
            <button type="submit" class="btn btn-primary btn-block submit">Masuk</button>
            
          </div>
          <!-- /.col -->
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
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{ url('plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ url('js/bootstrap-notify.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ url('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ url('dist/js/adminlte.min.js') }}"></script>
<script type="text/javascript">
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
  $(document).on('click', '.submit', function() {
            var data = $("#form").serialize();
            $(".submit").attr('disabled','disabled');
            // event.preventDefault();
            $.ajax({
                url:"{{ url('masuk') }}",
                method: "POST",
                data: data,
                dataType: "JSON",
                success:function(res){
                    $(".submit").removeAttr('disabled');
                    if (res.success) {
                      window.location = '{{ url('/') }}';
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

</script>
  </div>
</body>
</html>
