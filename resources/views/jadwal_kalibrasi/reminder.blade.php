<?php if(@$reminder){ ?>
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge"><?php echo sizeof($reminder)?></span>
        </a>
       
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        @foreach($reminder as $reminder)
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="{{$reminder['gambar']}}" alt="User Avatar" style="width:50px;height:50px;margin-right:10px;" class="img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  <b>{{$reminder['nama_alat']}}</b> ({{$reminder['kode_alat']}})
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p> Reminder Kalibrasi</p>
                <p class="text-sm"><span style="color:red"> Mendekati tanggal kalibrasi</span></p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i><b> {{$reminder['waktu']}}</b></p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          @endforeach
       
          <a href="#" class="dropdown-item dropdown-footer">Close</a>
        </div>
      </li>
    <?php } ?>