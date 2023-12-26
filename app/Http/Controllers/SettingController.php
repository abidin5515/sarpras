<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CatatanPemeliharaan;
use App\CatatanPemeliharaanChecklist;
use App\CatatanPemeliharaanChecklistValue;
use App\MaintenanceInspection;
use App\Perbaikan;
use App\PerbaikanPetugas;
use App\PermintaanPelayanan;

class SettingController extends Controller
{
    //

    public function setting(){
    	return view('setting.setting');
    }

    public function reset(){
    	// echo "string";
		CatatanPemeliharaan::truncate();
		CatatanPemeliharaanChecklist::truncate();
		CatatanPemeliharaanChecklistValue::truncate();
		MaintenanceInspection::truncate();
		Perbaikan::truncate();
		PerbaikanPetugas::truncate();
		PermintaanPelayanan::truncate();


		 $success= true;
          $msg = 'Data Deleted successfully';

          return [
          	'success'=>$success,
          	'msg'=>$msg
          ];


    }
}
