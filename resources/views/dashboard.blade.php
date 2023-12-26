@extends('layouts.app')

@section('content')
 {{-- <style type="text/css">
  .content-wrapper {
    background: linear-gradient( rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.2) ), url({{url('bg.jpeg')}});
  -webkit-background-size: cover;
  -moz-background-size:  cover;
  -o-background-size: cover;
  background-size: cover;
  }
</style> --}}

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-light">Dashboard</h1>
          </div><!-- /.col -->
          {{-- <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item text-light"><a style="color: white" href="#">Home</a></li>
              <li class="breadcrumb-item active text-light">Dashboard</li>
            </ol>
          </div><!-- /.col --> --}}
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content" >
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{@$jumlah_alkes}}</h3>

                <p>Alat Kesehatan</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="{{url('data-alkes')}}" class="small-box-footer">Info Lebih <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          {{-- <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>53<sup style="font-size: 20px">%</sup></h3>

                <p>Bounce Rate</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div> --}}
          <!-- ./col -->
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{@$jumlah_permintaan}}</h3>

                <p>Permintaan Pelayanan (Belum di tinjau)</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="{{url('permintaan-pelayanan')}}" class="small-box-footer">Info Lebih <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          {{-- <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>65</h3>

                <p>Unique Visitors</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div> --}}
          <!-- ./col -->
      </div>
      </div>
      
    </section>
    <!-- /.content -->
@endsection