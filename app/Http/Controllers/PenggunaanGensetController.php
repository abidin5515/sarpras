<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Teknisi;
use App\PenggunaanGenset;
use \Yajra\Datatables\Datatables;
use Barryvdh\DomPDF\Facade as PDF;


class PenggunaanGensetController extends Controller
{
    protected $dir = "penggunaan_genset";
    protected $url = "penggunaan_genset";

    public function json(Request $request){ 
        // print_r($request->all());
        $dari_tanggal = ($request->dari_tanggal!=''? $request->dari_tanggal : date('Y-m-d'));
        $sampai_tanggal = ($request->sampai_tanggal!=''? $request->sampai_tanggal : date('Y-m-d'));

        
        $data = PenggunaanGenset::select([
          'penggunaan_genset.id',
          'penggunaan_genset.start',
          'penggunaan_genset.selesai',
          'penggunaan_genset.vol',
          'penggunaan_genset.frek',
          'penggunaan_genset.suhu',
          'penggunaan_genset.amp',
          'penggunaan_genset.petugas',
          'penggunaan_genset.bbm_terakhir',
          'penggunaan_genset.keterangan',
          ]);

          if (!empty($dari_tanggal)) {
            $data->whereDate('penggunaan_genset.start', '>=', $dari_tanggal);
          }

          if (!empty($sampai_tanggal)) {
            $data->whereDate('penggunaan_genset.start', '<=', $sampai_tanggal);
          }

          return Datatables::of($data)->addColumn('action',function($d){
              return '<a data-title="Ubah" class="btn btn-sm btn-warning edit-btn" href="'.url($this->url.'/'.$d->id.'/edit').'"><i class="fas fa-edit"></i></a>
<button class="btn btn-sm btn-danger delete-btn" href="'.url($this->url.'/'.$d->id).'"><i class="fas fa-trash"></i></button>';

          })
    ->editColumn('petugas',function($d){
        if ($d->petugas) {
          $b= preg_split("/[,]/",$d->petugas);
            $a = '';
            foreach ($b as $v) {
              $a .= ambil_teknisi($v).', ';
            }
          return $a;
        }else {
          return '-';
        }
      })
      ->editColumn('start',function($d){
        if($d->start){
            return date('d-m-Y H:i', strtotime(@$d->start));
        }
      })
      ->editColumn('selesai',function($d){
        if($d->selesai){
            return date('d-m-Y H:i', strtotime(@$d->selesai));
        }
      })
        ->addIndexColumn()
          ->make(true);

  }

    function index(){
        return view($this->dir.'.index');    
    }    
    public function create()
    {
        $title = "Create";
        $teknisi = Teknisi::all();
        return view($this->dir.'/create',compact('title', 'teknisi'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'start' => 'required',
            'selesai' => 'required',
            'bbm_terakhir' => 'required',
        ]);

        if($request->id_teknisi){
            $id_teknisi = implode(",",$request->id_teknisi);   
        }

        $data = new PenggunaanGenset;
        $data->start = $request->start;	
        $data->selesai = $request->selesai;	
        $data->vol = $request->vol;	
        $data->frek = $request->frek;	
        $data->suhu = $request->suhu;	
        $data->amp = $request->amp;	
        if($request->id_teknisi){
            $data->petugas = $id_teknisi;
        }
        $data->bbm_terakhir = $request->bbm_terakhir;	
        $data->keterangan = $request->keterangan;	
        $save = $data->save();

        if ($save) {
            $msg = "Data Berhasil Disimpan";
            $success = true;
        }
        else {
            $msg = "Data gagal disimpan";
            $success = false;
        }
    
        return [
          'success'=>$success,
          'msg'=>$msg
        ];

}

public function edit($id){
  
      $data = PenggunaanGenset::find($id);

        if($data->petugas){
            $teknisi_data= preg_split("/[,]/",$data->petugas);
        }else {
            $teknisi_data = null;
        }
  
     $teknisi = Teknisi::all();            

    return view($this->dir.'/edit',compact('data', 'teknisi_data', 'teknisi'));
}

public function update(Request $request, $id)
{
    $validatedData = $request->validate([
        'start' => 'required',
        'selesai' => 'required',
        'bbm_terakhir' => 'required',
    ]);

    if($request->id_teknisi){
        $id_teknisi = implode(",",$request->id_teknisi);   
    }

    $data = PenggunaanGenset::find($id);
    $data->start = $request->start;	
    $data->selesai = $request->selesai;	
    $data->vol = $request->vol;	
    $data->frek = $request->frek;	
    $data->suhu = $request->suhu;	
    $data->amp = $request->amp;	
    if($request->id_teknisi){
        $data->petugas = $id_teknisi;
    }
    $data->bbm_terakhir = $request->bbm_terakhir;	
    $data->keterangan = $request->keterangan;	
    $save = $data->save();

    if ($save) {
        $msg = "Data Berhasil Disimpan";
        $success = true;
    }
    else {
        $msg = "Data gagal disimpan";
        $success = false;
    }

    return [
      'success'=>$success,
      'msg'=>$msg
    ];

}

public function printFilter(Request $request){
    $dari_tanggal = $request->dari_tanggal;
    $sampai_tanggal = $request->sampai_tanggal;
    $pdf = $request->pdf;
    $data = PenggunaanGenset::whereDate('start', '>=', $dari_tanggal)
            ->whereDate('start', '<=', $sampai_tanggal)->get();  
      
    if($pdf == 'true'){
      $pdf = PDF::loadView($this->dir.'.pdf', compact('data'));
      $pdf->setPaper('A4', 'portrait');
      $nama_file = 'Form Penggunaan Generator Set '.date('d-m-Y', strtotime($dari_tanggal)).' sd '.date('d-m-Y', strtotime($sampai_tanggal)).'.pdf';
      return $pdf->stream($nama_file);
    }

    
  }

}
