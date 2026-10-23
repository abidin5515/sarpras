<form action="{{ url('inventaris/'.$inventaris->id.'/checklist') }}" method="POST">
    @csrf
    <div class="modal-body" style="max-height: 75vh; overflow-y: auto;">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card bg-light p-3 mb-3">
            <p class="mb-1"><b>Nama Alat:</b> {{ @$inventaris->masterbarang->nama }}</p>
            <p class="mb-1"><b>Nomor Seri / Kode:</b> {{ $inventaris->nomor_seri }}</p>
            <p class="mb-0"><b>Ruangan:</b> {{ @$inventaris->masterruang->nama }}</p>
        </div>

        <!-- Filter Periode Bulan -->
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Pilih Bulan</label>
            <div class="col-sm-9">
                <select name="bulan" class="form-control" onchange="location.href='{{ url('inventaris/'.$inventaris->id.'/checklist') }}?bulan=' + this.value">
                    @php
                        $nama_bulan = [
                            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April', 
                            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus', 
                            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
                        ];
                    @endphp
                    @foreach($nama_bulan as $bNum => $bName)
                        <option value="{{ $bNum }}" {{ $bulan == $bNum ? 'selected' : '' }}>{{ $bName }} {{ $tahun }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Pilih Teknisi yang Melakukan -->
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Teknisi Pelaksana</label>
            <div class="col-sm-9">
                <select name="teknisi_id" class="form-control" required>
                    <option value="">-- Pilih Teknisi --</option>
                    @foreach($teknisis as $t)
                        <option value="{{ $t->id }}" {{ (@$header->teknisi_id == $t->id) ? 'selected' : '' }}>{{ $t->nama }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Status Keseluruhan Alat -->
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Status Kondisi</label>
            <div class="col-sm-9">
                <select name="status" class="form-control" required>
                    <option value="Normal" {{ (@$header->status == 'Normal') ? 'selected' : '' }}>Normal / Layak Pakai</option>
                    <option value="Perbaikan" {{ (@$header->status == 'Perbaikan') ? 'selected' : '' }}>Perlu Perbaikan</option>
                    <option value="Rusak" {{ (@$header->status == 'Rusak') ? 'selected' : '' }}>Rusak / Tidak Berfungsi</option>
                </select>
            </div>
        </div>

        <hr>
        <h5 class="mb-3">Parameter Pengecekan Rutin:</h5>

        @if(count($master_checklists) > 0)
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="45%">Poin Pertanyaan / Parameter</th>
                            <th width="25%">Hasil Cek</th>
                            <th width="25%">Keterangan Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($master_checklists as $index => $mc)
                            @php
                                // Ambil detail jawaban jika sudah pernah diisi
                                $detailVal = null;
                                $detailKet = null;
                                if($header) {
                                    $savedDetail = \App\ChecklistDetail::where('checklist_header_id', $header->id)
                                                                       ->where('master_checklist_id', $mc->id)
                                                                       ->first();
                                    if($savedDetail) {
                                        $detailVal = $savedDetail->jawaban;
                                        $detailKet = $savedDetail->keterangan;
                                    }
                                }
                            @endphp
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                angka>
                                <td>{{ $mc->pertanyaan }}</td>
                                <td>
                                    <select name="jawaban[{{ $mc->id }}]" class="form-control form-control-sm" required>
                                        <option value="Baik" {{ $detailVal == 'Baik' ? 'selected' : '' }}>Baik</option>
                                        <option value="Tidak" {{ $detailVal == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                                        <option value="NA" {{ $detailVal == 'NA' ? 'selected' : '' }}>N/A</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="text" name="ket_detail[{{ $mc->id }}]" class="form-control form-control-sm" value="{{ $detailKet }}" placeholder="Catatan...">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="alert alert-warning">
                Belum ada setting checklist untuk jenis barang ini. Silakan atur terlebih dahulu di menu <b>Master Barang -> Setting Checklist</b>.
            </div>
        @endif

        <div class="form-group mt-3">
            <label>Keterangan Umum / Catatan Pemeliharaan Bulan Ini</label>
            <textarea name="keterangan_umum" class="form-control" rows="2">{{ @$header->keterangan_umum }}</textarea>
        </div>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        @if(count($master_checklists) > 0)
            <button type="submit" class="btn btn-primary">Simpan Checklist</button>
        @endif
    </div>
</form>