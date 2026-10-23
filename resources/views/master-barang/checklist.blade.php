<form action="{{ url('master-barang/' . $data->id . '/checklist') }}" method="POST">
    @csrf
    <div class="modal-body">
        <p class="text-muted">Atur poin-poin parameter pengecekan rutin untuk jenis alat: <b>{{ $data->nama }}</b></p>

        <div id="list-pertanyaan">
            @if (count($checklists) > 0)
                @foreach ($checklists as $key => $c)
                    <div class="input-group mb-2 item-row">
                        <input type="text" name="pertanyaan[]" class="form-control" value="{{ $c->pertanyaan }}"
                            placeholder="Contoh: Cek fisik & kebersihan" required>
                        <div class="input-group-append">
                            <button type="button" class="btn btn-danger remove-row"><i
                                    class="fas fa-trash"></i></button>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="input-group mb-2 item-row">
                    <input type="text" name="pertanyaan[]" class="form-control"
                        placeholder="Contoh: Cek fisik & kebersihan" required>
                    <div class="input-group-append">
                        <button type="button" class="btn btn-danger remove-row"><i class="fas fa-trash"></i></button>
                    </div>
                </div>
            @endif
        </div>

        <button type="button" class="btn btn-sm btn-success mt-2" id="add-row"><i class="fas fa-plus"></i> Tambah
            Poin Cek</button>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </div>
</form>

<script>
    // Skrip JavaScript murni untuk tambah/hapus baris input saja (tanpa AJAX)
    $(document).ready(function() {
        $('#add-row').click(function() {
            let html = `
            <div class="input-group mb-2 item-row">
                <input type="text" name="pertanyaan[]" class="form-control" placeholder="Contoh: Uji fungsi tombol" required>
                <div class="input-group-append">
                    <button type="button" class="btn btn-danger remove-row"><i class="fas fa-trash"></i></button>
                </div>
            </div>
        `;
            $('#list-pertanyaan').append(html);
        });

        $(document).on('click', '.remove-row', function() {
            $(this).closest('.item-row').remove();
        });
    });
</script>
