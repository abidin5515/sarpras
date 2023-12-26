
@extends('layouts.app')


@section('content')
 <style type="text/css">
 	span.select2-container {
    z-index: 0;
}
 </style>

    <!-- Main content -->
    <section class="content">
    	<div class="card">
            <div class="card-header">
              <h3 class="card-title">Akun</h3>
            </div>
            <!-- /.box-header -->
            <div class="card-body">
            	
      <div class="container-fluid">
        <form style="width: 100%" action="{{url("akun/update")}}" method="post" id="form" enctype="multipart/form-data">

		{{csrf_field()}}

		<div class="col-lg-12">
			<div class="row">
				<div class="col-md-6">
					<fieldset>
						<div class="form-group row">
						<label class="col-sm-4 col-form-label">Username</label>
						<div class="col-sm-7">
							<input type="hidden" name="id_user" value="{{@$data->id}}">
						<input type="text" class="form-control" name="username" value="{{@$data->username}}">
						</div>
						</div>

						<div class="form-group row">
						<label class="col-sm-4 col-form-label">Password</label>
						<div class="col-sm-7">
						<input type="password" class="form-control" id="pass" name="password" value="">
						</div>
						</div>

						<div class="form-group row">
						<label class="col-sm-4 col-form-label"></label>
						<div class="col-sm-7">
						<input type="checkbox" name="" id="show-hide"> lihat password
						</div>
						</div>

						</fieldset>
				</div>


				
			</div>

		</div>
		</form>
	      <div class="row">
	      	<div class="col-lg-12">
	      		<button type="submit" data-redirect="true" data-redirect-to="{{ url('akun') }}" class="btn btn-primary save-btn"> SIMPAN</button>
	      	</div>
	      	
	      </div>  
      </div><!-- /.container-fluid -->
            </div>
        </div>

    </section>
    <!-- /.content -->

@endsection

@push('scripts')
<script>

$(document).on('change', '#show-hide', function(){
	if(this.checked) {
           $("#pass").attr('type', 'text'); 
        }else {
        	$("#pass").attr('type', 'password');
        }
});


</script>
@endpush

