@extends('layouts.app')
@section('title')
<h1>{{ @$title }}</h1>
@endsection

@section('content')
<section class="content">
  <div class="container-fluid">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Filter Rekap Checklist</h3>
      </div>
      <div class="card-body">
        <!-- Form Filter -->
        <form method="GET" action="{{ url('inventaris/rekap-checklist') }}" class="row">
          <div class="col-md-4 form-group">
            <label>Pilih Bulan</label>
            <select name="bulan" class="form-control">
              @php
                $nama_bulan = [
                    1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April', 
                    5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus', 
                    9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
                ];
              @endphp
              @foreach($nama_bulan as $bNum => $bName)
                <option value="{{ $bNum }}" {{ $bulan == $bNum ? 'selected' : '' }}>{{ $bName }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-md-4 form-group">
            <label>Tahun</label>
            <input type="text" name="tahun" class="form-control" value="{{ $tahun }}">
          </div>
          <div class="col-md-4 form-group">
            <label>&nbsp;</label>
            <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-filter">}}</i> Filter Data</button>
          </div>
        </form>

        <hr>

        <!-- Tabel Hasil Rekap -->
        <div class="table-responsive">
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Alat</th>
                <th>Nomor Seri</th>
                <th>Ruangan</th>
                <th>Teknisi Pelaksana</th>
                <th>Bulan / Tahun</th>
                <th>Status Kondisi</th>
                <th>Catatan Umum</th>
              </tr>
            </thead>
            <tbody>
              @forelse($data as $index => $row)
              <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ @$row->inventaris->masterbarang->nama }}</td>
                <td>{{ @$row->inventaris->nomor_seri }}</td>
                <td>{{ @$row->inventaris->masterruang->nama }}</td>
                <td>{{ @$row->teknisi->nama }}</td>
                <td>{{ $row->bulan }} / {{ $row->tahun }}</td>
                <td>
                  <span class="badge {{ $row->status == 'Normal' ? 'badge-success' : ($row->status == 'Perbaikan' ? 'badge-warning' : 'badge-danger') }}">
                    {{ $row->status }}
                  </span>
                </td>
                <td>{{ $row->keterangan_umum }}</td>
              </tr>
              @empty
              <tr>
                <td colspan="8" class="text-center text-muted">Belum ada data checklist pada periode ini.</td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>

      </div>
    </div>
  </div>
</section>
@endsection