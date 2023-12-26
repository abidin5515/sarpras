<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use App\DataAlkes;
use App\PermintaanPelayanan;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function dashboard(){
    	$alkes = DataAlkes::all();
    	$jumlah_alkes = $alkes->count();
    	
    	$permintaan_pelayanan = PermintaanPelayanan::where('status', '0');
    	$jumlah_permintaan = $permintaan_pelayanan->count();
    	return view('dashboard', compact('jumlah_alkes', 'jumlah_permintaan'));
    }
}
