<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MasterBarang;
use App\MasterChecklist;
use App\Inventaris;
use App\ChecklistHeader;
use App\ChecklistDetail;
use App\Teknisi;

class ChecklistController extends Controller
{
    protected $dir = "checklist";
    protected $url = "checklist";

    // --- BAGIAN 1: SETTING MASTER CHECKLIST PER NAMA BARANG ---
    
    public function settingIndex($master_barang_id) {
        $barang = MasterBarang::findOrFail($master_barang_id);
        $checklists = MasterChecklist::where('master_barang_id', $master_barang_id)->orderBy('urutan', 'asc')->get();
        $title = "Setting Checklist: " . $barang->nama;
        
        return view($this->dir . '.setting', compact('barang', 'checklists', 'title'));
    }

    public function settingStore(Request $request, $master_barang_id) {
        $request->validate([
            'pertanyaan' => 'required|array',
        ]);

        // Hapus atau sinkronisasi ulang poin checklist untuk master barang ini
        // Atau sistem tambah satu-satu, di sini kita contohkan simpan array pertanyaan:
        MasterChecklist::where('master_barang_id', $master_barang_id)->delete();

        if($request->has('pertanyaan')) {
            foreach($request->pertanyaan as $index => $item) {
                if(!empty($item)) {
                    MasterChecklist::create([
                        'master_barang_id' => $master_barang_id,
                        'pertanyaan' => $item,
                        'urutan' => $index + 1
                    ]);
                }
            }
        }

        return ['success' => true, 'msg' => 'Setting checklist berhasil disimpan!'];
    }


    public function createChecklist(Request $request, $inventaris_id) {
        $inventaris = Inventaris::with('masterbarang')->findOrFail($inventaris_id);
        
        // Ambil parameter checklist berdasarkan master barang dari inventaris ini
        $master_checklists = MasterChecklist::where('master_barang_id', $inventaris->master_barang_id)->get();
        
        // Bulan dan Tahun aktif (bisa dilempar dari request, default bulan sekarang)
        $bulan = $request->get('bulan', date('n')); 
        $tahun = date('Y');

        // Cek apakah sudah pernah diisi di bulan & tahun tersebut
        $existingHeader = ChecklistHeader::where('inventaris_id', $inventaris_id)
            ->where('bulan', $bulan)
            ->where('tahun', $tahun)
            ->first();

        $title = "Form Checklist Pemeliharaan Alat";
        $teknisis = Teknisi::all(); // Untuk pilihan teknisi yang melakukan

        return view($this->dir . '.form', compact('inventaris', 'master_checklists', 'existingHeader', 'bulan', 'tahun', 'title', 'teknisis'));
    }

    // Menyimpan hasil checklist bulanan
    public function storeChecklist(Request $request, $inventaris_id) {
        $request->validate([
            'teknisi_id' => 'required',
            'bulan' => 'required',
            'status' => 'required',
        ]);

        $tahun = date('Y');
        $bulan = $request->bulan;

        // Simpan atau Update Header Checklist Bulanan
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

        // Simpan Detail Jawaban per Pertanyaan Checklist
        if($request->has('jawaban')) {
            foreach($request->jawaban as $master_checklist_id => $val) {
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

        return ['success' => true, 'msg' => 'Checklist bulanan berhasil disimpan dan tercatat oleh teknisi!'];
    }
}