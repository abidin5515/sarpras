  <aside class="main-sidebar sidebar-dark-success elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="{{ url('muhammadiyah.jpg') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-dark-light" style="font-size: 16px;">IPSRS

      </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
        {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block">Alexander Pierce</a>
          </div>
        </div> --}}

      <!-- SidebarSearch Form -->
      {{-- <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div> --}}

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          {{-- <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./index.html" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v1</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index2.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v2</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index3.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard v3</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="pages/widgets.html" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Widgets
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Layout Options
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">6</span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/layout/top-nav.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Top Navigation</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/top-nav-sidebar.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Top Navigation + Sidebar</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/boxed.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Boxed</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/fixed-sidebar.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Fixed Sidebar</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/fixed-sidebar-custom.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Fixed Sidebar <small>+ Custom Area</small></p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/fixed-topnav.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Fixed Navbar</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/fixed-footer.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Fixed Footer</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/collapsed-sidebar.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Collapsed Sidebar</p>
                </a>
              </li>
            </ul>
          </li> --}}
          {{-- <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Charts
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/charts/chartjs.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>ChartJS</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/charts/flot.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Flot</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/charts/inline.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Inline</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tree"></i>
              <p>
                UI Elements
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/UI/general.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>General</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/UI/icons.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Icons</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/UI/buttons.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Buttons</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/UI/sliders.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Sliders</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/UI/modals.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Modals & Alerts</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/UI/navbar.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Navbar & Tabs</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/UI/timeline.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Timeline</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/UI/ribbons.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Ribbons</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Forms
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/forms/general.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>General Elements</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/forms/advanced.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Advanced Elements</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/forms/editors.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Editors</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/forms/validation.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Validation</p>
                </a>
              </li>
            </ul>
          </li> --}}
          <br>
          <li class="nav-item">
            <a href="{{ url('/') }}" class="nav-link {{sidebar_active('')}}">
              <i class="fas fa-chart-line nav-icon"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          {{-- <br> --}}
          {{-- <br> --}}
          <li class="nav-item">
            <a href="{{ url('catatan-pemeliharaan') }}" class="nav-link {{sidebar_active('catatan-pemeliharaan')}} ">
              <i class="nav-icon fas fa-pen-alt"></i>
              <p>
                Catatan Perbaikan
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ url('data_ceklis') }}" class="nav-link {{sidebar_active('data_ceklis')}} ">
              <i class="nav-icon fas fa-pen-alt"></i>
              <p>
                Input Ceklis
              </p>
            </a>
          </li>


           <li class="nav-item">
            <a href="{{ url('permintaan') }}" class="nav-link {{sidebar_active('permintaan')}} ">
              <i class="nav-icon fas fa-exclamation-circle"></i>
              <p>
                Permintaan Pending
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ url('permintaan_selesai') }}" class="nav-link {{sidebar_active('permintaan_selesai')}} ">
              <i class="nav-icon fas fa-check-circle"></i>
              <p>
                Permintaan Selesai
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ url('jadwal_ipsrs') }}" class="nav-link {{sidebar_active('jadwal_ipsrs')}} ">
              <i class="nav-icon fas fa-calendar-check"></i>
              <p>
                Jadwal IPSRS
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ url('pengadaan') }}" class="nav-link {{sidebar_active('pengadaan')}} ">
              <i class="nav-icon fas fa-list"></i>
              <p>
                Pengadaan
              </p>
            </a>
          </li>
          
          <li class="nav-item">
            <a href="{{ url('inventaris') }}" class="nav-link {{sidebar_active('inventaris')}} ">
              <i class="nav-icon fas fa-list"></i>
              <p>
                Inventaris
              </p>
            </a>
          </li>
          <li class="nav-item data-master {{sidebar_parent_active(['teknisi','ruangan', 'master-barang','supplier','sumber-dana', 'master-merk','kepemilikan','alat','kategori-checklist','jenis-pekerjaan','roles','user'])['menu_open']}}">
            <a href="#" class="nav-link {{sidebar_parent_active(['teknisi','ruangan','supplier','sumber-dana','kepemilikan','alat','kategori-checklist','jenis-pekerjaan', 'master-merk','roles','user'])['active']}}">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Data Master
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              
              <li class="nav-item">
                <a href="{{ url('teknisi') }}" class="nav-link {{sidebar_active('teknisi')}} ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Master Teknisi</p>
                </a>
              </li>


          <li class="nav-item data-master {{sidebar_parent_active(['teknisi','ruangan','supplier','sumber-dana','kepemilikan','alat','kategori-checklist','jenis-pekerjaan','roles','user'])['menu_open']}}">
          <li class="nav-item">
            <a href="{{ url('ruangan') }}" class="nav-link {{sidebar_active('ruangan')}} ">
              <i class="far fa-circle nav-icon"></i>
              <p>Master Ruang</p>
            </a>
          </li>  

           <li class="nav-item">
            <a href="{{ url('master-merk') }}" class="nav-link {{sidebar_active('master-merk')}} ">
              <i class="far fa-circle nav-icon"></i>
              <p>Master Merk</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ url('master-barang') }}" class="nav-link {{sidebar_active('master-barang')}} ">
              <i class="far fa-circle nav-icon"></i>
              <p>Master Barang</p>
            </a>
          </li> 

          <li class="nav-item">
            <a href="{{ url('master_ceklis') }}" class="nav-link {{sidebar_active('master_ceklis')}} ">
              <i class="far fa-circle nav-icon"></i>
              <p>Master Ceklis</p>
            </a>
          </li> 


             @php
  $user = user();
  // $total_data_master =0;
  // $total_menu_master =0;
@endphp
              @if ($user->can('roles'))

              <li class="nav-item">
                <a href="{{ url('roles') }}" class="nav-link {{sidebar_active('roles')}} ">
                                    <i class="far fa-circle nav-icon"></i>

                  <p>Roles</p>
                </a>
              </li>

              @endif


    @if ($user->can('user'))

              <li class="nav-item">
                <a href="{{ url('user') }}" class="nav-link {{sidebar_active('user')}} ">
                                    <i class="far fa-circle nav-icon"></i>

                  <p>User</p>
                </a>
              </li>

              @endif
          </ul>
          </li>   





          {{-- <li class="nav-item data-master {{sidebar_parent_active(['teknisi','ruangan','supplier','sumber-dana','kepemilikan','alat','kategori-checklist','jenis-pekerjaan','roles','user'])['menu_open']}}">
            <a href="#" class="nav-link {{sidebar_parent_active(['teknisi','ruangan','supplier','sumber-dana','kepemilikan','alat','kategori-checklist','jenis-pekerjaan','roles','user'])['active']}}">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Data Master
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

@php
  $user = user();
  $total_data_master =0;
  $total_menu_master =0;
@endphp

  @if ($user->can('teknisi'))
              <li class="nav-item">
                <a href="{{ url('teknisi') }}" class="nav-link {{sidebar_active('teknisi')}} ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Teknisi</p>
                </a>
              </li>
<<<<<<< HEAD
  @endif -->
  @endif --}}
{{-- 
  @if ($user->can('ruangan'))


              <li class="nav-item">
                <a href="{{ url('ruangan') }}" class="nav-link {{sidebar_active('ruangan')}} ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Ruangan</p>
                </a>
              </li>
              @endif --}}
  {{-- @if ($user->can('supplier'))

              <li class="nav-item">
                <a href="{{ url('supplier') }}" class="nav-link {{sidebar_active('supplier')}} ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Suplier atau Vendor</p>
                </a>
              </li>
@endif

  @if ($user->can('sumber-dana'))

              <li class="nav-item">
                <a href="{{ url('sumber-dana') }}" class="nav-link {{sidebar_active('sumber-dana')}} ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Sumber Dana</p>
                </a>
              </li>
              @endif
  @if ($user->can('kepemilikan'))

              <li class="nav-item">
                <a href="{{ url('kepemilikan') }}" class="nav-link {{sidebar_active('kepemilikan')}} "  >
                  <i class="far fa-circle nav-icon"></i>
                  <p>Kepemilikan</p>
                </a>
              </li>
@endif

  @if ($user->can('alat'))

              <li class="nav-item">
                <a href="{{ url('alat') }}" class="nav-link {{sidebar_active('alat')}} ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Alat</p>
                </a>
              </li>

              @endif



  @if ($user->can('kategori-checklist'))



              <li class="nav-item">
                <a href="{{ url('kategori-checklist') }}" class="nav-link {{sidebar_active('kategori-checklist')}} ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Kategori Checklist</p>
                </a>
              </li>
              @endif


  @if ($user->can('jenis-pekerjaan'))

              <li class="nav-item">
                <a href="{{ url('jenis-pekerjaan') }}" class="nav-link {{sidebar_active('jenis-pekerjaan')}} ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Jenis Pekerjaan</p>
                </a>
              </li>

@endif
 --}}


    



            </ul>
          </li>
          {{-- <li class="nav-header">SUB MENU</li> --}}
      {{-- @if ($user->can('data-alkes'))

          <li class="nav-item">
            <a href="{{ url('data-alkes') }}" class="nav-link {{sidebar_active('data-alkes')}} ">
              <i class="nav-icon fas fa-x-ray"></i>
              <p>
                Data Alat Kesehatan
              </p>
            </a>
          </li>
          @endif --}}
          {{-- <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-plug"></i>
              <p>
                Kalibrasi
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('jadwal-kalibrasi') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Jadwal Kalibrasi</p>
                </a>
              </li>
              <!-- <li class="nav-item">
                <a href="{{ url('reminder-kalibrasi') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Reminder Kalibrasi</p>
                </a>
              </li> -->
              </ul>
              </li> --}}
          </li>
{{--           <li class="data-pemeliharaan nav-item {{sidebar_parent_active(['jadwal-pemeliharaan','catatan-pemeliharaan'])['menu_open']}}">
            <a href="#" class="nav-link {{sidebar_parent_active(['jadwal-pemeliharaan','catatan-pemeliharaan'])['active']}}">
              <i class="nav-icon fas fa-wrench"></i>
              <p>
                Pemeliharaan
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
      


            <ul class="nav nav-treeview">
              @if ($user->can('jadwal-pemeliharaan'))

                <li class="nav-item">
                <a href="{{ url('jadwal-pemeliharaan') }}" class="nav-link {{sidebar_active('jadwal-pemeliharaan')}} ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Jadwal Pemeliharaan</p>
                </a>
              </li>
              @endif
  @if ($user->can('catatan-pemeliharaan'))

           <li class="nav-item">
            <a href="{{ url('catatan-pemeliharaan') }}" class="nav-link {{sidebar_active('catatan-pemeliharaan')}} ">
              <i class="nav-icon fas fa-pen-alt"></i>
              <p>
                Catatan Pemeliharaan
              </p>
            </a>
          </li>
          @endif
              </ul>
              </li>
          </li>

            @if ($user->can('rekap'))
               <li class="data-pemeliharaan nav-item {{sidebar_parent_active(['rekap'])['menu_open']}}">
            <a href="#" class="nav-link {{sidebar_parent_active(['rekap'])['active']}}">
              <i class="nav-icon fas fa-file"></i>
              <p>
                Rekap
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
      


            <ul class="nav nav-treeview">
            

                <li class="nav-item">
                <a href="{{ url('rekap/kalibrasi') }}" class="nav-link {{sub_sidebar_active('kalibrasi')}} ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Kalibrasi</p>
                </a>
              </li>

           <li class="nav-item">
            <a href="{{ url('rekap/perbaikan') }}" class="nav-link {{sub_sidebar_active('perbaikan')}} ">
                                <i class="far fa-circle nav-icon"></i>

              <p>
                Perbaikan
                {{ <span class="badge badge-info right">2</span> --}}
             {{--  </p>
            </a>
          </li> --}} 
              <!-- <li class="nav-item">
                <a href="{{ url('reminder-kalibrasi') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Reminder Kalibrasi</p>
                </a>
              </li> -->
              {{-- </ul> --}}
              {{-- @endif --}}


{{-- @if ($user->can('jadwal'))

          <li class="nav-item">
            <a href="{{ url('jadwal') }}" class="nav-link {{sidebar_active('jadwal')}} ">
              <i class="nav-icon fas fa-calendar-week"></i>
              <p>
                Jadwal
              </p>
            </a>
          </li>
@endif
  @if ($user->can('catak-label'))

           
           <li class="nav-item">
            <a href="{{ url('cetak-label') }}" class="nav-link {{sidebar_active('cetak-label')}} ">
              <i class="nav-icon fas fa-print"></i>
              <p>
                Cetak Label
              </p>
            </a>
          </li>

@endif --}}
{{--   @if ($user->can('permintaan-pelayanan'))


           <li class="nav-item">
            <a href="{{ url('permintaan-pelayanan') }}" class="nav-link {{sidebar_active('permintaan-pelayanan')}} ">
              <i class="nav-icon fas fa-exclamation-triangle"></i>
              <p>
                Permintaan Pelayanan
              </p>
            </a>
          </li>
@endif --}}
 {{--  @if ($user->can('pengaturan_jabatan'))

          <li class="nav-item">
            <a href="{{ url('pengaturan_jabatan') }}" class="nav-link {{sidebar_active('pengaturan_jabatan')}} ">
              <i class="fas fa-users-cog nav-icon"></i>
              <p>
                Pengaturan Jabatan
              </p>
            </a>
          </li>
          @endif --}}
          {{-- <li class="nav-item">
            <a href="pages/gallery.html" class="nav-link">
              <i class="nav-icon far fa-image"></i>
              <p>
                Gallery
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-envelope"></i>
              <p>
                Mailbox
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/mailbox/mailbox.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Inbox</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/mailbox/compose.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Compose</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/mailbox/read-mail.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Read</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Pages
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/examples/invoice.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Invoice</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/examples/profile.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Profile</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/examples/e-commerce.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>E-commerce</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/examples/projects.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Projects</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/examples/project-add.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Project Add</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/examples/project-edit.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Project Edit</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/examples/project-detail.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Project Detail</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/examples/contacts.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Contacts</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-plus-square"></i>
              <p>
                Extras
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/examples/login.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Login</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/examples/register.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Register</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/examples/forgot-password.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Forgot Password</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/examples/recover-password.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Recover Password</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/examples/lockscreen.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Lockscreen</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/examples/legacy-user-menu.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Legacy User Menu</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/examples/language-menu.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Language Menu</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/examples/404.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Error 404</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/examples/500.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Error 500</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/examples/pace.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pace</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/examples/blank.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Blank Page</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="starter.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Starter Page</p>
                </a>
              </li>
            </ul>
          </li> --}}
          {{-- <li class="nav-header">MISCELLANEOUS</li>
          <li class="nav-item">
            <a href="https://adminlte.io/docs/3.0/" class="nav-link">
              <i class="nav-icon fas fa-file"></i>
              <p>Documentation</p>
            </a>
          </li>
          <li class="nav-header">MULTI LEVEL EXAMPLE</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fas fa-circle nav-icon"></i>
              <p>Level 1</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-circle"></i>
              <p>
                Level 1
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Level 2</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Level 2
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Level 3</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Level 3</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Level 3</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Level 2</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fas fa-circle nav-icon"></i>
              <p>Level 1</p>
            </a>
          </li>
          <li class="nav-header">LABELS</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-circle text-danger"></i>
              <p class="text">Important</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-circle text-warning"></i>
              <p>Warning</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-circle text-info"></i>
              <p>Informational</p>
            </a>
          </li> --}}


        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

