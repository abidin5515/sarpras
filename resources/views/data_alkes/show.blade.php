
@extends('layouts.app')


@section('content')
 <style type="text/css">
 	legend {
 		font-size: 16px;
 		font-weight: bold;
 	}
 	td {
 		font-size: 14px;
 	}
 </style>

    <!-- Main content -->
<section class="content">
    <div class="container-fluid">
       	<div style="margin-top: 60px" class="row">
       		<div class="col-lg-9">
            <div class="card card-primary card-tabs">
              <div class="card-header p-0 pt-1">
                <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                  {{-- <li class="pt-2 px-3"><h3 class="card-title">Card Title</h3></li> --}}
                  <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-two-home-tab" data-toggle="pill" href="#custom-tabs-two-home" role="tab" aria-controls="custom-tabs-two-home" aria-selected="false">Properties</a>
                  </li>

                    @if ($jenis_pekerjaan)
                        @foreach ($jenis_pekerjaan as $element)
                            <li class="nav-item">
                             <a class="nav-link menu-pekerjaan" data-id="{{$element->id}}" id="{{'tes'.$element->id}}-tab" data-toggle="pill" href="#{{'tes'.$element->id}}" role="tab" aria-controls="{{'tes'.$element->id}}" aria-selected="true"> {{ @$element->nama }} </a>
                            </li>
                        @endforeach
                    @endif  

                  
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-two-tabContent">
                  <div class="tab-pane show active" id="custom-tabs-two-home" role="tabpanel" aria-labelledby="custom-tabs-two-home-tab">
                     
             		<fieldset>
             			<legend>Equipment Profile</legend>
             			<table width="100%" border="0" cellspacing="0" cellpadding="1">
             				<tr>
             					<td width="15%">Kode alat</td>
             					<td width="2%">:</td>
             					<td width="31%">{{ @$data->kode }}</td>
             					<td width="4%"></td>
             					<td width="15%">Manufacture</td>
             					<td width="2%">:</td>
             					<td width="31%">{{ @$data->manufacture }}</td>
             				</tr>

             				<tr>
             					<td>Nama alat</td>
             					<td>:</td>
             					<td align="top">{{ @$data->alat->nama }}</td>
             					<td></td>
             					<td>Lokasi</td>
             					<td>:</td>
             					<td>{{ @$data->ruangan->nama }}</td>
             				</tr>

             				<tr>
             					<td>Merk</td>
             					<td>:</td>
             					<td>{{ @$data->merk }}</td>
             					<td></td>
             					<td>Kondisi</td>
             					<td>:</td>
             					<td>{{ @$data->kondisi }}</td>
             				</tr>

             				<tr>
             					<td>Tipe</td>
             					<td>:</td>
             					<td>{{ @$data->tipe }}</td>
             					<td></td>
             					<td>Supplier</td>
             					<td>:</td>
             					<td>{{ @$data->supplier->nama }}</td>
             				</tr>

             				<tr>
             					<td>Nomor seri</td>
             					<td>:</td>
             					<td>{{ @$data->nomor_seri }}</td>
                                <td></td>
             					<td>No Inventarisasi</td>
                                <td>:</td>
                                <td>{{ @$data->no_invent }}</td>
             				</tr>
             			</table>
             		</fieldset>
             		<hr>
             		<fieldset>
             			<legend>Administratif Information</legend>
             			<table width="100%" border="0" cellspacing="0" cellpadding="1">
             				<tr>
             					<td width="15%">Tahun pengadaan</td>
             					<td width="2%">:</td>
             					<td width="31%">{{ date('d-m-Y', strtotime(@$data->tahun_pengadaan)) }}</td>
             					<td width="4%"></td>
             					<td width="15%">Present Year</td>
             					<td width="2%">:</td>
             					<td width="31%">{{ @$data->present_year }}</td>
             				</tr>

             				<tr>
             					<td>Harga beli</td>
             					<td>:</td>
             					<td align="top">{{ @$data->harga_beli }}</td>
             					<td></td>
             					<td>Penyusutan/tahun</td>
             					<td>:</td>
             					<td>{{ @$data->penyusutan_pertahun }}</td>
             				</tr>

             				<tr>
             					<td>Sumber dana</td>
             					<td>:</td>
             					<td>{{ @$data->sumber_dana->nama }}</td>
             					<td></td>
             					<td>Nilai akumulasi</td>
             					<td>:</td>
             					<td>{{ @$data->nilai_akumulasi }}</td>
             				</tr>

             				<tr>
             					<td>Expected life time</td>
             					<td>:</td>
             					<td>{{ @$data->expected_life_time }}</td>
             					<td></td>
             					<td>Nilai buku</td>
             					<td>:</td>
             					<td>{{ @$data->nilai_buku }}</td>
             				</tr>

             				<tr>
             					<td>Nomor seri</td>
             					<td>:</td>
             					<td>{{ @$data->nomor_seri }}</td>

             					
             				</tr>
             			</table>
             		</fieldset>
             		<hr>
             		<fieldset>
             			<legend>Documents Information</legend>
             			<table width="100%" border="0" cellspacing="0" cellpadding="1">
             				<tr>
             					<td width="15%">Sop alat</td>
             					<td width="2%">:</td>
             					<td width="31%">{{ (@$data->sop != null ? 'Ada' : 'Tidak ada') }}</td>
             					<td width="4%"></td>
             					<td width="15%">Kepemilikan</td>
             					<td width="2%">:</td>
             					<td width="31%">{{ @$data->pemilik->nama }}</td>
             				</tr>

             				<tr>
             					<td>Operating manual</td>
             					<td>:</td>
             					<td align="top">{{ (@$data->operating_manual != null ? 'Ada' : 'Tidak ada') }}</td>
             					<td></td>
             					<td>Status</td>
             					<td>:</td>
             					<td>{{ @$data->status }}</td>
             				</tr>

             				<tr>
             					<td>Service manual</td>
             					<td>:</td>
             					<td>{{ (@$data->service_manual != null ? 'Ada' : 'Tidak ada') }}</td>
             					<td></td>
             					<td>Daya listrik</td>
             					<td>:</td>
             					<td>{{ @$data->daya_listrik }}</td>
             				</tr>

             				<tr>
             					<td>Warranty expired</td>
             					<td>:</td>
             					<td>{{ @$data->expected_life_time }}</td>
             					<td></td>
             					<td>Nilai buku</td>
             					<td>:</td>
             					<td>{{ @$data->nilai_buku }}</td>
             				</tr>

             				<tr>
             					<td>Last updated</td>
             					<td>:</td>
             					<td>{{ @date('d-m-Y', strtotime($data->updated_at)) }}</td>

             					
             				</tr>
             			</table>
             		</fieldset>
                     	
                     
                  </div>
                 

                  @if ($jenis_pekerjaan)
                        @foreach ($jenis_pekerjaan as $element)
                            <div class="tab-pane fade" id="{{'tes'.$element->id}}" role="tabpanel" aria-labelledby="{{'tes'.$element->id}}-tab">
                                <table style="width: 100%" class="table table-striped" id="table-record-pekerjaan{{$element->id}}">
                                    <thead>
                                        <tr>
                                        <th>Masa kalibrasi</th>
                                        <th>Mulai</th>
                                        <th>Selesai</th>
                                        <th>Pelaksana</th>
                                        <th>Jumlah Biaya</th>    
                                        </tr>    
                                    </thead>
                                    <tbody></tbody>
                                    
                                </table>
                            </div>
                        @endforeach
                    @endif 
                  
                  
                </div>
              </div>
              <!-- /.card -->
            </div>
		</div>

		<div class="col-lg-3">
			<fieldset>
				<legend>Picture</legend>

                @if (!empty(@$data->gambar))
                    {{-- expr --}}
                <img class="" style="width: 100%" src="{{ url(@$data->gambar) }}">
                <br>
                <button class="btn btn-sm btn-info create-btn" data-lg="true" data-iframe="true" data-src="{{ url(@$data->gambar) }}" data-save="false">View Image</button>                    
                @endif

			</fieldset>
            <hr>
            @if ($data->sop)
                <fieldset>
                <legend>SOP</legend>
                <button class="btn btn-sm btn-info create-btn" data-lg="true" data-iframe="true" data-src="{{ url(@$data->sop) }}" data-save="false">Lihat berkas</button>
                </fieldset>
            @endif
            <hr>
            @if ($data->operating_manual)
                <fieldset>
                <legend>Operating Manual</legend>
                <button class="btn btn-sm btn-info create-btn" data-lg="true" data-iframe="true" data-src="{{ url(@$data->operating_manual) }}" data-save="false">Lihat berkas</button>
                </fieldset>
            @endif
            <hr>
            @if ($data->service_manual)
                <fieldset>
                <legend>Service Manual</legend>
                <button class="btn btn-sm btn-info create-btn" data-lg="true" data-iframe="true" data-src="{{ url(@$data->service_manual) }}" data-save="false">Lihat berkas</button>
                </fieldset>
            @endif
            
			
		</div>	
       	</div>   	
    </div>

</section>
    <!-- /.content -->

@endsection
@push('scripts')
	<script type="text/javascript">
     $(document).on('click', '.menu-pekerjaan', function(){
        $(".menu-pekerjaan").removeAttr('disabled');
        $(this).attr('disabled', 'disabled');

        var id_pekerjaan = $(this).attr('data-id');
        // alert(id_pekerjaan);
        var id_alkes = '{{$data->id}}';
        $('#table-record-pekerjaan'+id_pekerjaan).DataTable({
        destroy: true,
        processing: true,
        serverSide: true,
        ajax: '{!! url("record-pekerjaan") !!}/'+id_alkes+'/'+id_pekerjaan,
        columns: [
          {data:'masa_kalibrasi',name:'catatan_pemeliharaan.masa_kalibrasi'},
          {data:'mulai',name:'mulai'},
          {data:'selesai',name:'selesai'},
          {data:'pelaksana',name:'pelaksana'},
          {data:'jumlah_biaya',name:'jumlah_biaya'},
        ]
    });
     });   
    </script>
@endpush
