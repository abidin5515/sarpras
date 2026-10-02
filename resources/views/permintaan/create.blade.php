<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>IPSRS - Permintaan Perbaikan</title>

    <link rel="stylesheet" href="{{ url('plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ url('dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('/src/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ url('/src/select2-bootstrap-theme/dist/select2-bootstrap.min.css') }}">
    <!-- SweetAlert2 untuk Notifikasi Ciamik -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <style>
        .star-rating i {
            font-size: 24px;
            color: #ddd;
            cursor: pointer;
        }

        .star-rating i.active,
        .star-rating i:hover {
            color: #f39c12;
        }

        .star-rating-teknisi i {
            font-size: 18px;
            color: #ddd;
            cursor: pointer;
        }

        .star-rating-teknisi i.active {
            color: #f39c12;
        }
    </style>
</head>

<body class="bg-light">
    <div class="container-fluid p-4">

        <div class="row mb-3 align-items-center">
            <div class="col-md-8">
                <h3><i class="fas fa-tools"></i> IPSRS - Form Permintaan & Riwayat</h3>
            </div>
            <div class="col-md-4 text-right">
                <a href="{{ url('/login') }}" class="btn btn-outline-primary btn-sm"><i class="fas fa-lock"></i> Login
                    Admin</a>
            </div>
        </div>

        <div class="row">
            <!-- Form Input Permintaan -->
            <div class="col-md-4">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-edit"></i> Buat Permintaan</h3>
                    </div>
                    <div class="card-body">
                        <p class="text-muted text-sm">Data yang sudah terkirim tidak dapat dihapus.</p>

                        @if (session()->has('message'))
                            <div class="alert alert-success">{{ session()->get('message') }}</div>
                        @endif

                        <form action="{{ url('minta/store') }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label>Ruangan <span class="text-danger">*</span></label>
                                <select class="form-control select2" name="id_ruang" id="id_ruang" required>
                                    <option value="">-- Pilih Ruang --</option>
                                    @if ($ruangan)
                                        @foreach ($ruangan as $d)
                                            <option value="{{ $d->id }}">{{ $d->nama }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Uraian Masalah <span class="text-danger">*</span></label>
                                <textarea name="masalah" class="form-control" rows="3" placeholder="Jelaskan kendala kerusakan..." required>{{ old('masalah') }}</textarea>
                            </div>

                            <div class="form-group">
                                <label>Foto Kerusakan</label>
                                <input type="file" name="foto" class="form-control-file">
                            </div>

                            <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-paper-plane"></i>
                                KIRIM PERMINTAAN</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Riwayat Permintaan -->
            <div class="col-md-8">
                <div class="card card-info card-outline">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-history"></i> Riwayat Permintaan Ruangan</h3>
                    </div>
                    <div class="card-body">

                        <div id="state-pilih-ruangan" class="text-center text-muted p-5">
                            <i class="fas fa-door-open fa-3x mb-3 text-info"></i>
                            <h5>Silakan Pilih Ruangan</h5>
                            <p class="text-sm">Pilih ruangan pada form di sebelah kiri untuk menampilkan riwayat
                                perbaikan.</p>
                        </div>

                        <div id="state-loading" class="text-center p-5 d-none">
                            <i class="fas fa-spinner fa-spin fa-2x text-primary mb-2"></i>
                            <p>Memuat data riwayat...</p>
                        </div>

                        <div id="state-tabel" class="table-responsive d-none">
                            <table class="table table-bordered table-striped text-sm">
                                <thead class="bg-info text-white">
                                    <tr>
                                        <th width="5%">No</th>
                                        <th>Tanggal</th>
                                        <th>Masalah</th>
                                        <th>Status</th>
                                        <th>Detail Pekerjaan & Teknisi</th>
                                        <th width="22%">Nilai Kepuasan</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody-history">
                                    <!-- Render via JS -->
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Rating / Penilaian Kepuasan -->
    <!-- Modal Validasi & Penilaian Kepuasan -->
    <div class="modal fade" id="modalRating" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title"><i class="fas fa-check-circle"></i> Konfirmasi Selesai & Penilaian</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form-rating">
                    <div class="modal-body">
                        <input type="hidden" name="id_permintaan" id="rating_id_permintaan">

                        <!-- STEP 1: VALIDASI SELESAI OLEH RUANGAN -->
                        <div class="card border-primary mb-3">
                            <div class="card-body bg-light">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="check_validasi_selesai"
                                        required style="width: 20px; height: 20px; cursor: pointer;">
                                    <label class="form-check-label fw-bold ms-2 align-middle text-primary"
                                        for="check_validasi_selesai" style="cursor: pointer;">
                                        Konfirmasi: Pekerjaan telah selesai & fasilitas berfungsi baik.
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- STEP 2: FORM PENILAIAN (DISABLED DULU SEBELUM DICENTANG) -->
                        <div id="section-rating-content" class="pe-none opacity-50">

                            <!-- Rating Utama -->
                            <div class="form-group text-center mb-3">
                                <label class="d-block fw-bold">Bagaimana kepuasan Anda terhadap perbaikan ini?</label>
                                <div class="star-rating" id="star-main">
                                    <i class="far fa-star" data-value="1"></i>
                                    <i class="far fa-star" data-value="2"></i>
                                    <i class="far fa-star" data-value="3"></i>
                                    <i class="far fa-star" data-value="4"></i>
                                    <i class="far fa-star" data-value="5"></i>
                                </div>
                                <input type="hidden" name="rating_kepuasan" id="input_rating_kepuasan">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Catatan / Ulasan Tambahan:</label>
                                <textarea name="catatan_kepuasan" class="form-control" rows="2"
                                    placeholder="Masukan atau ucapan terima kasih..."></textarea>
                            </div>

                            <hr>

                            <!-- Rating Per Teknisi -->
                            <div class="mb-3">
                                <label class="form-label fw-bold">Penilaian Khusus Per Teknisi:</label>
                                <div id="container-teknisi-rating">
                                    <!-- Render via JS -->
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary" id="btn-simpan-rating" disabled>
                            <i class="fas fa-save"></i> Simpan & Selesaikan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="{{ url('plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ url('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ url('/src/select2/dist/js/select2.min.js') }}"></script>
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {

            // Event ketika Checkbox Validasi Dicentang
            $('#check_validasi_selesai').on('change', function() {
                var isChecked = $(this).is(':checked');

                if (isChecked) {
                    // Aktifkan Form Rating & Tombol Simpan
                    $('#section-rating-content').removeClass('pe-none opacity-50');
                    $('#btn-simpan-rating').prop('disabled', false);
                } else {
                    // Kunci Kembali Form Rating & Tombol Simpan
                    $('#section-rating-content').addClass('pe-none opacity-50');
                    $('#btn-simpan-rating').prop('disabled', true);
                }
            });

            // Reset State saat Modal Dibersihkan / Dibuka
            $(document).on('click', '.btn-rate', function() {
                // Reset Checkbox & Disabled State
                $('#check_validasi_selesai').prop('checked', false);
                $('#section-rating-content').addClass('pe-none opacity-50');
                $('#btn-simpan-rating').prop('disabled', true);

                // Logika pembukaan modal & parse teknisi tetap sama seperti sebelumnya
            });

        });
        $(document).ready(function() {
            $('#id_ruang').select2({
                theme: 'bootstrap'
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Panggil Riwayat saat Ruangan Dipilih
            $('#id_ruang').on('change', function() {
                fetchHistory();
            });

            function fetchHistory() {
                var id_ruang = $('#id_ruang').val();

                if (!id_ruang) {
                    $('#state-pilih-ruangan').removeClass('d-none');
                    $('#state-loading').addClass('d-none');
                    $('#state-tabel').addClass('d-none');
                    return;
                }

                $('#state-pilih-ruangan').addClass('d-none');
                $('#state-tabel').addClass('d-none');
                $('#state-loading').removeClass('d-none');

                $.get("{{ url('permintaan/history') }}", {
                    id_ruang: id_ruang
                }, function(res) {
                    $('#state-loading').addClass('d-none');

                    if (res.success && res.data.length > 0) {
                        renderTable(res.data);
                        $('#state-tabel').removeClass('d-none');
                    } else {
                        $('#tbody-history').html(
                            '<tr><td colspan="6" class="text-center text-muted">Belum ada riwayat permintaan untuk ruangan ini.</td></tr>'
                        );
                        $('#state-tabel').removeClass('d-none');
                    }
                });
            }

            // Render Tabel Riwayat + Bintang Teknisi
            // Render Tabel Riwayat + Bintang Teknisi & Validasi Ruangan
            // Render Tabel Riwayat + Bintang Teknisi & Validasi Ruangan (REVISI STATUS)
            function renderTable(data) {
                var html = '';
                $.each(data, function(index, item) {
                    html += '<tr>';
                    html += '<td>' + (index + 1) + '</td>';
                    html += '<td>' + item.tanggal + '</td>';
                    html += '<td>' + item.masalah + '</td>';

                    // 1. STATUS TEKNISI & STATUS VALIDASI RUANGAN (Dua Badge)
                    html += '<td>';

                    // Badge Status Pekerjaan Teknisi
                    if (item.status === 'selesai') {
                        html +=
                            '<span class="badge badge-success mb-1"><i class="fas fa-check"></i> Selesai (Teknisi)</span><br>';
                    } else if (item.status === 'proses') {
                        html +=
                            '<span class="badge badge-primary mb-1"><i class="fas fa-cog fa-spin"></i> Dikerjakan</span><br>';
                    } else {
                        html +=
                            '<span class="badge badge-warning mb-1"><i class="fas fa-hourglass-half"></i> Pending</span><br>';
                    }

                    // Badge Status Validasi Ruangan
                    if (item.status === 'selesai') {
                        if (item.is_user_validated == 1) {
                            html +=
                                '<span class="badge badge-info"><i class="fas fa-user-check"></i> Validasi Ruangan</span>';
                        } else {
                            html +=
                                '<span class="badge badge-secondary"><i class="fas fa-user-clock"></i> Belum Validasi</span>';
                        }
                    }

                    html += '</td>';

                    // 2. DETAIL PEKERJAAN & TEKNISI
                    html += '<td>';
                    if (item.pekerjaan) {
                        html += '<b>Pekerjaan:</b> ' + (item.pekerjaan.perbaikan || '-') + '<br>';
                        html += '<b>Keterangan:</b> ' + (item.pekerjaan.keterangan || '-') + '<br>';
                        html += '<div class="mt-1"><b>Teknisi:</b><br>';

                        if (item.pekerjaan.list_teknisi && item.pekerjaan.list_teknisi.length > 0) {
                            $.each(item.pekerjaan.list_teknisi, function(i, t) {
                                html +=
                                    '<div class="d-inline-block border rounded px-2 py-1 mr-1 mb-1 bg-white">';
                                html += ' <span class="badge badge-info">' + t.nama + '</span> ';

                                // Tampilkan Bintang Rating Teknisi jika ada
                                if (t.rating) {
                                    html += '<span class="text-warning text-xs ml-1">';
                                    for (var r = 1; r <= 5; r++) {
                                        html += '<i class="' + (r <= t.rating ? 'fas' : 'far') +
                                            ' fa-star"></i>';
                                    }
                                    html += '</span>';
                                }
                                html += '</div>';
                            });
                        } else {
                            html += '<small class="text-muted">-</small>';
                        }
                        html += '</div>';
                    } else {
                        html += '<span class="text-muted">Belum dikerjakan</span>';
                    }
                    html += '</td>';

                    // 3. NILAI KEPUASAN & TOMBOL KONFIRMASI
                    html += '<td class="text-center">';
                    if (item.status === 'selesai') {
                        if (item.is_user_validated == 1 && item.rating_kepuasan) {
                            // Jika sudah divalidasi dan dinilai oleh ruangan
                            html += '<div class="text-warning mb-1">';
                            for (var i = 1; i <= 5; i++) {
                                html += '<i class="' + (i <= item.rating_kepuasan ? 'fas' : 'far') +
                                    ' fa-star"></i>';
                            }
                            html += '</div>';
                            if (item.catatan_kepuasan) {
                                html += '<small class="text-muted d-block"><i>"' + item.catatan_kepuasan +
                                    '"</i></small>';
                            }
                        } else {
                            // Jika status teknisi selesai tapi belum dikonfirmasi ruangan
                            var listTeknisi = item.pekerjaan ? item.pekerjaan.list_teknisi : [];
                            var teknisiJson = JSON.stringify(listTeknisi).replace(/'/g, "&apos;");

                            html +=
                                '<button type="button" class="btn btn-sm btn-warning font-weight-bold btn-rate" data-id="' +
                                item.id + '" data-teknisi=\'' + teknisiJson + '\'>';
                            html += '<i class="fas fa-check-circle"></i> Konfirmasi & Beri Nilai</button>';
                        }
                    } else {
                        html += '<span class="text-muted">-</span>';
                    }
                    html += '</td>';

                    html += '</tr>';
                });

                $('#tbody-history').html(html);
            }

            // Star Rating Interaktif Utama
            $('#star-main i').on('click', function() {
                var val = $(this).data('value');
                $('#input_rating_kepuasan').val(val);
                $('#star-main i').each(function(index) {
                    if (index < val) {
                        $(this).removeClass('far').addClass('fas active');
                    } else {
                        $(this).removeClass('fas active').addClass('far');
                    }
                });
            });

            // Modal Rating Buka
            // Buka Modal Rating & Render Teknisi (VERSI FIX ERROR)
            $(document).on('click', '.btn-rate', function() {
                var id = $(this).data('id');
                var rawTeknisi = $(this).attr(
                    'data-teknisi'); // Gunakan .attr() agar selalu membaca String mentah
                var teknisiList = [];

                // Parsing aman agar tidak crash/error tipe data
                try {
                    if (typeof rawTeknisi === 'string') {
                        teknisiList = JSON.parse(rawTeknisi);
                    } else if (Array.isArray(rawTeknisi)) {
                        teknisiList = rawTeknisi;
                    }
                } catch (e) {
                    console.error("Gagal parse data teknisi:", e);
                    teknisiList = [];
                }

                $('#rating_id_permintaan').val(id);
                $('#input_rating_kepuasan').val('');
                $('#star-main i').removeClass('fas active').addClass('far');
                $('#form-rating')[0].reset();

                var htmlTeknisi = '';

                if (Array.isArray(teknisiList) && teknisiList.length > 0) {
                    $.each(teknisiList, function(i, t) {
                        htmlTeknisi +=
                            '<div class="d-flex align-items-center justify-content-between mb-2 p-2 border rounded bg-light">';
                        htmlTeknisi += '  <span><b>' + t.nama + '</b></span>';
                        htmlTeknisi += '  <div class="star-rating-teknisi" data-teknisi-id="' + t
                            .id + '">';
                        for (var k = 1; k <= 5; k++) {
                            htmlTeknisi += '  <i class="far fa-star" data-value="' + k + '"></i> ';
                        }
                        htmlTeknisi += '    <input type="hidden" name="rating_teknisi[' + t.id +
                            ']" class="input-rating-teknisi">';
                        htmlTeknisi += '  </div>';
                        htmlTeknisi += '</div>';
                    });
                } else {
                    htmlTeknisi = '<small class="text-muted">Tidak ada teknisi spesifik terdaftar.</small>';
                }

                $('#container-teknisi-rating').html(htmlTeknisi);
                $('#modalRating').modal('show');
            });

            // Star Rating Interaktif Per Teknisi
            $(document).on('click', '.star-rating-teknisi i', function() {
                var val = $(this).data('value');
                var container = $(this).closest('.star-rating-teknisi');
                container.find('.input-rating-teknisi').val(val);
                container.find('i').each(function(index) {
                    if (index < val) {
                        $(this).removeClass('far').addClass('fas active');
                    } else {
                        $(this).removeClass('fas active').addClass('far');
                    }
                });
            });

            // Submit Penilaian Kepuasan via AJAX + Notifikasi & Auto-refresh Riwayat
            $('#form-rating').on('submit', function(e) {
                e.preventDefault();

                if (!$('#input_rating_kepuasan').val()) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Perhatian',
                        text: 'Mohon beri bintang penilaian kepuasan terlebih dahulu!'
                    });
                    return;
                }

                var btn = $('#btn-simpan-rating');
                btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Menyimpan...');

                $.ajax({
                    url: "{{ url('permintaan/simpan-rating') }}",
                    type: "POST",
                    data: $(this).serialize(),
                    success: function(res) {
                        btn.prop('disabled', false).html(
                            '<i class="fas fa-save"></i> Simpan Penilaian');

                        if (res.success) {
                            $('#modalRating').modal('hide');

                            // Pop-up Notifikasi Berhasil
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: res.message,
                                timer: 2000,
                                showConfirmButton: false
                            }).then(function() {
                                // Otomatis refresh riwayat ruangan tanpa reload halaman full
                                fetchHistory();
                            });
                        }
                    },
                    error: function() {
                        btn.prop('disabled', false).html(
                            '<i class="fas fa-save"></i> Simpan Penilaian');
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: 'Terjadi kesalahan sistem, silakan coba lagi.'
                        });
                    }
                });
            });

        });
    </script>
</body>

</html>
