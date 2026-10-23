@extends('layouts.app')

@section('title')
    <h1>Daftar Permintaan Perbaikan</h1>
@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Laporan Kerusakan / Permintaan Perbaikan</h3>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <!-- Filter Status -->
                    <!-- Filter Tanggal & Status -->
                    <form method="GET" action="{{ url('permintaan-perbaikan') }}" class="mb-4 bg-light p-3 rounded border">
                        <div class="row">
                            <div class="col-md-3 mb-2">
                                <label>Dari Tanggal Lapor:</label>
                                <input type="date" name="dari_tanggal" class="form-control" value="{{ $dari_tanggal }}">
                            </div>
                            <div class="col-md-3 mb-2">
                                <label>Sampai Tanggal Lapor:</label>
                                <input type="date" name="sampai_tanggal" class="form-control"
                                    value="{{ $sampai_tanggal }}">
                            </div>
                            <div class="col-md-3 mb-2">
                                <label>Filter Status:</label>
                                <select name="status" class="form-control">
                                    <option value="">Semua Status</option>
                                    <option value="Belum Dikerjakan" {{ $status == 'Belum Dikerjakan' ? 'selected' : '' }}>
                                        Belum Dikerjakan</option>
                                    <option value="Pending" {{ $status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="Selesai" {{ $status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                </select>
                            </div>
                            <div class="col-md-3 mb-2 align-self-end">
                                <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i>
                                    Tampilkan</button>
                                <a href="{{ url('permintaan-perbaikan') }}" class="btn btn-warning"><i
                                        class="fas fa-sync"></i> Reset</a>
                            </div>
                        </div>
                    </form>

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="table-permintaan">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal Lapor</th>
                                    <th>Ruangan / Lokasi</th> <!-- Kolom Baru -->
                                    <th>Permasalahan</th>
                                    <th>Tindakan Sementara & Perbaikan</th>
                                    <th>Waktu Pengerjaan</th>
                                    <th>Teknisi</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($permintaan as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>
                                            <!-- Format sortable untuk DataTables -->
                                            <span
                                                style="display:none;">{{ date('Y-m-d H:i:s', strtotime($item->created_at)) }}</span>
                                            {{ date('d-m-Y', strtotime($item->created_at)) }}
                                        </td>
                                        <td>{{ @$item->ruangan->nama ?? ($item->lokasi ?? '-') }}</td> <!-- Data Ruangan -->
                                        <td>{{ $item->masalah }}</td>
                                        <td>
                                            @if ($item->id_pekerjaan)
                                                <b>Sementara:</b> {{ $item->tindakan_sementara }} <br>
                                                <b>Perbaikan:</b> {{ $item->tindakan_perbaikan }}
                                            @else
                                                <i class="text-danger">Belum ada tindakan</i>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->id_pekerjaan)
                                                {{ date('d-m-Y', strtotime($item->tanggal)) }} <br>
                                                Jam: {{ date('H:i', strtotime($item->jam_mulai)) }} -
                                                {{ date('H:i', strtotime($item->jam_selesai)) }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->id_teknisi)
                                                @php
                                                    $id_tek = explode(',', $item->id_teknisi);
                                                    foreach ($id_tek as $t) {
                                                        echo '<span class="badge badge-info">' .
                                                            ambil_teknisi($t) .
                                                            '</span> ';
                                                    }
                                                @endphp
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>
                                            <span
                                                class="badge {{ $item->status == 'Selesai' ? 'badge-success' : ($item->status == 'Pending' ? 'badge-warning' : 'badge-danger') }}">
                                                {{ $item->status }}
                                            </span>
                                        </td>
                                        <td>
                                            @if (!$item->id_pekerjaan)
                                                <a href="{{ url('permintaan-perbaikan/kerjakan/' . $item->id) }}"
                                                    class="btn btn-primary btn-sm btn-block mb-1">
                                                    <i class="fas fa-tools"></i> Kerjakan
                                                </a>
                                            @else
                                                <a href="{{ url('permintaan-perbaikan/show/' . $item->id) }}"
                                                    class="btn btn-info btn-sm mb-1" title="Detail">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ url('permintaan-perbaikan/edit/' . $item->id_pekerjaan) }}"
                                                    class="btn btn-warning btn-sm mb-1" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="{{ url('permintaan-perbaikan/print-pdf/' . $item->id_pekerjaan) }}"
                                                    target="_blank" class="btn btn-danger btn-sm mb-1" title="Cetak PDF">
                                                    <i class="fas fa-print"></i>
                                                </a>
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
    </section>
@endsection


@push('scripts')
    <script>
        $(document).ready(function() {
            $('#table-permintaan').DataTable({
                "order": [
                    [1, "desc"]
                ], // Mengurutkan berdasarkan kolom kedua (Tanggal Lapor) secara menurun
                "pageLength": 30, // Mengatur jumlah data yang tampil default menjadi 30
                "lengthMenu": [
                    [30, 50, 100, -1],
                    [30, 50, 100, "Semua"]
                ] // Menambahkan opsi 30 dan opsi "Semua" di dropdown pilihan baris
            });
        });
    </script>
@endpush
