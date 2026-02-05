@extends('layouts.app')

@section('content')
<div class="container-fluid">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fw-bold mb-0">Kegiatan Sarpras</h4>
        <a href="{{ route('kegiatan-sarpras.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Kegiatan
        </a>
    </div>

    {{-- Filter --}}
    <div class="card shadow-sm mb-3">
        <div class="card-body">
            <div class="row g-3 align-items-end">
                <div class="col-md-3">
                    <label class="form-label">Tanggal Dari</label>
                    <input type="date" id="filter_start" class="form-control">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Tanggal Sampai</label>
                    <input type="date" id="filter_end" class="form-control">
                </div>
                <div class="col-md-3">
                    <button class="btn btn-secondary" id="btnFilter">
                        <i class="fas fa-filter"></i> Filter
                    </button>
                    <button class="btn btn-outline-secondary" id="btnReset">
                        Reset
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Table --}}
    <div class="card shadow-sm">
        <div class="card-body table-responsive">
            <table class="table align-middle w-100" id="table">
                <thead class="table-light">
                    <tr>
                        <th class="bg-dark">#</th>
                        <th class="bg-dark">Nama Kegiatan</th>
                        <th class="bg-dark">Tanggal</th>
                        <th class="bg-dark">Waktu</th>
                        <th class="bg-dark">Status</th>
                        <th class="bg-dark">Teknisi</th>
                        <th class="bg-dark" width="150">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kegiatan as $k)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $k->nama_kegiatan }}</td>
                            <td data-date="{{ $k->tanggal }}">
                                {{ tgl_indo($k->tanggal) }}
                            </td>
                            <td>
                                {{ $k->jam_mulai }} - {{ $k->jam_selesai ?? '-' }}
                            </td>
                            <td>
                                <span class="badge {{ $k->status == 'pending' ? 'bg-warning' : 'bg-success' }}">
                                    {{ ucfirst($k->status) }}
                                </span>
                            </td>
                            <td>
                                @foreach ($k->teknisi as $t)
                                    <span class="badge bg-secondary">
                                        {{ $t->nama }}
                                    </span>
                                @endforeach
                            </td>
                            <td>
                                <a href="{{ route('kegiatan-sarpras.show', $k->id) }}"
                                   class="btn btn-sm btn-info">
                                    Detail
                                </a>
                                <a href="{{ route('kegiatan-sarpras.edit', $k->id) }}"
                                   class="btn btn-sm btn-warning">
                                    Edit
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
@section('js')
<script>
$(document).ready(function () {

    // ===== default tanggal (1 bulan terakhir)
    const today = new Date();
    const lastMonth = new Date();
    lastMonth.setMonth(today.getMonth() - 1);

    function formatDate(date) {
        return date.toISOString().slice(0, 10);
    }

    $('#filter_start').val(formatDate(lastMonth));
    $('#filter_end').val(formatDate(today));

    // ===== custom filter tanggal
    $.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {
        let min = $('#filter_start').val();
        let max = $('#filter_end').val();
        let date = $('#table tbody tr').eq(dataIndex).find('td[data-date]').data('date');

        if (!date) return true;

        if (
            (min === '' && max === '') ||
            (min === '' && date <= max) ||
            (min <= date && max === '') ||
            (min <= date && date <= max)
        ) {
            return true;
        }
        return false;
    });

    // ===== init datatable
    const table = $('#table').DataTable({
        order: [[2, 'desc']],
        pageLength: 10,
        lengthMenu: [10, 25, 50, 100],
        language: {
            search: "Cari:",
            lengthMenu: "Tampilkan _MENU_ data",
            info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
            paginate: {
                previous: "‹",
                next: "›"
            }
        }
    });

    // ===== filter button
    $('#btnFilter').on('click', function () {
        table.draw();
    });

    $('#btnReset').on('click', function () {
        $('#filter_start').val('');
        $('#filter_end').val('');
        table.draw();
    });

    // ===== auto apply default filter
    table.draw();
});
</script>
@endsection
