<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use PDF;
use Rap2hpoutre\FastExcel\FastExcel;
use App\Permintaan;
use Validator;
use Redirect;
use Image;
use App\Ruangan;

class PermintaanController extends Controller
{
  protected $dir = "permintaan"; 
	protected $url = "permintaan";
  
  public function index(){
		return view('permintaan/index');
	}

     public function json(Request $request){

        $dari_tanggal = ($request->dari_tanggal!=''? $request->dari_tanggal : date('Y-m-d'));
        $sampai_tanggal = ($request->sampai_tanggal!=''? $request->sampai_tanggal : date('Y-m-d'));
        
          $data = Permintaan::select([
            'permintaan.id',
            'permintaan.id_ruang',
            'permintaan.pengirim',
            'permintaan.tanggal',
            'permintaan.masalah',
            'permintaan.lantai',
            'permintaan.foto',
            'permintaan.status'
            
    ])->where('status','pending')->orderBy('permintaan.id','desc');
          // $data->where('permintaan.status', '!=', 'selesai');

          if (!empty($dari_tanggal)) {
            // $data->where(['permintaan.tanggal'=>$tanggal]);
            $data->whereDate('created_at', '>=', $dari_tanggal);
          }

          if (!empty($sampai_tanggal)) {
            // $data->where(['permintaan.tanggal'=>$tanggal]);
            $data->whereDate('created_at', '<=', $sampai_tanggal);
          }


          return Datatables::of($data)->addColumn('action',function($d){
              return '<button class="btn btn-danger delete-btn btn-sm" href="'.url($this->url.'/'.$d->id).'"><i class="fas fa-trash"></i></button>

                <a href="'.url('catatan-pemeliharaan/create?id_permintaan='). $d->id.'" class="btn btn-primary">Kerjakan</a>

              ';
            })->addColumn('tanggal',function($d){
                return date('d-m-Y', strtotime($d->tanggal));
              })->addColumn('ruang',function($d){
                return @$d->ruangan->nama;
              })

            ->addColumn('foto',function($d){
                if ($d->foto) {
                  return '<img src="'.url($d->foto).'" width="150" class="create-btn foto-zoom" data-lg="false" data-save="false" data-src="'.url('permintaan/view_gambar?url='.$d->foto).'">';
                }else {
                  return '';
                }
                
              })
            ->make(true);
    }


    public function create(){
      $ruangan = Ruangan::all();
      return view ('permintaan/create', compact('ruangan'));
    }



    public function store(Request $request){
    
    // $pengirim   = $request->pengirim;
    // $tanggal =  $request->tanggal;
    $masalah        = $request->masalah;
    $lokasi          = $request->lokasi;
    $lantai  = $request->lantai;
    
    // $validatedData = Validator::make($request->all(), ([
    //     'masalah' => 'required',
    //     // 'lokasi' => 'required',
    //     'lantai' => 'required',
    //     'pengirim' => 'required',
    //     'tanggal' => 'required',
    // ]);


    $validatedData = Validator::make($request->all(), [ // <---
        'masalah' => 'required',
        // 'lokasi' => 'required',
        'lantai' => 'required',
        // 'pengirim' => 'required',
        // 'tanggal' => 'required',
      ]);

    if($validatedData->fails()){
      return Redirect::back()->withErrors($validatedData)->withInput();
    }

  $file = $request->file('foto');
  if($file){
    $namaFile = $file->getClientOriginalName();
    $tujuan_upload = 'gambar_permintaan/';
    $namaUpload = $tujuan_upload.$namaFile;
    // $file->move($tujuan_upload,$file->getClientOriginalName());

    // compress gambar
    $img = Image::make($file->getRealPath());
    $img->resize(450, 450, function ($constraint) {
        $constraint->aspectRatio();
    })->save($tujuan_upload.$namaFile);


  }


    
    $permintaan = new Permintaan;
    // $permintaan->tanggal = $tanggal;
    // $permintaan->pengirim = $pengirim;
    $permintaan->masalah = $masalah;
    $permintaan->lokasi = $lokasi;
    $permintaan->lantai = $lantai;
    $permintaan->id_ruang = $request->id_ruang;
    if ($file) {
      $permintaan->foto = $namaUpload;
    }
    $permintaan->status = 'pending';
    $save = $permintaan->save();
 

    if($save){
       return redirect()->back()->with('message', 'Data Berhasil Dikirim!');
    }else {
      return redirect()->back()->with('error', 'Data Gagal Dikirim!');
    }

    
    

    } 

         public function destroy($id,Request $request)
    {
        $table = Permintaan::find($id);
        $delete = $table->delete();
         if ($delete) {
        $success= true;
          $msg = 'Data Berhasil Dihapus';

        }
        else {

          $msg = 'Data Gagal Dihapus';
            $success = false;
        }

        return [
          'success'=>$success,
          'msg'=>$msg
        ];
    }


    public function view_gambar(Request $req){
      $url = $req->url;
      return view('permintaan.view_gambar', compact('url'));
    }




    public function permintaan_selesai()
    {
      return view('permintaan.permintaan_selesai');

    }


    public function selesai_json(Request $request){

        $dari_tanggal = ($request->dari_tanggal!=''? $request->dari_tanggal : date('Y-m-d'));
        $sampai_tanggal = ($request->sampai_tanggal!=''? $request->sampai_tanggal : date('Y-m-d'));
          $data = Permintaan::select([
            'permintaan.id',
            'permintaan.id_ruang',
            'permintaan.pengirim',
            'permintaan.tanggal',
            'permintaan.masalah',
            'permintaan.lantai',
            'permintaan.foto',
            'permintaan.status'
            
    ])->where('status','selesai')->orderBy('permintaan.id','desc');
          // $data->where('permintaan.status', '!=', 'selesai');

          if (!empty($dari_tanggal)) {
            // $data->where(['permintaan.tanggal'=>$tanggal]);
            $data->whereDate('created_at', '>=', $dari_tanggal);
          }

          if (!empty($sampai_tanggal)) {
            // $data->where(['permintaan.tanggal'=>$tanggal]);
            $data->whereDate('created_at', '<=', $sampai_tanggal);
          }


          return Datatables::of($data)->addColumn('action',function($d){
              // return '<button class="btn btn-danger delete-btn btn-sm" href="'.url($this->url.'/'.$d->id).'"><i class="fas fa-trash"></i></button>  

              // ';
            })->addColumn('tanggal',function($d){
                return date('d-m-Y', strtotime($d->tanggal));
              })->addColumn('ruang',function($d){
                return @$d->ruangan->nama;
              })

            ->addColumn('foto',function($d){
                if ($d->foto) {
                  return '<img src="'.url($d->foto).'" width="150" class="create-btn foto-zoom" data-lg="false" data-save="false" data-src="'.url('permintaan/view_gambar?url='.$d->foto).'">';
                }else {
                  return '';
                }
                
              })
            ->make(true);
    }



    public function excel_selesai(Request $request)
    {
      $dari_tanggal = $request->dari_tanggal;
      $sampai_tanggal = $request->sampai_tanggal;
      $data = Permintaan::where('status', 'selesai')
              ->whereDate('created_at', '>=', $dari_tanggal)
              ->whereDate('created_at', '<=', $sampai_tanggal)
              ->get();
              $nama_file = 'Permintaan Selesai '.date('d-m-Y', strtotime($dari_tanggal)).' sd '.date('d-m-Y', strtotime($sampai_tanggal)).'.xlsx';
              return (new FastExcel($data))->download($nama_file, function ($d) {

            return [
              'Ruang'=> @$d->ruangan->nama,
              'Masalah' => $d->masalah,
              'Lantai' => $d->lantai,
              'Tanggal' => date('d-m-Y H:i', strtotime($d->created_at)),
              'Status' => $d->status,

            ];
        });
    }

}
