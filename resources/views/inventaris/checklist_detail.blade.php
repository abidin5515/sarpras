@extends('layouts.app')
@section('title')
<h1>{{ @$title }}</h1>
@endsection

@section('content')
<section class="content">
  <div class="container-fluid">

    @if(session('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session('success') }}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
      </div>
    @endif

    <div class="row">
      <!-- Kolom Kiri: Informasi Alat & Riwayat Checklist -->
      <div class="col-md-4">
        <div class="card card-primary card-outline">
          <div class="card-header">
            <h3 class="card-title">Informasi Alat</h3>
          </div>
          <div class="card-body">
            <p><b>Nama Barang:</b> {{ @$inventaris->masterbarang->nama }}</p>
            <p><b>Merk:</b> {{ @$inventaris->mastermerk->nama }}</p>
            <p><b>Tipe / Kapasitas:</b> {{ $inventaris->tipe }} / {{ $inventaris->kapasitas }}</p>
            <p><b>Nomor Seri:</b> {{ $inventaris->nomor_seri }}</p>
            <p><b>Ruangan:</b> {{ @$inventaris->masterruang->nama }}</p>
            <p><b>Kondisi Fisik:</b> <span class="badge badge-info">{{ $inventaris->kondisi }}</span></p>
          </div>
        </div>

        <!-- Tabel Ringkasan Riwayat Checklist Tahun Ini -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Riwayat Checklist Tahun {{ $tahun }}</h3>
          </div>
          <div class="card-body p-0">
            <table class="table table-sm table-striped">
              <thead>
                <tr>
                  <th>Bulan</th>
                  <th>Teknisi</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                @php 
                  $nama_bulan_arr = [1=>'Jan', 2=>'Feb', 3=>'Mar', 4=>'Apr', 5=>'Mei', 6=>'Jun', 7=>'Jul', 8=>'Agu', 9=>'Sep', 10=>'Okt', 11=>'Nov', 12=>'Des'];
                @endphp
                @foreach($nama_bulan_arr as $bNum => $bName)
                  @php $cek = $riwayat->where('bulan', $bNum)->first(); @endphp
                  <tr>
                    <td>
                      <a href="{{ url('inventaris/'.$inventaris->id.'/checklist-detail?bulan='.$bNum) }}">
                        <b>{{ $bName }}</b>
                      </a>
                    </td>
                    <td>{{ @$cek->teknisi->nama ?? '-' }}</td>
                    <td>
                      @if($cek)
                        <span class="badge badge-success">{{ $cek->status }}</span>
                      @else
                        <span class="badge badge-secondary">Belum</span>
                      @endif
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <!-- Kolom Kanan: Form Form Pengisian Checklist Berdasarkan Bulan -->
      <div class="col-md-8">
        <div class="card card-success">
          <div class="card-header">
            <h3 class="card-title">Form Pengecekan Periode: 
              @php
                $nama_bulan_full = [1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',5=>'Mei',6=>'Juni',7=>'Juli',8=>'Agustus',9=>'September',10=>'Oktober',11=>'November',12=>'Desember'];
              @endphp
              <b>{{ $nama_bulan_full[$bulan] }} {{ $tahun }}</b>
            </h3>
          </div>

          <form action="{{ url('inventaris/'.$inventaris->id.'/checklist-detail') }}" method="POST">
            @csrf
            <input type="hidden" name="bulan" value="{{ $bulan }}">

            <div class="card-body">
              <!-- Pilih Teknisi -->
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Teknisi Pelaksana *</label>
                <div class="col-sm-9">
                  <select name="teknisi_id" class="form-control" required>
                    <option value="">-- Pilih Teknisi --</option>
                    @foreach($teknisis as $t)
                      <option value="{{ $t->id }}" {{ (@$header->teknisi_id == $t->id) ? 'selected' : '' }}>{{ $t->nama }}</option>
                    @endforeach
                  </select>
                </div>
              </div>

              <!-- Status Kondisi Alat Bulan Ini -->
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Status Alat *</label>
                <div class="col-sm-9">
                  <select name="status" class="form-control" required>
                    <option value="Normal" {{ (@$header->status == 'Normal') ? 'selected' : '' }}>Normal / Layak Pakai</option>
                    <option value="Perbaikan" {{ (@$header->status == 'Perbaikan') ? 'selected' : '' }}>Perlu Perbaikan</option>
                    <option value="Rusak" {{ (@$header->status == 'Rusak') ? 'selected' : '' }}>Rusak / Tidak Berfungsi</option>
                  </select>
                </div>
              </div>

              <hr>
              <h5 class="mb-3">Parameter Cek Rutin (Setting Master Barang):</h5>

              @if(count($master_checklists) > 0)
                <div class="table-responsive">
                  <table class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th width="5%">No</th>
                        <th width="45%">Poin Parameter</th>
                        <th width="20%">Hasil</th>
                        <th width="30%">Keterangan</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($master_checklists as $index => $mc)
                        @php
                          $detailVal = null;
                          $detailKet = null;
                          if($header) {
                              $savedDetail = \App\ChecklistDetail::where('checklist_header_id', $header->id)
                                                                 ->where('master_checklist_id', $mc->id)
                                                                 ->first();
                              if($savedDetail) {
                                  $detailVal = $savedDetail->jawaban;
                                  $detailKet = $savedDetail->keterangan;
                              }
                          }
                        @endphp
                        <tr>
                          <td class="text-center">{{ $index + 1 }}</td>
                          <td>{{ $mc->pertanyaan }}</td>
                          <td>
                            <select name="jawaban[{{ $mc->id }}]" class="form-control form-control-sm" required>
                              <option value="Baik" {{ $detailVal == 'Baik' ? 'selected' : '' }}>Baik</option>
                              <option value="Tidak" {{ $detailVal == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                              <option value="NA" {{ $detailVal == 'NA' ? 'selected' : '' }}>N/A</option>
                            </select>
                          </td>
                          <td>
                            <input type="text" name="ket_detail[{{ $mc->id }}]" class="form-control form-control-sm" value="{{ $detailKet }}" placeholder="Catatan...">
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              @else
                <div class="alert alert-warning">
                  Belum ada setting pertanyaan checklist untuk barang ini. Silakan atur di menu <b>Master Barang -> Setting Checklist</b> terlebih dahulu.
                </div>
              @endif

              <div class="form-group mt-3">
                <label>Catatan / Keterangan Umum Pemeliharaan</label>
                <textarea name="keterangan_umum" class="form-control" rows="3">{{ @$header->keterangan_umum }}</textarea>
              </div>
            </div>

            <div class="card-footer text-right">
              <a href="{{ url('inventaris') }}" class="btn btn-secondary">Kembali</a>
              @if(count($master_checklists) > 0)
                <button type="submit" class="btn btn-success">Simpan Checklist Bulan Ini</button>
              @endif
            </div>
          </form>
        </div>
      </div>
    </div>

  </div>
</section>
@endsection