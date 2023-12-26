<hr>
<h5>Form Surat Tugas Pemeliharaan / Perbaikan</h5>
<hr>

<div class="row">
	<div class="col-lg-6">

		@if (!empty(@$perbaikan->nomor))
			{{-- expr --}}

		<div class="form-group">
			<label>Nomor</label>
			<input type="text" name="nomor" class="form-control" value="{{@$perbaikan->nomor}}">
		</div>

@else

		<div class="form-group">
			<label>Nomor</label>
			<input type="text" name="nomor" class="form-control" value="-- OTOMATIS --" readonly="">
		</div>

		@endif
		<div class="form-group">
			<label>Nama/NIP/Pemesan/User</label>
			<input type="text" name="nama_pemesan" class="form-control" value="{{@$perbaikan->nama_pemesan}}">
		</div>

		<div class="form-group">
			<label>Tanggal</label>
			<input type="date" name="tanggal" class="form-control" value="{{@$perbaikan->tanggal}}">
		</div>
{{-- 		<div class="form-group">
			<label>Laporan Kerusakan Awal</label>
			<textarea class="form-control" name="laporan_kerusakan_awal">{{@$perbaikan->laporan_kerusakan_awal}}</textarea>
		</div> --}}
		<div class="form-group">
			<label>Batas waktu perbaikan yang diminta</label>
			@if (!empty($permintaan_pelayanan))
				{{-- expr --}}
				@php
					@$batas = @$permintaan_pelayanan->batas_waktu_perbaikan;
					
				@endphp
				@else
				@php
					@$batas = @$perbaikan->batas_waktu_perbaikan;
				@endphp
			@endif
			<input type="date" name="batas_waktu_perbaikan" class="form-control" value="{{@$batas}}">
		</div>
	</div>
	<div class="col-lg-6">
	{{-- 	<div class="form-group">
			<label>Tindakan Perbaikan</label>
			<textarea class="form-control" name="tindakan_perbaikan">{{@$perbaikan->tindakan_perbaikan}}</textarea>
		</div> --}}

		<div class="form-group">
			<label>Suku cadang yang diperlukan</label>
			<textarea class="form-control" name="suku_cadang">{{@$perbaikan->suku_cadang}}</textarea>
		</div>

		{{-- <div class="form-group">
			<label>Nilai dalam rupiah</label>
			<input type="number" name="nilai" class="form-control" value="{{@$perbaikan->nilai}}">
		</div>
 --}}



		<div class="form-group">
			<label>Hasil Perbaikan</label>
			<textarea class="form-control" name="hasil_perbaikan">{{@$perbaikan->hasil_perbaikan}}</textarea>
		</div>
		<div class="form-group">
			<label>Saran dari petugas</label>
			<textarea class="form-control" name="saran_dari_petugas">{{@$perbaikan->saran_dari_petugas}}</textarea>
		</div>

	</div>
</div>




<div class="row">
	<div class="col-lg-6">
		


		<div class="form-group">
			<label>Catatan</label>
			<textarea class="form-control" name="catatan">{{@$perbaikan->catatan}}</textarea>
		</div>

		<div class="form-group">
			<label>Pemberi Tugas</label>
			<input type="text" name="pemberi_tugas" class="form-control" readonly="" value="Kepala Instalasi Alat Kesehatan">
		</div>

		<div class="form-group">
			<label>Pesan pemberi tugas</label>
			<textarea class="form-control" name="pesan_pemberi_tugas">{{@$perbaikan->pesan_pemberi_tugas}}</textarea>
		</div>

	</div>
	<div class="col-lg-6">
		

		<div class="form-group">
			<label>Diteruskan Kepada</label>
			<input type="text" name="diteruskan_kepada" class="form-control" value="{{@$perbaikan->diteruskan_kepada}}">
		</div>

		<div class="form-group">
			<label>Nama Petugas</label>
			<select class="form-control select2" multiple="" name="petugas[]" data-url="{{ url('teknisi/select2') }}">
					@if (!empty($perbaikanPetugas))
						{{-- expr --}}
						@if ($perbaikanPetugas->count())
							{{-- expr --}}
							@foreach ($perbaikanPetugas->get() as $pp)
								{{-- expr --}}
							<option value="{{$pp->id_petugas}}" selected="">{{$pp->petugas->nama}}</option>
							@endforeach
						@endif
					@endif

			</select><br>

			
		</div>

		<div class="form-group">
			<label>Ka. SMF/ BID / Inst/ Ruang</label>
			<input type="text" name="ka_smf" class="form-control" value="{{@$perbaikan->nama_smf_bag}}">
		</div>

		<div class="form-group">
			<label>Petugas Gudang</label>
			<input type="text" name="nama_petugas_gudang" class="form-control" value="{{@$perbaikan->nama_petugas_gudang}}">
		</div>

	</div>
</div>


<style type="text/css">
	.select2-container{
		margin-top: 5px;
	}
</style>