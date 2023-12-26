@if ($type=='1')
	{{-- expr --}}
	     <div class="form-group">
                                <label>Teknisi</label>
                                <select class="form-control select2" data-url="{{ url('teknisi/select2') }}" name="teknisi">
                                
                                @if (!empty($value))
                                    {{-- expr --}}
                                    <option selected="" value="{{$value}}">{{$catatanPemeliharaan->teknisi->nama}}</option>
                                @endif
                                </select>
          </div>

@elseif($type=='2')
<div class="form-group">
                                <label>Bengkel Rujukan</label>
                                <input type="text" name="bengkel_rujukan" class="form-control" value="{{$value}}">
                            </div>
@elseif($type=='3')

     <div class="form-group">
                                <label>Pihak ke III</label>
                                <select class="form-control select2" data-url="{{ url('supplier/select2') }}" name="vendor">
                                @if (!empty($value))
                                    {{-- expr --}}
                                    <option value="{{$value}}">{{$catatanPemeliharaan->vendor->nama}}</option>
                                @endif
                                </select>
   </div>
@endif