

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
              <h3 class="card-title">Input Form Penggunaan Generator Set</h3> 
              <div class="card-tools">
                <a class="btn btn-warning" href="{{ URL::previous() }}"><i class="fas fa-arrow-left" ></i> KEMBALI</a>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form action="{{ url('penggunaan_genset') }}" id="form" enctype="multipart/form-data">
                <div class="row">
            		<div class="col-lg-6">
            			<div class="form-group">
                            <label>Start</label>
                            <input type="datetime-local" name="start" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Selesai</label>
                            <input type="datetime-local" name="selesai" class="form-control">
                        </div>
                        <div class="form-group">
            				<label>VOL</label>
                            <input type="text" name="vol" class="form-control" value="">
            			</div>
            			<div class="form-group">
            				<label>FREK</label>
            				<input type="text" name="frek" class="form-control" value="">
            			</div>
            			<div class="form-group">
            				<label>SUHU</label>
            				<input type="text" name="suhu" class="form-control" value="">

            			</div>
                        

                    <br>
            		</div>

            		<div class="col-lg-6">
                        <div class="form-group">
                            <label>AMP</label>
                            <input type="text" name="amp" class="form-control" value="">
                        </div>

                        <div class="form-group">
                            <label>Petugas <a href="{{ url('teknisi') }}">(<u>Lihat Master Teknisi Disini</u>)</a></label><br>
                            @foreach ($teknisi as $r)
                                <input type="checkbox" class="" name="id_teknisi[]" value="{{$r->id}}"> {{ $r->nama }}
                                <br>
                            @endforeach
                            {{-- <input type="" name="">     --}}
                        </div>
            		   
            			<div class="form-group">
            				<label>Jumlah BBM Terakhir</label>
            				<input type="text" name="bbm_terakhir" class="form-control" value="">
            			</div>

                        <div class="form-group">
            				<label>Keterangan</label>
            				<textarea name="keterangan" class="form-control"></textarea>
            			</div>

            		</div>
                   
            	</div>
            </form>
            <button data-redirect="true" data-redirect-to="{{ route('penggunaan_genset.index') }}" class="btn btn-primary save-btn">Simpan</button>

            <a class="btn btn-warning" href="{{ URL::previous() }}"><i class="fas fa-arrow-left" ></i> KEMBALI</a>
            </div>
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

