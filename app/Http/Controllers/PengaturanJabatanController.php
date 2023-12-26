<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\PengaturanJabatan; 



class PengaturanJabatanController extends Controller
{
    protected $dir = "pengaturan_jabatan";
    protected $url = "pengaturan_jabatan";

    public function index(){
        $data = PengaturanJabatan::find(1);
        return view($this->dir.'/index', compact('data'));
    }

    public function update(Request $req){
        $kepala_instalasi_alkes = $req->kepala_instalasi_alkes;
        $up = PengaturanJabatan::find(1);
        $up->kepala_instalasi_alkes = $kepala_instalasi_alkes;
        $save = $up->save();
        if ($save) {
            $msg = "data saved successfully";
            $success = true;
        }
        else {
            $msg = "data failed to save";
            $success = false;
        }
    
        return [
          'success'=>$success,
          'msg'=>$msg
        ];
    }
}
