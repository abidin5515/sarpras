@extends('layouts.app')

@section('title')
    <h1>Kerjakan Perbaikan</h1>
@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    @include('layouts.alert')
                </div>
            </div>

            <div class="row">

                <!-- SISI KIRI: Data Laporan Kerusakan -->
                <div class="col-lg-4 col-md-5">
                    <div class="card card-outline card-warning">
                        <div class="card-header">
                            <h3 class="card-title">Data Laporan Kerusakan</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-sm table-borderless">
                                <tr>
                                    <th width="40%">Ruangan / Lokasi</th>
                                    <td>: {{ @$permintaan->ruangan->nama ?? @$permintaan->lokasi }}</td>
                                </tr>
                                <tr>
                                    <th>Uraian Masalah</th>
                                    <td>:</td>
                                </tr>
                            </table>

                            <div class="alert alert-danger mt-1">
                                {{ $permintaan->masalah }}
                            </div>

                            <div class="mt-3">
                                <strong>Foto Laporan:</strong><br>
                                @if (@$permintaan->foto)
                                    <img src="{{ url($permintaan->foto) }}" class="img-fluid rounded mt-2" alt="Foto Rusak"
                                        style="max-height: 250px;">
                                @else
                                    <span class="text-muted">Tidak ada foto laporan</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SISI KANAN: Form Input Perbaikan -->
                <div class="col-lg-8 col-md-7">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title" style="color: #1f4e79; font-weight: bold;">Input Perbaikan</h3>
                        </div>
                        <div class="card-body">
                            <!-- Wajib menambahkan enctype="multipart/form-data" untuk upload file -->
                            <form action="{{ url('permintaan-perbaikan/store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id_permintaan" value="{{ $permintaan->id }}">
                                <!-- hidden input lokasi agar tidak null di database -->
                                <input type="hidden" name="lokasi"
                                    value="{{ @$permintaan->ruangan->nama ?? 'Ruangan Default' }}">

                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Tindakan sementara</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" name="tindakan_sementara" rows="2"
                                            placeholder="Pengecekan bagian kompresor pada kulkas"></textarea>
                                    </div>
                                </div>

                                {{-- <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Permasalahan</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" name="permasalahan" rows="2">{{ $permintaan->masalah }}</textarea>
                                </div>
                            </div> --}}

                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Tindakan perbaikan</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" name="tindakan_perbaikan" rows="2" placeholder="Mengganti komponen rusak"></textarea>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Waktu Perbaikan</label>
                                    <div class="col-sm-3">
                                        <small class="text-muted">Tanggal</small>
                                        <input type="date" class="form-control" name="tanggal"
                                            value="{{ date('Y-m-d') }}" required>
                                    </div>
                                    <div class="col-sm-3">
                                        <small class="text-muted">Jam Mulai</small>
                                        <input type="time" class="form-control" name="jam_mulai"
                                            value="" required>
                                    </div>
                                    <div class="col-sm-3">
                                        <small class="text-muted">Jam Selesai</small>
                                        <input type="time" class="form-control" name="jam_selesai"
                                            value="" required>
                                    </div>
                                </div>

                                <!-- Input Foto Perbaikan -->
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Foto Perbaikan</label>
                                    <div class="col-sm-9">
                                        <input type="file" name="foto" class="form-control">
                                    </div>
                                </div>

                                <!-- Input List Teknisi -->
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Teknisi</label>
                                    <div class="col-sm-9">
                                        @foreach ($teknisi as $r)
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" name="id_teknisi[]"
                                                    value="{{ $r->id }}" id="teknisi_{{ $r->id }}">
                                                <label class="form-check-label"
                                                    for="teknisi_{{ $r->id }}">{{ $r->nama }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Status</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="status">
                                            <option value="Pending">Pending</option>
                                            <option value="Selesai">Selesai</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row mt-4">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-9">
                                        <button type="submit" class="btn btn-primary px-4">Simpan</button>
                                        <a href="{{ url('permintaan-perbaikan') }}"
                                            class="btn btn-warning px-4 ml-2">Batal</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
