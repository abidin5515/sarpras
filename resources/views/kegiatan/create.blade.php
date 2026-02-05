@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header fw-bold">
            Tambah Kegiatan Sarpras
        </div>

        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Gagal menyimpan data.</strong>
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif


            <form action="{{ route('kegiatan-sarpras.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Nama Kegiatan</label>
                    <input type="text" name="nama_kegiatan"
                           class="form-control" required>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Tanggal</label>
                        <input value="{{ date('Y-m-d') }}" type="date" name="tanggal"
                               class="form-control" required>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Jam Mulai</label>
                        <input type="time" name="jam_mulai"
                               class="form-control" required>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Jam Selesai</label>
                        <input type="time" name="jam_selesai"
                               class="form-control">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Teknisi</label>
                    <select name="teknisi[]" class="form-select teknisi-select" multiple required>
                        <option value="">Pilih Teknisi</option>
                        @foreach ($teknisi as $t)
                            <option value="{{ $t->id }}">
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
                    <textarea name="keterangan" class="form-control"
                              rows="3"></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Foto Dokumentasi</label>
                    <input type="file" name="foto"
                           class="form-control" accept="image/*">
                </div>

                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-control">
                        <option value="pending">Pending</option>
                        <option value="selesai">Selesai</option>
                    </select>
                </div>

                <div class="text-end">
                    <a href="{{ route('kegiatan-sarpras.index') }}"
                       class="btn btn-secondary">
                        Kembali
                    </a>
                    <button class="btn btn-primary">
                        Simpan
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
