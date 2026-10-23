@extends('layouts.app')

@section('title')
    <h1>Edit Laporan Perbaikan</h1>
@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">

                <!-- SISI KIRI: Data Laporan Kerusakan (Readonly) -->
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

                <!-- SISI KANAN: Form Edit Perbaikan -->
                <div class="col-lg-8 col-md-7">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title" style="color: #1f4e79; font-weight: bold;">Edit Perbaikan</h3>
                        </div>
                        <div class="card-body">
                            <!-- Arahkan action form ke rute UPDATE dan sertakan enctype untuk upload foto -->
                            <form action="{{ url('permintaan-perbaikan/update/' . $pekerjaan->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf

                                <!-- Bawa id_permintaan untuk keperluan update status di tabel permintaan -->
                                <input type="hidden" name="id_permintaan" value="{{ $permintaan->id }}">

                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Tindakan sementara</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" name="tindakan_sementara" rows="2"
                                            placeholder="Pengecekan bagian kompresor pada kulkas">{{ $pekerjaan->tindakan_sementara }}</textarea>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Permasalahan</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" name="permasalahan" rows="2">{{ $pekerjaan->permasalahan }}</textarea>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Tindakan perbaikan</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" name="tindakan_perbaikan" rows="2" placeholder="Mengganti komponen rusak">{{ $pekerjaan->tindakan_perbaikan }}</textarea>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Waktu Perbaikan</label>
                                    <div class="col-sm-3">
                                        <small class="text-muted">Tanggal</small>
                                        <input type="date" class="form-control" name="tanggal"
                                            value="{{ $pekerjaan->tanggal }}" required>
                                    </div>
                                    <div class="col-sm-3">
                                        <small class="text-muted">Jam Mulai</small>
                                        <input type="time" class="form-control" name="jam_mulai"
                                            value="{{ date('H:i', strtotime($pekerjaan->jam_mulai)) }}" required>
                                    </div>
                                    <div class="col-sm-3">
                                        <small class="text-muted">Jam Selesai</small>
                                        <input type="time" class="form-control" name="jam_selesai"
                                            value="{{ date('H:i', strtotime($pekerjaan->jam_selesai)) }}" required>
                                    </div>
                                </div>

                                <!-- Input Foto Perbaikan -->
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Foto Perbaikan <br><small
                                            class="text-muted">(Kosongkan jika tidak ingin mengubah foto)</small></label>
                                    <div class="col-sm-9">
                                        <!-- Menampilkan foto yang sudah ada sebelumnya -->
                                        @if ($pekerjaan->foto)
                                            <div class="mb-2">
                                                <img src="{{ url($pekerjaan->foto) }}" width="150"
                                                    class="rounded border" alt="Foto Pekerjaan Saat Ini">
                                            </div>
                                        @endif

                                        <!-- Saat edit, input file tidak required agar foto lama tidak hilang jika tidak diupload ulang -->
                                        <input type="file" name="foto" class="form-control">
                                    </div>
                                </div>

                                <!-- Input List Teknisi -->
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Teknisi</label>
                                    <div class="col-sm-9">
                                        @foreach ($teknisi as $r)
                                            <div class="form-check">
                                                <!-- Cek apakah ID teknisi ini ada di dalam array $teknisi_terpilih yang kita kirim dari controller -->
                                                <input type="checkbox" class="form-check-input" name="id_teknisi[]"
                                                    value="{{ $r->id }}" id="teknisi_{{ $r->id }}"
                                                    {{ in_array($r->id, $teknisi_terpilih) ? 'checked' : '' }}>
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
                                            <option value="Pending"
                                                {{ $pekerjaan->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="Selesai"
                                                {{ $pekerjaan->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row mt-4">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-9">
                                        <button type="submit" class="btn btn-primary px-4">Update</button>
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
