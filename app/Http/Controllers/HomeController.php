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

class HomeController extends Controller
{
    
    public function index(){
        $jadwal_aktif = UploadJadwal::where('is_aktif', 1)->first();
        if ($jadwal_aktif) {
        	$url_jadwal = url($jadwal_aktif->tempat_file);
        }else {
        	$url_jadwal = null;
        }
        
        // $pdf = PDF::loadView('catatan_pemeliharaan.print-filter', compact('url_jadwal'));
        return view('home.index', compact('url_jadwal'));
    }

    public function perbaikan_hariini(){
    	$data = Pekerjaan::where('tanggal', date('Y-m-d'))->get();
    	return view('home.perbaikan_hariini', compact('data'));
    }

        public function permintaan_pending()
    {
        $data = Permintaan::where('status','pending')->get();
        return view('home.permintaan_pending', compact('data'));
    }
}