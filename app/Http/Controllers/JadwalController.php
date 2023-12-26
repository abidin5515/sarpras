<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Ruangan; 
use PDF;
use App\Jadwal;
use App\JadwalDetail;
use App\Teknisi;
use App\PengaturanJabatan;

class JadwalController extends Controller
{
  protected $dir = "jadwal";
  protected $url = "jadwal";

  public function index()
  { 


    $bulan = array(1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
    $tahun = array('2020', '2021', '2022', '2023', '2024', '2025', '2026', '2027', '2028', '2029', '2030');  
    
    @$bulan_get = ($_GET['bulan'] != '' ? $_GET['bulan'] : date('m'));
    @$tahun_get = ($_GET['tahun'] != '' ? $_GET['tahun'] : date('Y'));
    // echo $bulan_get;
    // echo "<br>";
    // echo $tahun_get;
    // return;
    $data = Jadwal::where('bulan', $bulan_get)->where('tahun', $tahun_get)->get();
    
    return view($this->dir.'/index', compact('data', 'tahun', 'bulan'));
  }

  public function create()
  {
    $bulan = array(1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
    $tahun = array('2020', '2021', '2022', '2023', '2024', '2025', '2026', '2027', '2028', '2029', '2030');

    return view($this->dir.'/create', compact('bulan', 'tahun'));
  }

  public function store(Request $req){
    // print_r($req->all());

    // $minggu1 = $req->minggu1;
    // print_r($minggu1);
    // return;

    $id_petugas = $req->id_petugas;
    $bulan = $req->bulan;
    $tahun = $req->tahun;
    $keterangan = $req->keterangan;

    $new = new Jadwal;
    $new->id_petugas = $id_petugas;
    $new->bulan = $bulan;
    $new->tahun = $tahun;
    $new->keterangan = $keterangan;
    $save = $new->save();
    $id = $new->id;
    if($save){
      // insert to jadwal_detail
      $minggu1 = $req->minggu1;
      $minggu2 = $req->minggu2;
      $minggu3 = $req->minggu3;
      $minggu4 = $req->minggu4;
      // print_r($minggu);
      if($minggu1){
        foreach ($minggu1 as $key) {
          $to_detail = new JadwalDetail;
          $to_detail->id_jadwal = $id;
          $to_detail->minggu = 1;
          $to_detail->id_ruangan = $key;
          $to_detail->save();
        }
      }

      if($minggu2){
        foreach ($minggu2 as $key) {
          $to_detail = new JadwalDetail;
          $to_detail->id_jadwal = $id;
          $to_detail->minggu = 2;
          $to_detail->id_ruangan = $key;
          $to_detail->save();
        }
      }

      if($minggu3){
        foreach ($minggu3 as $key) {
          $to_detail = new JadwalDetail;
          $to_detail->id_jadwal = $id;
          $to_detail->minggu = 3;
          $to_detail->id_ruangan = $key;
          $to_detail->save();
        }
      }
      if($minggu4){
        foreach ($minggu4 as $key) {
          $to_detail = new JadwalDetail;
          $to_detail->id_jadwal = $id;
          $to_detail->minggu = 4;
          $to_detail->id_ruangan = $key;
          $to_detail->save();
        }
      }
      $msg = "data saved successfully";
            $success = true;
    }else {
      $msg = "data failed to save";
      $success = false;
    }

    return [
      'success'=>$success,
      'msg'=>$msg
    ];

  }

  public function destory($id){
    $hapus = Jadwal::find($id);
    $del = $hapus->delete();

    if($del){
      $hapus_detail = JadwalDetail::where('id_jadwal', $id);
      $del2 = $hapus_detail->delete(); 
      if($del2){
        $msg = 'Data Deleted successfully';
        $success = true;
      }else {
        $msg = 'Failed to delete ';
            $success = false;
      }
    }else {
      $msg = 'Failed to delete ';
            $success = false;
    }
      
    return [
          'success'=>$success,
          'msg'=>$msg
        ];
  }


  public function edit($id){
    $data = Jadwal::find($id);
    $bulan = array(1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
    $tahun = array('2020', '2021', '2022', '2023', '2024', '2025', '2026', '2027', '2028', '2029', '2030'); 
    return view($this->dir.'/edit', compact('data', 'bulan', 'tahun'));
  }

  public function update(Request $req, $id){
    $id_petugas = $req->id_petugas;
    $bulan = $req->bulan;
    $tahun = $req->tahun;
    $keterangan = $req->keterangan;

    $update = Jadwal::find($id);
    $update->id_petugas = $id_petugas;
    $update->bulan = $bulan;
    $update->tahun = $tahun;
    $update->keterangan = $keterangan;
    $save = $update->save();

    $hapus_detail = JadwalDetail::where('id_jadwal', $id);
    if($hapus_detail){
      $hapus_detail->delete();  
    }

    if($save){
      // insert to jadwal_detail
      $minggu1 = $req->minggu1;
      $minggu2 = $req->minggu2;
      $minggu3 = $req->minggu3;
      $minggu4 = $req->minggu4;
      // print_r($minggu);
      if($minggu1){
        foreach ($minggu1 as $key) {
          $to_detail = new JadwalDetail;
          $to_detail->id_jadwal = $id;
          $to_detail->minggu = 1;
          $to_detail->id_ruangan = $key;
          $to_detail->save();
        }
      }

      if($minggu2){
        foreach ($minggu2 as $key) {
          $to_detail = new JadwalDetail;
          $to_detail->id_jadwal = $id;
          $to_detail->minggu = 2;
          $to_detail->id_ruangan = $key;
          $to_detail->save();
        }
      }

      if($minggu3){
        foreach ($minggu3 as $key) {
          $to_detail = new JadwalDetail;
          $to_detail->id_jadwal = $id;
          $to_detail->minggu = 3;
          $to_detail->id_ruangan = $key;
          $to_detail->save();
        }
      }
      if($minggu4){
        foreach ($minggu4 as $key) {
          $to_detail = new JadwalDetail;
          $to_detail->id_jadwal = $id;
          $to_detail->minggu = 4;
          $to_detail->id_ruangan = $key;
          $to_detail->save();
        }
      }
      $msg = "data saved successfully";
            $success = true;
    }else {
      $msg = "data failed to save";
      $success = false;
    }

    return [
          'success'=>$success,
          'msg'=>$msg
        ];
     
  }

  public function cetak(Request $req){
    $bulan = array(1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
    $bulan_get = $req->bulan;
    $tahun_get = $req->tahun;

    $kepala = PengaturanJabatan::find(1);
        if($kepala->count()){
            $kepala = $kepala->first();
        }else {
            $kepala = NULL;
        }

    $bulannya = $bulan[$bulan_get];
    $data = Jadwal::where('bulan', $bulan_get)->where('tahun', $tahun_get)->get();
    $pdf = PDF::loadView('jadwal.cetak',compact('data', 'bulannya', 'kepala'));
    $pdf->setPaper(array(0,0,609.4488,935.433), 'landscape');
    return $pdf->stream('cetak_jadwal.pdf');
  }

} 
