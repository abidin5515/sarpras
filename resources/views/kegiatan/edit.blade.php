@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header fw-bold">
            Edit Kegiatan Sarpras
        </div>

        <div class="card-body">
            <form action="{{ route('kegiatan-sarpras.update', $kegiatan->id) }}"
                  method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Nama Kegiatan</label>
                    <input type="text"
                           name="nama_kegiatan"
                           class="form-control"
                           value="{{ $kegiatan->nama_kegiatan }}"
                           required>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Tanggal</label>
                        <input type="date"
                               name="tanggal"
                               class="form-control"
                               value="{{ $kegiatan->tanggal }}"
                               required>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Jam Mulai</label>
                        <input type="time"
                               name="jam_mulai"
                               class="form-control"
                               value="{{ $kegiatan->jam_mulai }}"
                               required>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Jam Selesai</label>
                        <input type="time"
                               name="jam_selesai"
                               class="form-control"
                               value="{{ $kegiatan->jam_selesai }}">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Teknisi</label>
                    <select name="teknisi[]"
                            class="form-select teknisi-select"
                            multiple required>
                        @foreach ($teknisi as $t)
                            <option value="{{ $t->id }}"
                                {{ in_array($t->id, $kegiatan->teknisi->pluck('id')->toArray()) ? 'selected' : '' }}>
                                {{ $t->nama }}
                            </option>
                        @endforeach
                    </select>
                    <small class="text-muted">
                        Bisa pilih lebih dari satu teknisi
                    </small>
                </div>

                <div class="mb-3">
                    <label class="form-label">Keterangan</label>
                    <textarea name="keterangan"
                              class="form-control"
                              rows="3">{{ $kegiatan->keterangan }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Foto Dokumentasi</label>
                    <input type="file"
                           name="foto"
                           class="form-control"
                           accept="image/*">

                    @if ($kegiatan->foto)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $kegiatan->foto) }}"
                                 class="img-thumbnail"
                                 width="200">
                        </div>
                    @endif
                </div>

                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-control">
                        <option value="pending"
                            {{ $kegiatan->status == 'pending' ? 'selected' : '' }}>
                            Pending
                        </option>
                        <option value="selesai"
                            {{ $kegiatan->status == 'selesai' ? 'selected' : '' }}>
                            Selesai
                        </option>
                    </select>
                </div>

                <div class="text-end">
                    <a href="{{ route('kegiatan-sarpras.index') }}"
                       class="btn btn-secondary">
                        Kembali
                    </a>
                    <button class="btn btn-primary">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $(document).ready(function () {
        $('.teknisi-select').select2({
            placeholder: 'Pilih teknisi',
            width: '100%'
        });
    });
</script>
@endsection
