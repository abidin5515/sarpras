<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Alat;
use App\Ruangan;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use App\HistoryPenempatan;
use App\KategoriChecklist;
use PDF;
use App\Checklist;
use App\UploadJadwal;
use App\Pekerjaan;
use App\Permintaan;
use Carbon\Carbon;
use App\Teknisi;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    public function index()
    {
        $jadwal_aktif = UploadJadwal::where('is_aktif', 1)->first();
        if ($jadwal_aktif) {
            $url_jadwal = url($jadwal_aktif->tempat_file);
        } else {
            $url_jadwal = null;
        }

        $dari   = request('dari') ?? Carbon::now()->subMonth()->format('Y-m-d');
        $sampai = request('sampai') ?? Carbon::now()->format('Y-m-d');

        $dataTeknisi = Teknisi::select('teknisi.id', 'teknisi.nama')
            ->selectSub(function ($q) use ($dari, $sampai) {
                $q->from('pekerjaan')
                    ->selectRaw('COUNT(*)')
                    ->whereBetween('tanggal', [$dari, $sampai])
                    ->whereRaw('FIND_IN_SET(teknisi.id, pekerjaan.id_teknisi)');
            }, 'jumlah_perbaikan')
            ->selectSub(function ($q) use ($dari, $sampai) {
                $q->from('kegiatan_sarpras')
                    ->join('kegiatan_teknisi', 'kegiatan_teknisi.kegiatan_id', '=', 'kegiatan_sarpras.id')
                    ->selectRaw('COUNT(DISTINCT kegiatan_sarpras.id)')
                    ->whereBetween('kegiatan_sarpras.tanggal', [$dari, $sampai])
                    ->whereColumn('kegiatan_teknisi.teknisi_id', 'teknisi.id');
            }, 'jumlah_kegiatan')
            ->orderByDesc(DB::raw('(jumlah_perbaikan + jumlah_kegiatan)'))
            ->get();

        // $pdf = PDF::loadView('catatan_pemeliharaan.print-filter', compact('url_jadwal'));
        return view('home.index', compact('url_jadwal', 'dataTeknisi', 'dari', 'sampai'));
    }

    public function perbaikan_hariini()
    {
        $data = Pekerjaan::where('tanggal', date('Y-m-d'))->get();
        return view('home.perbaikan_hariini', compact('data'));
    }

    public function permintaan_pending()
    {
        @$data = Permintaan::where('status', 'pending')->get();
        return view('home.permintaan_pending', compact('data'));
    }
}
