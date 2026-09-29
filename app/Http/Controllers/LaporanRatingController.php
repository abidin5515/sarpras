<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Permintaan;
use App\Pekerjaan;
use App\Teknisi;
use App\Ruangan;
use DB;

class LaporanRatingController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->start_date ?? date('Y-m-01'); // Default awal bulan
        $endDate = $request->end_date ?? date('Y-m-t');    // Default akhir bulan
        $id_ruang = $request->id_ruang;

        // Base Query Permintaan yang Selesai & Memiliki Rating
        $query = Permintaan::with(['pekerjaan', 'ruangan'])
            ->where('status', 'selesai')
            ->whereNotNull('rating_kepuasan')
            ->whereBetween(DB::raw('DATE(created_at)'), [$startDate, $endDate]);

        if ($id_ruang) {
            $query->where('id_ruang', $id_ruang);
        }

        $laporan = $query->orderBy('created_at', 'desc')->get();

        // 1. Kalkulasi Ringkasan Metric (KPI Cards)
        $totalUlasan = $laporan->count();
        $avgRatingLayanan = $totalUlasan > 0 ? round($laporan->avg('rating_kepuasan'), 2) : 0;

        // 2. Kalkulasi Performa Per Teknisi
        $allTeknisi = Teknisi::all();
        $rekapTeknisi = [];

        foreach ($allTeknisi as $tek) {
            $rekapTeknisi[$tek->id] = [
                'id' => $tek->id,
                'nama' => $tek->nama,
                'total_pekerjaan' => 0,
                'total_rating' => 0,
                'avg_rating' => 0,
            ];
        }

        foreach ($laporan as $p) {
            if ($p->pekerjaan && $p->pekerjaan->rating_teknisi) {
                $ratings = json_decode($p->pekerjaan->rating_teknisi, true) ?? [];
                foreach ($ratings as $r) {
                    $t_id = $r['id_teknisi'] ?? null;
                    $score = $r['rating'] ?? 0;

                    if ($t_id && isset($rekapTeknisi[$t_id])) {
                        $rekapTeknisi[$t_id]['total_pekerjaan'] += 1;
                        $rekapTeknisi[$t_id]['total_rating'] += $score;
                    }
                }
            }
        }

        // Calculate Average Per Teknisi
        foreach ($rekapTeknisi as $id => $data) {
            if ($data['total_pekerjaan'] > 0) {
                $rekapTeknisi[$id]['avg_rating'] = round($data['total_rating'] / $data['total_pekerjaan'], 2);
            }
        }

        // Urutkan Teknisi dari Rating Tertinggi
        usort($rekapTeknisi, function ($a, $b) {
            return $b['avg_rating'] <=> $a['avg_rating'];
        });

        $ruangan = Ruangan::all();

        return view('admin.laporan_rating', compact(
            'laporan', 
            'rekapTeknisi', 
            'totalUlasan', 
            'avgRatingLayanan', 
            'startDate', 
            'endDate', 
            'ruangan', 
            'id_ruang'
        ));
    }
}