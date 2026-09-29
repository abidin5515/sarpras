@extends('layouts.app')

@section('content')
<div class="container">
    
    {{-- Header / Judul Halaman --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0">Laporan Rating & Kepuasan Teknisi</h4>
    </div>

    {{-- Filter Periode --}}
    <div class="card shadow-sm mb-4">
        <div class="card-header fw-bold">
            Filter Laporan
        </div>
        <div class="card-body">
            <form method="GET" action="{{ url('admin/laporan-rating') }}">
                <div class="row align-items-end">
                    <div class="col-md-3 mb-3 mb-md-0">
                        <label class="form-label">Dari Tanggal</label>
                        <input type="date" name="start_date" class="form-control" value="{{ $startDate }}">
                    </div>
                    <div class="col-md-3 mb-3 mb-md-0">
                        <label class="form-label">Sampai Tanggal</label>
                        <input type="date" name="end_date" class="form-control" value="{{ $endDate }}">
                    </div>
                    <div class="col-md-4 mb-3 mb-md-0">
                        <label class="form-label">Ruangan</label>
                        <select name="id_ruang" class="form-select ruangan-select">
                            <option value="">Semua Ruangan</option>
                            @foreach($ruangan as $r)
                                <option value="{{ $r->id }}" {{ $id_ruang == $r->id ? 'selected' : '' }}>
                                    {{ $r->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">
                            Tampilkan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Cards Ringkasan / KPI --}}
    <div class="row mb-4">
        <div class="col-md-4 mb-3 mb-md-0">
            <div class="card shadow-sm border-0 bg-primary text-white">
                <div class="card-body">
                    <small class="text-white-50 fw-bold">TOTAL PENILAIAN DITERIMA</small>
                    <h2 class="fw-bold mb-0 mt-2">{{ $totalUlasan }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3 mb-md-0">
            <div class="card shadow-sm border-0 bg-warning text-white">
                <div class="card-body">
                    <small class="text-white-50 fw-bold">RATA-RATA KEPUASAN</small>
                    <h2 class="fw-bold mb-0 mt-2">{{ $avgRatingLayanan }} <small class="fs-6">/ 5.0</small></h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-0 bg-success text-white">
                <div class="card-body">
                    <small class="text-white-50 fw-bold">TEKNISI PERFORMA SANGAT BAIK (⭐ 4+)</small>
                    <h2 class="fw-bold mb-0 mt-2">{{ count(array_filter($rekapTeknisi, fn($t) => $t['avg_rating'] >= 4)) }}</h2>
                </div>
            </div>
        </div>
    </div>

    {{-- Tabel 1: Performa Teknisi --}}
    <div class="card shadow-sm mb-4">
        <div class="card-header fw-bold">
            Rekapitulasi Performa Teknisi
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th width="5%" class="ps-3">No</th>
                            <th>Nama Teknisi</th>
                            <th class="text-center">Total Pekerjaan Dinilai</th>
                            <th class="text-center">Rata-Rata Bintang</th>
                            <th class="text-end pe-3">Status Performa</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($rekapTeknisi as $key => $tek)
                            <tr>
                                <td class="ps-3">{{ $key + 1 }}</td>
                                <td class="fw-bold">{{ $tek['nama'] }}</td>
                                <td class="text-center">
                                    <span class="badge bg-light text-dark border">{{ $tek['total_pekerjaan'] }} Kali</span>
                                </td>
                                <td class="text-center text-warning">
                                    @for($i=1; $i<=5; $i++)
                                        <i class="{{ $i <= round($tek['avg_rating']) ? 'fas' : 'far' }} fa-star"></i>
                                    @endfor
                                    <span class="text-dark fw-bold ms-1">({{ $tek['avg_rating'] }})</span>
                                </td>
                                <td class="text-end pe-3">
                                    @if($tek['avg_rating'] >= 4.5)
                                        <span class="badge bg-success">Sangat Memuaskan</span>
                                    @elseif($tek['avg_rating'] >= 3.5)
                                        <span class="badge bg-info text-dark">Baik</span>
                                    @elseif($tek['avg_rating'] > 0)
                                        <span class="badge bg-warning text-dark">Perlu Evaluasi</span>
                                    @else
                                        <span class="badge bg-secondary">Belum ada penilaian</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-3">Belum ada data teknisi.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Tabel 2: Detail Masukan Ruangan --}}
    <div class="card shadow-sm">
        <div class="card-header fw-bold">
            Detail Masukan & Ulasan Ruangan
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="table-detail-laporan" class="table table-striped table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th width="5%">No</th>
                            <th>Tanggal</th>
                            <th>Ruangan</th>
                            <th>Masalah</th>
                            <th class="text-center">Rating</th>
                            <th>Catatan</th>
                            <th>Penilaian Teknisi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($laporan as $idx => $item)
                            <tr>
                                <td>{{ $idx + 1 }}</td>
                                <td>{{ date('d-m-Y H:i', strtotime($item->created_at)) }}</td>
                                <td><span class="badge bg-light text-dark border">{{ $item->ruangan->nama ?? '-' }}</span></td>
                                <td>{{ $item->masalah }}</td>
                                <td class="text-center text-warning">
                                    @for($s=1; $s<=5; $s++)
                                        <i class="{{ $s <= $item->rating_kepuasan ? 'fas' : 'far' }} fa-star"></i>
                                    @endfor
                                </td>
                                <td><i>"{{ $item->catatan_kepuasan ?? '-' }}"</i></td>
                                <td>
                                    @if($item->pekerjaan && $item->pekerjaan->rating_teknisi)
                                        @php 
                                            $rTek = json_decode($item->pekerjaan->rating_teknisi, true) ?? [];
                                        @endphp
                                        @foreach($rTek as $rt)
                                            @php $tekObj = \App\Teknisi::find($rt['id_teknisi']); @endphp
                                            @if($tekObj)
                                                <div class="small mb-1">
                                                    <strong>{{ $tekObj->nama }}:</strong> 
                                                    <span class="text-warning">
                                                        @for($b=1; $b<=5; $b++)
                                                            <i class="{{ $b <= $rt['rating'] ? 'fas' : 'far' }} fa-star"></i>
                                                        @endfor
                                                    </span>
                                                </div>
                                            @endif
                                        @endforeach
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection

@section('js')
<script>
    $(document).ready(function () {
        // Select2 gaya Bootstrap 5
        $('.ruangan-select').select2({
            placeholder: 'Pilih ruangan',
            width: '100%'
        });

        // Inisialisasi DataTables
        $('#table-detail-laporan').DataTable({
            responsive: true,
            language: {
                url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json"
            }
        });
    });
</script>
@endsection