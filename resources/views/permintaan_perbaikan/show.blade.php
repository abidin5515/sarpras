@extends('layouts.app')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header bg-info">
                    <h3 class="card-title text-white">Detail Laporan & Perbaikan</h3>
                </div>
                <div class="card-body row">
                    <div class="col-md-6">
                        <h5>Data Laporan Masuk</h5>
                        <table class="table table-bordered">
                            <tr>
                                <th>Tanggal Lapor</th>
                                <td>{{ date('d-m-Y', strtotime($data->created_at)) }}</td>
                            </tr>
                            <tr>
                                <th>Masalah</th>
                                <td>{{ $data->masalah }}</td>
                            </tr>
                            <tr>
                                <th>Foto Laporan</th>
                                <td>
                                    @if ($data->foto_laporan)
                                        <img src="{{ url($data->foto_laporan) }}" width="150">
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h5>Data Tindakan Perbaikan</h5>
                        <table class="table table-bordered">
                            <tr>
                                <th>Tindakan Sementara</th>
                                <td>{{ $data->tindakan_sementara ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Tindakan Perbaikan</th>
                                <td>{{ $data->tindakan_perbaikan ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Waktu Pengerjaan</th>
                                <td>
                                    {{ $data->tanggal ? date('d-m-Y', strtotime($data->tanggal)) : '-' }} <br>
                                    (Jam {{ date('H:i', strtotime($data->jam_mulai)) }} s/d
                                    {{ date('H:i', strtotime($data->jam_selesai)) }})
                                </td>
                            </tr>
                            <tr>
                                <th>Status Akhir</th>
                                <td>{{ $data->status }}</td>
                            </tr>
                            <tr>
                                <th>Foto Perbaikan</th>
                                <td>
                                    @if ($data->foto_perbaikan)
                                        <img src="{{ url($data->foto_perbaikan) }}" width="150">
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ url('permintaan-perbaikan') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </div>
        </div>
    </section>
@endsection
