@extends('layouts.app')

@section('content')
<div class="container-fluid">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fw-bold mb-0">Detail Kegiatan Sarpras</h4>
        <div>
            <a href="{{ route('kegiatan-sarpras.edit', $kegiatan->id) }}"
               class="btn btn-warning">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('kegiatan-sarpras.index') }}"
               class="btn btn-secondary">
                Kembali
            </a>
        </div>
    </div>

    <div class="row">

        {{-- Kolom kiri --}}
        <div class="col-md-6">
            <div class="card shadow-sm mb-3">
                <div class="card-body">

                    <table class="table table-borderless mb-0">
                        <tr>
                            <th width="180">Nama Kegiatan</th>
                            <td>: <strong>{{ $kegiatan->nama_kegiatan }}</strong></td>
                        </tr>
                        <tr>
                            <th>Tanggal</th>
                            <td>: {{ tgl_indo($kegiatan->tanggal) }}</td>
                        </tr>
                        <tr>
                            <th>Waktu</th>
                            <td>:
                                {{ $kegiatan->jam_mulai }}
                                –
                                {{ $kegiatan->jam_selesai ?? '-' }}
                            </td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>:
                                <span class="badge {{ $kegiatan->status == 'pending' ? 'bg-warning' : 'bg-success' }}">
                                    {{ ucfirst($kegiatan->status) }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th>Teknisi</th>
                            <td>:
                                @forelse ($kegiatan->teknisi as $t)
                                    <span class="badge bg-secondary mb-1">
                                        {{ $t->nama }}
                                    </span>
                                @empty
                                    <span class="text-muted">Belum ditentukan</span>
                                @endforelse
                            </td>
                        </tr>
                        <tr>
                            <th>Keterangan</th>
                            <td>:
                                {!! $kegiatan->keterangan
                                    ? nl2br(e($kegiatan->keterangan))
                                    : '<span class="text-muted">-</span>' !!}
                            </td>
                        </tr>
                    </table>

                </div>
            </div>
        </div>

        {{-- Kolom kanan --}}
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header fw-bold">
                    Dokumentasi
                </div>
                <div class="card-body text-center">

                    @if($kegiatan->foto)
                        <a href="{{ asset('storage/'.$kegiatan->foto) }}" target="_blank">
                            <img src="{{ asset('storage/'.$kegiatan->foto) }}"
                                 class="img-fluid rounded shadow-sm"
                                 alt="Foto kegiatan">
                        </a>
                        <small class="text-muted d-block mt-2">
                            Klik gambar untuk memperbesar
                        </small>
                    @else
                        <div class="text-muted">
                            <i class="fas fa-image fa-3x mb-2"></i>
                            <div>Belum ada foto dokumentasi</div>
                        </div>
                    @endif

                </div>
            </div>
        </div>

    </div>
</div>
@endsection
