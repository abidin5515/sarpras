<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Permintaan; // Sesuaikan dengan model laporan/permintaan Anda
use App\Pekerjaan;
use App\Teknisi; // Panggil model Teknisi
use Image; // Panggil library Image jika diperlukan
use PDF; // Panggil library PDF jika diperlukan
class PermintaanPerbaikanController extends Controller
{
    // Menampilkan halaman index (List Laporan Rusak)
   // 1. HALAMAN INDEX DENGAN FILTER
  public function index(Request $request)
{
    // Atur default tanggal: Hari ini dan 2 bulan yang lalu
    $default_sampai = date('Y-m-d');
    $default_dari = date('Y-m-d', strtotime('-2 months'));

    // Tangkap request atau gunakan default
    $dari_tanggal = $request->filled('dari_tanggal') ? $request->dari_tanggal : $default_dari;
    $sampai_tanggal = $request->filled('sampai_tanggal') ? $request->sampai_tanggal : $default_sampai;
    $status = $request->status;

    // Join tabel permintaan dengan pekerjaan
   $query = Permintaan::leftJoin('pekerjaan', 'permintaan.id', '=', 'pekerjaan.id_permintaan')
        ->select(
            'permintaan.id as id_permintaan', 'permintaan.created_at', 'permintaan.masalah', 'permintaan.status', 'permintaan.foto as foto_laporan',
            'pekerjaan.id as id_pekerjaan', 'pekerjaan.tindakan_sementara', 'pekerjaan.tindakan_perbaikan', 'pekerjaan.id_teknisi', 'pekerjaan.tanggal', 
            'pekerjaan.jam_mulai', 'pekerjaan.jam_selesai' // <--- Tambahkan jam_selesai di sini
        );

    // Filter berdasarkan rentang tanggal lapor (created_at)
    $query->whereDate('permintaan.created_at', '>=', $dari_tanggal)
          ->whereDate('permintaan.created_at', '<=', $sampai_tanggal);

    // Filter berdasarkan status jika dipilih
    if (!empty($status)) {
        $query->where('permintaan.status', $status);
    }

    $permintaan = $query->orderBy('permintaan.created_at', 'desc')->get();
    
    // Kirim data dan parameter filter ke view agar inputan tidak kereset saat difilter
    return view('permintaan_perbaikan.index', compact('permintaan', 'dari_tanggal', 'sampai_tanggal', 'status'));
}

    // 2. TAMPILKAN DETAIL (SHOW)
    public function show($id)
    {
        $data = Permintaan::leftJoin('pekerjaan', 'permintaan.id', '=', 'pekerjaan.id_permintaan')
            ->where('permintaan.id', $id)
            ->select('permintaan.*', 'pekerjaan.*', 'permintaan.id as id_permintaan', 'pekerjaan.id as id_pekerjaan', 'permintaan.foto as foto_laporan', 'pekerjaan.foto as foto_perbaikan')
            ->firstOrFail();

        return view('permintaan_perbaikan.show', compact('data'));
    }

    // 3. TAMPILKAN FORM EDIT
    public function edit($id_pekerjaan)
    {
        $pekerjaan = Pekerjaan::findOrFail($id_pekerjaan);
        $permintaan = Permintaan::findOrFail($pekerjaan->id_permintaan);
        $teknisi = Teknisi::all();
        
        // Teknisi yang sudah dipilih sebelumnya
        $teknisi_terpilih = $pekerjaan->id_teknisi ? explode(',', $pekerjaan->id_teknisi) : [];

        return view('permintaan_perbaikan.edit', compact('pekerjaan', 'permintaan', 'teknisi', 'teknisi_terpilih'));
    }

    // 4. PROSES UPDATE DATA
    public function update(Request $request, $id_pekerjaan)
    {
        $pekerjaan = Pekerjaan::findOrFail($id_pekerjaan);
        
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $namaFile = time() . '_' . $file->getClientOriginalName();
            $tujuan_upload = 'gambar_pekerjaan/';
            $namaUpload = $tujuan_upload . $namaFile;
            
            $img = Image::make($file->getRealPath());
            $img->resize(450, 450, function ($constraint) { $constraint->aspectRatio(); })->save($tujuan_upload . $namaFile);
            $pekerjaan->foto = $namaUpload;
        }

        $pekerjaan->tindakan_sementara = $request->tindakan_sementara;
        $pekerjaan->permasalahan = $request->permasalahan;
        $pekerjaan->tindakan_perbaikan = $request->tindakan_perbaikan;
        $pekerjaan->tanggal = $request->tanggal;
        $pekerjaan->jam_mulai = $request->jam;
        $pekerjaan->status = $request->status;
        $pekerjaan->id_teknisi = implode(",", $request->id_teknisi);
        $pekerjaan->save();

        // Update status permintaan
        $permintaan = Permintaan::find($pekerjaan->id_permintaan);
        if ($permintaan) {
            $permintaan->status = $request->status;
            $permintaan->save();
        }

        return redirect('permintaan-perbaikan')->with('success', 'Data perbaikan berhasil diubah!');
    }

    // 5. CETAK PDF LENGKAP
    public function printPdf($id_pekerjaan)
    {
        $data = Permintaan::join('pekerjaan', 'permintaan.id', '=', 'pekerjaan.id_permintaan')
            ->where('pekerjaan.id', $id_pekerjaan)
            ->select('permintaan.*', 'pekerjaan.*', 'permintaan.id as id_permintaan', 'pekerjaan.id as id_pekerjaan')
            ->firstOrFail();

        $pdf = PDF::loadView('permintaan_perbaikan.print_pdf', compact('data'));
        $pdf->setPaper('A4', 'portrait');
        
        return $pdf->stream('Laporan_Perbaikan_'.$data->id_pekerjaan.'.pdf');
    }

    // Menampilkan halaman form perbaikan (kiri data, kanan form)
    public function kerjakan($id)
    {
        $permintaan = Permintaan::findOrFail($id);
        $teknisi = Teknisi::all(); // Ambil list teknisi

        return view('permintaan_perbaikan.kerjakan', compact('permintaan', 'teknisi'));
    }

public function store(Request $request)
    {
        // 1. Ubah validasi foto menjadi nullable (opsional)
        $request->validate([
            'tindakan_sementara' => 'required',
            // 'permasalahan' => 'required',
            // 'tindakan_perbaikan' => 'required',
            'tanggal' => 'required',
            'jam_mulai' => 'required',     // <--- Ubah dari 'jam'
        'jam_selesai' => 'required',
            'foto' => 'nullable|image', 
            'id_teknisi' => 'required|array',
        ]);

        $namaUpload = null;

        // 2. Cek apakah ada file foto yang diupload
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $namaFile = time() . '_' . $file->getClientOriginalName();
            $tujuan_upload = 'gambar_pekerjaan/';
            $namaUpload = $tujuan_upload . $namaFile;
            
            $img = Image::make($file->getRealPath());
            $img->resize(450, 450, function ($constraint) {
                $constraint->aspectRatio();
            })->save($tujuan_upload . $namaFile);
        }

        $id_teknisi = implode(",", $request->id_teknisi);

        $pekerjaan = new Pekerjaan;
        $pekerjaan->id_permintaan = $request->id_permintaan;
        $pekerjaan->tindakan_sementara = $request->tindakan_sementara;
        $pekerjaan->permasalahan = $request->permasalahan;
        $pekerjaan->tindakan_perbaikan = $request->tindakan_perbaikan;
        $pekerjaan->tanggal = $request->tanggal;
        $pekerjaan->jam_mulai = $request->jam;
        $pekerjaan->status = $request->status;
        $pekerjaan->id_teknisi = $id_teknisi;
        $pekerjaan->jam_selesai = $request->jam; 
        $pekerjaan->lokasi = $request->lokasi ?? '-'; 
        
        // 3. Simpan namaUpload hanya jika ada file yang diunggah
        if ($namaUpload) {
            $pekerjaan->foto = $namaUpload; 
        }

        $pekerjaan->save();

        // Update status permintaan
        $permintaan = Permintaan::find($request->id_permintaan);
        if ($permintaan) {
            $permintaan->status = $request->status;
            $permintaan->save();
        }

        return redirect('permintaan-perbaikan')->with('success', 'Data perbaikan berhasil disimpan!');
    }
}
