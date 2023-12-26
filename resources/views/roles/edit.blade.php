
@extends('layouts.app')
@section('title')
<h1>{{@$title}}</h1>
@endsection

@section('content')



    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Roles</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              
                     <form action="{{url("roles/".$data->id)}}"   method="post"  id="form">

{{csrf_field()}}
{{method_field("PUT")}}

{{-- <div class="form-group">
<label>name</label>
<input type='text' class='form-control' name='name' value='{{$data->name}}'>
</div> --}}
<div class="form-group">
<label>title</label>
<input type='text' class='form-control' name='title' value='{{$data->title}}'>
</div>




<table class="table">
  <tr>
    <td>
      
         <div class="custom-control custom-checkbox">
                          <input class="custom-control-input" type="checkbox" id="checkAll" name="role[]">
                          <label for="checkAll" class="custom-control-label">Pilih Semua</label>
                        </div>


    </td>
  </tr>
  @foreach ($abilities->get() as $ab)
    {{-- expr --}}
    <tr>
      {{-- <td>{{$ab->title}}</td> --}}
      <td>
        <div class="custom-control custom-checkbox">
                          <input {{in_array($ab->id,$userArr) ? 'checked':''}} class="custom-control-input" type="checkbox" id="{{$ab->id}}" value="{{$ab->name}}" name="role[]">
                          <label for="{{$ab->id}}" class="custom-control-label">{{$ab->title}}</label>
                        </div>
      </td>
    </tr>
  @endforeach
</table>



<input type="hidden" name="roleId" value="{{$roleId}}">
<button data-redirect-to="{{url("roles/")}}"  class="btn btn-primary save-btn" data-redirect="true">Update</button>
</form>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

         
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>

    
                @endsection



@push('scripts')
<script type="text/javascript">
  $("#checkAll").click(function(){
    $('input:checkbox').not(this).prop('checked', this.checked);
});

</script>
  {{-- expr --}}
@endpush