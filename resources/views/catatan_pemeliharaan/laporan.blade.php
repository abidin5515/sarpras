@extends('layouts.app')
@section('title')
<h1>Laporan Catatan Pemeliharaan</h1>
@endsection

@section('content')
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Laporan Catatan Pemeliharaan</h3>
            <div class="card-tools">
              <a class="btn btn-warning" href="{{ URL::previous() }}">
                <i class="fas fa-arrow-left"></i> KEMBALI
              </a>
            </div>
          </div>
          <div class="card-body">

            {{-- Filter --}}
            <form method="GET" action="{{ route('catatan-pemeliharaan.laporan') }}" id="filterForm">
              <input type="hidden" name="mode" id="modeInput" value="{{ request('mode','harian') }}">
              
              <ul class="nav nav-tabs mb-3" id="filterTab" role="tablist">
                <li class="nav-item">
                  <a class="nav-link {{ request('mode','harian') == 'harian' ? 'active' : '' }}" 
                     data-toggle="tab" href="#harian" role="tab" data-mode="harian">Harian</a>
                </li>
                {{-- <li class="nav-item">
                  <a class="nav-link {{ request('mode') == 'bulanan' ? 'active' : '' }}" 
                     data-toggle="tab" href="#bulanan" role="tab" data-mode="bulanan">Bulanan</a>
                </li> --}}
              </ul>

              <div class="tab-content" id="filterTabContent">

                {{-- Filter Harian --}}
                <div class="tab-pane fade {{ request('mode','harian') == 'harian' ? 'show active' : '' }}" id="harian">
                  <div class="row mb-3">
                    <div class="col-md-4">
                      <label>Dari Tanggal</label>
                      <input type="date" name="from" value="{{ request('from', date('Y-m-d')) }}" class="form-control">
                    </div>
                    <div class="col-md-4">
                      <label>Sampai Tanggal</label>
                      <input type="date" name="to" value="{{ request('to', date('Y-m-d')) }}" class="form-control">
                    </div>
                  </div>
                </div>

                {{-- Filter Bulanan --}}
                <div class="tab-pane fade {{ request('mode') == 'bulanan' ? 'show active' : '' }}" id="bulanan">
                  <div class="row mb-3">
                    <div class="col-md-3">
                      <label>Bulan</label>
                      <select name="bulan" class="form-control">
                        @for ($m=1; $m<=12; $m++)
                          <option value="{{ $m }}" {{ request('bulan') == $m ? 'selected' : '' }}>
                            {{ date('F', mktime(0, 0, 0, $m, 1)) }}
                          </option>
                        @endfor
                      </select>
                    </div>
                    <div class="col-md-3">
                      <label>Tahun</label>
                      <select name="tahun" class="form-control">
                        @for ($y = date('Y')-5; $y <= date('Y'); $y++)
                          <option value="{{ $y }}" {{ request('tahun',date('Y')) == $y ? 'selected' : '' }}>
                            {{ $y }}
                          </option>
                        @endfor
                      </select>
                    </div>
                  </div>
                </div>
              </div>

              <button type="submit" class="btn btn-primary">
                <i class="fas fa-filter"></i> Tampilkan
              </button>
              <a href="{{ route('catatan-pemeliharaan.laporan') }}" class="btn btn-secondary">
                <i class="fas fa-sync"></i> Reset
              </a>
            </form>

            <hr>

            {{-- Tabel ringkas --}}
            <table id="laporanTable" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Tanggal</th>
                  <th>Jumlah Pekerjaan</th>
                </tr>
              </thead>
              <tbody>
                @forelse($laporan as $i => $row)
                  <tr>
                    <td>{{ $i+1 }}</td>
                    <td>{{ $row->tanggal }}</td>
                    <td>{{ $row->jumlah }}</td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="3" class="text-center">Tidak ada data</td>
                  </tr>
                @endforelse
              </tbody>
              @if($laporan->count())
              <tfoot>
                <tr>
                  <th colspan="2" class="text-right">Total</th>
                  <th>{{ $laporan->sum('jumlah') }}</th>
                </tr>
              </tfoot>
              @endif
            </table>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection

@push('scripts')
<script>
  $(function () {
    // saat tab diganti, update hidden mode
    $('#filterTab a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
      var mode = $(e.target).data('mode');
      $('#modeInput').val(mode);
    });

    // DataTables
    $('#laporanTable').DataTable({
      "responsive": true,
      "lengthChange": false,
      "autoWidth": false,
      "ordering": true,
      "pageLength": 25
    });
  });
</script>
@endpush
