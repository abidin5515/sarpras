<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Inventaris;
use App\MasterChecklist;
use App\ChecklistHeader;
use App\ChecklistDetail;
use App\Teknisi;

class InventarisChecklistController extends Controller
{
    // Menampilkan form checklist bulanan per unit inventaris
    public function index(Request $request, $inventaris_id)
    {
        $inventaris = Inventaris::with('masterbarang')->findOrFail($inventaris_id);
        
        // Ambil daftar pertanyaan checklist berdasarkan master barang alat ini
        $master_checklists = MasterChecklist::where('master_barang_id', $inventaris->master_barang_id)
                                            ->orderBy('urutan', 'asc')
                                            ->get();

        // Filter bulan (default bulan sekarang, misal 1-12)
        $bulan = $request->get('bulan', date('n'));
        $tahun = date('Y');

        // Cek apakah data checklist pada bulan tersebut sudah pernah diisi
        $header = ChecklistHeader::where('inventaris_id', $inventaris_id)
                                 ->where('bulan', $bulan)
                                 ->where('tahun', $tahun)
                                 ->first();

        // Ambil daftar teknisi untuk pilihan siapa yang melakukan checklist
        $teknisis = Teknisi::all();

        $title = "Checklist Pemeliharaan Alat";

        return view('inventaris.checklist', compact('inventaris', 'master_checklists', 'bulan', 'tahun', 'header', 'teknisis', 'title'));
    }

    // Menyimpan hasil checklist bulanan oleh teknisi (Tanpa AJAX, form submit biasa)


    // Menampilkan rekap/hasil checklist seluruh inventaris dengan filter bulan & tahun
    public function rekap(Request $request)
    {
        $bulan = $request->get('bulan', date('n'));
        $tahun = $request->get('tahun', date('Y'));
        $ruang = $request->get('ruang');

        $query = \App\ChecklistHeader::with(['inventaris.masterbarang', 'inventaris.masterruang', 'teknisi'])
                    ->where('bulan', $bulan)
                    ->where('tahun', $tahun);

        if (!empty($ruang) && $ruang != '-') {
            $query->whereHas('inventaris', function($q) use ($ruang) {
                $q->where('ruang', $ruang);
            });
        }

        $data = $query->get();
        $title = "Rekap Checklist Pemeliharaan Alat";

        return view('inventaris.rekap_checklist', compact('data', 'bulan', 'tahun', 'ruang', 'title'));
    }

    public function show(Request $request, $inventaris_id)
    {
        $inventaris = Inventaris::with(['masterbarang', 'mastermerk', 'masterruang'])->findOrFail($inventaris_id);
        
        // Ambil daftar pertanyaan settingan dari Master Barang
        $master_checklists = MasterChecklist::where('master_barang_id', $inventaris->master_barang_id)
                                            ->orderBy('urutan', 'asc')
                                            ->get();

        // Filter bulan yang dipilih (default bulan berjalan)
        $bulan = $request->get('bulan', date('n'));
        $tahun = date('Y');

        // Ambil data checklist jika sudah pernah diisi pada bulan & tahun tersebut
        $header = ChecklistHeader::where('inventaris_id', $inventaris_id)
                                 ->where('bulan', $bulan)
                                 ->where('tahun', $tahun)
                                 ->first();

        // Ambil riwayat checklist semua bulan di tahun ini untuk ditampilkan sebagai rekap di halaman yang sama
        $riwayat = ChecklistHeader::where('inventaris_id', $inventaris_id)
                                  ->where('tahun', $tahun)
                                  ->with('teknisi')
                                  ->orderBy('bulan', 'asc')
                                  ->get();

        $teknisis = Teknisi::all();
        $title = "Detail & Form Checklist Inventaris";

        return view('inventaris.checklist_detail', compact(
            'inventaris', 'master_checklists', 'bulan', 'tahun', 'header', 'riwayat', 'teknisis', 'title'
        ));
    }

    // Menyimpan form checklist
    public function store(Request $request, $inventaris_id)
    {
        $request->validate([
            'teknisi_id' => 'required',
            'bulan' => 'required',
            'status' => 'required',
        ]);

        $tahun = date('Y');
        $bulan = $request->bulan;

        // Simpan / Update Header
        $header = ChecklistHeader::updateOrCreate(
            [
                'inventaris_id' => $inventaris_id,
                'bulan' => $bulan,
                'tahun' => $tahun,
            ],
            [
                'teknisi_id' => $request->teknisi_id,
                'status' => $request->status,
                'keterangan_umum' => $request->keterangan_umum,
            ]
        );

        // Simpan Detail Jawaban Checklist
        if ($request->has('jawaban')) {
            foreach ($request->jawaban as $master_checklist_id => $val) {
                ChecklistDetail::updateOrCreate(
                    [
                        'checklist_header_id' => $header->id,
                        'master_checklist_id' => $master_checklist_id,
                    ],
                    [
                        'jawaban' => $val,
                        'keterangan' => $request->ket_detail[$master_checklist_id] ?? null
                    ]
                );
            }
        }

        return redirect()->back()->with('success', 'Data checklist berhasil disimpan!');
    }
}