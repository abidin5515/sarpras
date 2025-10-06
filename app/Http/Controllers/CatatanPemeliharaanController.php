<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CatatanPemeliharaan;
use App\CatatanPemeliharaanChecklist;
use App\CatatanPemeliharaanChecklistValue;
use DataTables;
use PDF;
use Image;

use Rap2hpoutre\FastExcel\FastExcel;
use App\Pekerjaan; 
use App\Checklist;
use App\DataAlkes;
use App\KategoriChecklist;
use App\MaintenanceInspection;
use App\Perbaikan;
use App\PerbaikanPetugas;
use App\PermintaanPelayanan;
use App\HasilPeninjauan;
use App\Kalibrasi;
use App\Teknisi;
use App\Permintaan;


class CatatanPemeliharaanController extends Controller
{
      protected $dir = "catatan_pemeliharaan";
    	protected $url = "catatan-pemeliharaan";



	public function index(){
		return view('catatan_pemeliharaan/index');
	}



    public function json(Request $request){
        $dari_tanggal = ($request->dari_tanggal!=''? $request->dari_tanggal : date('Y-m-d'));
        $sampai_tanggal = ($request->sampai_tanggal!=''? $request->sampai_tanggal : date('Y-m-d'));
    		// $tanggal = $request->tanggal;
    		
          $data = Pekerjaan::select([
            'pekerjaan.id',
            'pekerjaan.tanggal',
            'pekerjaan.perbaikan',
            'pekerjaan.jam_mulai',
            'pekerjaan.jam_selesai',
            'pekerjaan.lokasi',
            'pekerjaan.status',
            'pekerjaan.keterangan',
            'pekerjaan.biaya',
            'pekerjaan.foto',
            'pekerjaan.id_teknisi'
		])->orderBy('pekerjaan.tanggal','desc')->orderBy('pekerjaan.jam_mulai','desc');
          // if (!empty($tanggal)) {
          //   # code...
          //   $data->where(['pekerjaan.tanggal'=>$tanggal]);
          // }

          if (!empty($dari_tanggal)) {
            $data->whereDate('pekerjaan.tanggal', '>=', $dari_tanggal);
          }

          if (!empty($sampai_tanggal)) {
            $data->whereDate('pekerjaan.tanggal', '<=', $sampai_tanggal);
          }

          return Datatables::of($data)->addColumn('action',function($d){

              $print ='';
//               if ($jenis_pekerjaan=="3"||$jenis_pekerjaan=="4") {
//                 # code...
//                 $print ='
// <button class="btn create-btn btn-info btn-sm" data-iframe="true" data-save="false" data-src="'.url('catatan-pemeliharaan/'.$d->id.'/print').'" data-title="Cetak"><i class="fas fa-print"></i></button>';
//               }
//               elseif ($jenis_pekerjaan=="5"||$jenis_pekerjaan=="6") {
//                 # code...
//                 $print = '
// <button class="btn create-btn btn-info btn-sm" data-iframe="true" data-save="false" data-src="'.url('catatan-pemeliharaan/'.$d->id.'/print-surat-tugas').'" data-title="Cetak"><i class="fas fa-print"></i></button>';
//               }elseif ($jenis_pekerjaan=='2') {
//                 # code...
//                                 $print = '
// <button class="btn create-btn btn-info btn-sm"  data-save="false" data-src="'.url('catatan-pemeliharaan/'.$d->id.'/print-kalibrasi').'" data-title="Cetak"><i class="fas fa-print"></i></button>';

//               }



                return '<a data-title="Ubah" class="btn btn-warning btn-sm" href="'.url($this->url.'/'.$d->id.'/edit').'"><i class="fas fa-edit"></i></a>
<button class="btn btn-danger delete-btn btn-sm" href="'.url($this->url.'/'.$d->id).'"><i class="fas fa-trash"></i></button>
'.$print.'

';


            })
            ->editColumn('foto',function($d){
            	return '<img width="80" src="'.$d->foto.'">';
            })->editColumn('tanggal',function($d){
              return date('d-m-Y', strtotime($d->tanggal));
            })->editColumn('teknisi',function($d){
              if ($d->id_teknisi) {
                $b= preg_split("/[,]/",$d->id_teknisi);
                  $a = '';
                  foreach ($b as $v) {
                    $a .= ambil_teknisi($v).', ';
                  }
                return $a;
              }else {
                return '-';
              }
            })
            // ->editColumn('selesai',function($d){
            // 	return date('d-m-Y',strtotime($d->selesai));
            // })
//             ->addColumn('pelaksana',function($d){
//               $pelaksana="";

//               if (!empty($d->id_teknisi_setempat)) {
//                 # code...
//                 $pelaksana = $d->nama_teknisi;

//               }
//               elseif (!empty($d->bengkel_rujukan)) {
//                 # code...
//                 @$pelaksana = $d->bengkel_rujukan;
// // echo "string";
//               }

//               elseif (!empty($d->id_vendor)) {
//                 # code...
//                 $pelaksana = $d->vendor;
//               }

//               return $pelaksana;
//             })
            ->make(true);

    }



    public function create(Request $request){
    	$firstYear = (int)date('Y') - 5;
		  $lastYear = (int) date('Y') + 5; 
      $teknisi = Teknisi::all();
      @$id_permintaan = $_GET['id_permintaan'];
      if (!empty($id_permintaan) && $id_permintaan!='') {
        $permintaan = Permintaan::find($id_permintaan);
      }else {
        $permintaan = null; 
      }

    	return view('catatan_pemeliharaan/create',compact('firstYear','lastYear', 'teknisi', 'permintaan'));
    }


    public function edit($id){
    	$firstYear = (int)date('Y') - 5;
		  $lastYear = (int) date('Y') + 5;

		  $data = Pekerjaan::find($id);

      if($data->id_teknisi){
        $teknisi_data= preg_split("/[,]/",$data->id_teknisi);
      }else {
        $teknisi_data = null;
      }
      
      $teknisi = Teknisi::all();            

    	return view('catatan_pemeliharaan/edit',compact('firstYear','lastYear','data', 'teknisi_data', 'teknisi'));
    }

    public function store(Request $request){
    
    $id_permintaan = $request->id_permintaan;
    $tanggal				=	$request->tanggal;
		$perbaikan					=	$request->perbaikan;
		$jam_mulai  = $request->jam_mulai;
    $jam_selesai = $request->jam_selesai;
    $lokasi = $request->lokasi;
    $status = $request->status;
    $keterangan = $request->keterangan;
    $biaya = $request->biaya;

    

    $validatedData = $request->validate([
        'tanggal' => 'required',
        'perbaikan' => 'required',
        'jam_mulai' => 'required',
        'jam_selesai' => 'required',
        'lokasi' => 'required',
        'status' => 'required',
        'foto' => 'required',
        // 'id_teknisi[]' => 'required',
    ]);

    if($request->id_teknisi){
      $id_teknisi = implode(",",$request->id_teknisi);   
    }


     // update status permintaan jika id_permintaan ada
     if (!empty($id_permintaan) && $id_permintaan!='') {

        $data_permintaan = Permintaan::find($id_permintaan);
        $data_permintaan->status = $status;
        $data_permintaan->save();
      } 


// menyimpan data file yang diupload ke variabel $file
  $file = $request->file('foto');
  $namaFile = $file->getClientOriginalName();
  $tujuan_upload = 'gambar_pekerjaan/';
  $namaUpload = $tujuan_upload.$namaFile;
  // $file->move($tujuan_upload,$file->getClientOriginalName());


    // $image = $request->file('image');
        // $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
     
        // $destinationPath = public_path('/thumbnail');
        $img = Image::make($file->getRealPath());
        $img->resize(450, 450, function ($constraint) {
            $constraint->aspectRatio();
        })->save($tujuan_upload.$namaFile);
   
        // $destinationPath = public_path('/images');
        // $image->move($destinationPath, $input['imagename']);

    
    $catatanPemeliharaan = new Pekerjaan;
    $catatanPemeliharaan->id_permintaan = $id_permintaan;
    $catatanPemeliharaan->tanggal = $tanggal;
		$catatanPemeliharaan->perbaikan = $perbaikan;
		$catatanPemeliharaan->jam_mulai = $jam_mulai;
		$catatanPemeliharaan->jam_selesai = $jam_selesai;
		$catatanPemeliharaan->lokasi = $lokasi;
		$catatanPemeliharaan->status = $status;
    $catatanPemeliharaan->foto = $namaUpload;
    if($request->id_teknisi){
      $catatanPemeliharaan->id_teknisi = $id_teknisi;
	   }

     $catatanPemeliharaan->keterangan = $keterangan;
     $catatanPemeliharaan->biaya = $biaya;
  	$catatanPemeliharaan->save();
 



		return [
			'success'=>true,
			'msg'=>"Data Berhasil Disimpan"
		];
		

    }

   	public function getChecklist(Request $request){
          $tahun = $request->tahun;
          $alkes = $request->alkes;
          $jenis_pekerjaan = $request->jenis_pekerjaan;
          $checklist_qty = setting()->checklist_qty;
// echo "string";

        if ($jenis_pekerjaan=="3"||$jenis_pekerjaan=="4") {
          # code...
          $catatanPemeliharaan = CatatanPemeliharaan::where(['id_alkes'=>$alkes,'tahun'=>$tahun,'id_jenis_pekerjaan'=>$jenis_pekerjaan]);

          if ($catatanPemeliharaan->count()) {
            # code...

            $id = $request->id;

            $catatanValue = CatatanPemeliharaanChecklistValue::leftJoin('catatan_pemeliharaan_checklist','catatan_pemeliharaan_checklist_value.id_catatan_pemeliharaan_checklist','catatan_pemeliharaan_checklist.id')

            ->leftJoin('kategori_checklist','catatan_pemeliharaan_checklist.id_kategori','kategori_checklist.id')
            ->where('catatan_pemeliharaan_checklist.id_catatan_pemeliharaan',$id)->select(['catatan_pemeliharaan_checklist.checklist','catatan_pemeliharaan_checklist_value.id','catatan_pemeliharaan_checklist_value.type','catatan_pemeliharaan_checklist_value.status','catatan_pemeliharaan_checklist.id as idne','catatan_pemeliharaan_checklist.id_kategori','kategori_checklist.nama as nama_kategori','kategori_checklist.id as id_kategori']);
            // echo "string";
            // echo $catatanValue;
            $values = [];
            $valuesx = [];
            if ($catatanValue->count()) {
              # code...
              foreach ($catatanValue->get() as $index=> $ctt) {
                # code...
                $values[$ctt->nama_kategori][$ctt->checklist][] = [
                  'id'=>$ctt->id,
                  // 'idne'=>$ctt->idne,
                  'checklist'=>$ctt->checklist,
                  'status'=>$ctt->status,
                  'type'=>$ctt->type,
                  'idne'=>$ctt->idne,
                  'id_kategori'=>$ctt->id_kategori

                  // 'id_kategori'=>$ctt->nama_kategori
                ];
                  $valuesx[$ctt->nama_kategori][$ctt->checklist][] = [
                  'id'=>$ctt->id,
                  // 'idne'=>$ctt->idne,
                  'checklist'=>$ctt->checklist,
                  'status'=>$ctt->status,
                  'type'=>$ctt->type,
                  'idne'=>$ctt->idne,

                  'id_kategori'=>$ctt->id_kategori
                ];
              }
          

            }

            foreach ($valuesx as $key => $valuex) {
              foreach ($valuesx as $indexx=>$valuess) {
                foreach ($valuess as $idne =>$valuexx) {
              $columns=0;
                  foreach ($valuexx as $key => $valuess) {
                  $columns+=1;
                    
                  }
                }
              }
            }
            // echo $num;
            $MaintenanceInspection = MaintenanceInspection::where('id_catatan_pemeliharaan',$id);
            // echo $MaintenanceInspection->count(var);
            $view= view('catatan_pemeliharaan.get-checklist-edit',compact('KategoriChecklist','checklist_qty','values','columns','MaintenanceInspection'));

              return response(['view'=>$view->render(),'new'=>false]);



            // print_r($values);
          }
          else{

            $KategoriChecklist= KategoriChecklist::all();
            $data_alkes = DataAlkes::find($alkes);
            $id_alat =  $data_alkes->id_alat;

            $view = view('catatan_pemeliharaan.get-checklist',compact('KategoriChecklist','checklist_qty','columns','id_alat'));

                return response(['view'=>$view->render(),'new'=>true]);

            // return view('catatan_pemeliharaan.get-checklist',compact('KategoriChecklist','checklist_qty','columns'));

          }
        }
        elseif ($jenis_pekerjaan=='6' || $jenis_pekerjaan=='5') {
          # code...
          // echo "string";

          $perbaikan = null;
          $perbaikanPetugas = null;

          // print_r($request->all());
          // exit();
          if ($request->edit=="true") {
            # code...
            $id = $request->id;

            $perbaikan = Perbaikan::where('id_catatan_pemeliharaan',$id)->first();
            $perbaikanPetugas = PerbaikanPetugas::where('id_catatan_pemeliharaan',$id);



          }
          $id_permintaan_pelayanan = $request->permintaan_pelayanan;
          @$permintaan_pelayanan = PermintaanPelayanan::find($id_permintaan_pelayanan);
          // @$hasilPeninjauan = HasilPeninjauan::where('')

          // exit();

              $view= view('catatan_pemeliharaan.surat_tugas_pemeliharaan',compact('perbaikan','perbaikanPetugas','permintaan_pelayanan'));

              return response(['view'=>$view->render(),'new'=>false]);

        }
        else if($request->jenis_pekerjaan=='2'){

            $id = $request->id;

              @$kalibrasi = Kalibrasi::where('id_catatan_pemeliharaan',$id);
              @$view= view('catatan_pemeliharaan.upload_kalibrasi',compact('kalibrasi'));

              return response(['view'=>$view->render(),'new'=>false]);

        }

   		// $id = $request->id;
   		// $catatanPemeliharaanChecklist = CatatanPemeliharaanChecklist::where('id_catatan_pemeliharaan',$id)->orderBy('id','asc');

   		// if ($catatanPemeliharaanChecklist->count()) {
   		// 	# code...
   		// 	return [
   		// 		'success'=>true,
   		// 		'data'=>$catatanPemeliharaanChecklist->get()
   		// 	];
   		// }
   		// else{
   		// 	return [
   		// 		'success'=>false,
   		// 		'msg'=>'data tidak ditemukan'
   		// 	];
   		// }

   	}

   	public function update(Request $request,$id){

    $id_permintaan = $request->id_permintaan;
    $tanggal        = $request->tanggal;
    $perbaikan          = $request->perbaikan;
    $jam_mulai  = $request->jam_mulai;
    $jam_selesai = $request->jam_selesai;
    $lokasi = $request->lokasi;
    $status = $request->status;
    $keterangan = $request->keterangan;
    $biaya = $request->biaya;
    // $id_teknisi = $request->id_teknisi;

    $validatedData = $request->validate([
        'tanggal' => 'required',
        'perbaikan' => 'required',
        'jam_mulai' => 'required',
        'jam_selesai' => 'required',
        'lokasi' => 'required',
        'status' => 'required',
        'id_teknisi' => 'required',
    ]);

    if($request->id_teknisi){
      $id_teknisi = implode(",",$request->id_teknisi);   
    }


    // update status permintaan jika id_permintaan ada
     if (!empty($id_permintaan) && $id_permintaan!='') {
        $data_permintaan = Permintaan::find($id_permintaan);
        $data_permintaan->status = $status;
        $data_permintaan->save();
      } 


    
  $file = $request->file('foto');
  if($file){
    $namaFile = $file->getClientOriginalName();
    $tujuan_upload = 'gambar_pekerjaan/';
    $namaUpload = $tujuan_upload.$namaFile;
    $file->move($tujuan_upload,$file->getClientOriginalName());
  }
    $catatanPemeliharaan = Pekerjaan::find($id);
    $catatanPemeliharaan->tanggal = $tanggal;
    $catatanPemeliharaan->perbaikan = $perbaikan;
    $catatanPemeliharaan->jam_mulai = $jam_mulai;
    $catatanPemeliharaan->jam_selesai = $jam_selesai;
    $catatanPemeliharaan->lokasi = $lokasi;
    $catatanPemeliharaan->status = $status;
    if($file){
      $catatanPemeliharaan->foto = $namaUpload;
    }
    if ($request->id_teknisi) {
      $catatanPemeliharaan->id_teknisi = $id_teknisi;
    }

    $catatanPemeliharaan->keterangan = $keterangan;
    $catatanPemeliharaan->biaya = $biaya;
    
    $catatanPemeliharaan->save();


		return [
			'success'=>true,
			'msg'=>"Data Berhasil Disimpan"
		];
		



   	}

   	 public function destroy($id,Request $request)
    {
        $table = Pekerjaan::find($id);
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

    public function printFilter(Request $request){
      $dari_tanggal = $request->dari_tanggal;
      $sampai_tanggal = $request->sampai_tanggal;
      $pdf = $request->pdf;
      $data = Pekerjaan::whereDate('tanggal', '>=', $dari_tanggal)
              ->whereDate('tanggal', '<=', $sampai_tanggal)->orderBy('tanggal', 'ASC')->get();  
      

      // if ($data->id_teknisi) {
      //   $b= preg_split("/[,]/",$d->id_teknisi);
      //     $a = '';
      //     foreach ($b as $v) {
      //       $a .= ambil_teknisi($v).', ';
      //     }
      //   return $a;
      // }else {
      //   return '-';
      // }
    	
      if($pdf == 'true'){
        $pdf = PDF::loadView('catatan_pemeliharaan.print-filter', compact('data'));
        $pdf->setPaper('A4', 'portrait');
        $nama_file = 'Catatan Perbaikan '.date('d-m-Y', strtotime($dari_tanggal)).' sd '.date('d-m-Y', strtotime($sampai_tanggal)).'.pdf';
        return $pdf->stream($nama_file);
      }else {
        $nama_file = 'Catatan Perbaikan '.date('d-m-Y', strtotime($dari_tanggal)).' sd '.date('d-m-Y', strtotime($sampai_tanggal)).'.xlsx';
        return (new FastExcel($data))->download($nama_file, function ($d) {
              if ($d->id_teknisi) {
                $b= preg_split("/[,]/",$d->id_teknisi);
                  $a = '';
                  foreach ($b as $v) {
                    $a .= ambil_teknisi($v).', ';
                  }
                
              }else {
                $a = '-';                
              }

            return [
                'Tanggal' => date('d-m-Y', strtotime($d->tanggal)),
                'Perbaikan' => $d->perbaikan,
                'Jam Mulai' => date('H:i', strtotime($d->jam_mulai)),
                'Jam Selesai' => date('H:i', strtotime($d->jam_selesai)),
                'Status' => $d->status,
                'Keterangan' => @$d->keterangan,
                'Biaya' => @$d->biaya,
                'Teknisi'=> $a
            ];
        });
      }

      
    }

    public function print($id){

    	$catatanPemeliharaan = CatatanPemeliharaan::find($id);
    	$id_alat = $catatanPemeliharaan->data_alkes->id_alat;

    	$catatanPemeliharaanChecklist = CatatanPemeliharaanChecklist::where('id_catatan_pemeliharaan',$id);


  $catatanValue = CatatanPemeliharaanChecklistValue::leftJoin('catatan_pemeliharaan_checklist','catatan_pemeliharaan_checklist_value.id_catatan_pemeliharaan_checklist','catatan_pemeliharaan_checklist.id')

            ->leftJoin('kategori_checklist','catatan_pemeliharaan_checklist.id_kategori','kategori_checklist.id')
            ->where('catatan_pemeliharaan_checklist.id_catatan_pemeliharaan',$id)->select(['catatan_pemeliharaan_checklist.checklist','catatan_pemeliharaan_checklist_value.id','catatan_pemeliharaan_checklist_value.type','catatan_pemeliharaan_checklist_value.status','catatan_pemeliharaan_checklist.id as idne','catatan_pemeliharaan_checklist.id_kategori','kategori_checklist.nama as nama_kategori','kategori_checklist.id as id_kategori']);
            // echo "string";
            // echo $catatanValue;
            $values = [];
            $valuesx = [];
            if ($catatanValue->count()) {
              # code...
              foreach ($catatanValue->get() as $index=> $ctt) {
                # code...
                $values[$ctt->nama_kategori][$ctt->checklist][] = [
                  'id'=>$ctt->id,
                  // 'idne'=>$ctt->idne,
                  'checklist'=>$ctt->checklist,
                  'status'=>$ctt->status,
                  'type'=>$ctt->type,
                  'idne'=>$ctt->idne,
                  'id_kategori'=>$ctt->id_kategori

                  // 'id_kategori'=>$ctt->nama_kategori
                ];
                  $valuesx[$ctt->nama_kategori][$ctt->checklist][] = [
                  'id'=>$ctt->id,
                  // 'idne'=>$ctt->idne,
                  'checklist'=>$ctt->checklist,
                  'status'=>$ctt->status,
                  'type'=>$ctt->type,
                  'idne'=>$ctt->idne,

                  'id_kategori'=>$ctt->id_kategori
                ];
              }
          

            }

            foreach ($valuesx as $key => $valuex) {
              foreach ($valuesx as $indexx=>$valuess) {
                foreach ($valuess as $idne =>$valuexx) {
              $columns=0;
                  foreach ($valuexx as $key => $valuess) {
                  $columns+=1;
                    
                  }
                }
              }
            }

      // print_r($array);
      // exit();
      $MaintenanceInspection = MaintenanceInspection::where('id_catatan_pemeliharaan',$id);

      // $data['array'] =$array;
      $data['values'] =$values;
      $data['columns'] =$columns;
      $data['MaintenanceInspection']=$MaintenanceInspection;
      $data['catatanPemeliharaan'] =$catatanPemeliharaan;


    	$pdf = PDF::loadView('catatan_pemeliharaan.print',$data);

    	    // $pdf->setPaper('A3', 'landscape');
		$pdf->setPaper(array(0,0,609.4488,935.433), 'portrait');
		return $pdf->stream('download.pdf');

    }

    public function form(Request $request){
      $type = $request->type;
      $value = $request->val;
      $id = $request->id;
      if (!empty($id)) {
        # code...
        // echo "string";
       $catatanPemeliharaan = CatatanPemeliharaan::find($id);

      }
      // echo $value;

      return view('catatan_pemeliharaan.form',compact('type','value','catatanPemeliharaan'));
    }

    public function printSuratTugas($id){
      // echo $id;
      // exit();
       $catatanPemeliharaan = CatatanPemeliharaan::find($id);
        $perbaikan = Perbaikan::where('id_catatan_pemeliharaan',$id)->first();
        $perbaikanPetugas = PerbaikanPetugas::where('id_catatan_pemeliharaan',$id);
      $pdf = PDF::loadView('catatan_pemeliharaan.print_surat_tugas',compact('perbaikan','catatanPemeliharaan','perbaikanPetugas'));

          // $pdf->setPaper('A3', 'landscape');
    $pdf->setPaper(array(0,0,609.4488,935.433), 'landscape');
    return $pdf->stream('download.pdf');
    }

    public function printKalibrasi($id){
      // echo ;
      $kalibrasi = Kalibrasi::where('id_catatan_pemeliharaan',$id);

      return view('catatan_pemeliharaan.daftar_file_kalibrasi',compact('kalibrasi'));
    }


    // public function laporan(){
    //   return view('catatan_pemeliharaan.laporan');
    // }



   public function laporan(Request $request)
{
    $mode = $request->get('mode', 'harian');

    if ($mode == 'bulanan') {
        $bulan = $request->get('bulan', date('m'));
        $tahun = $request->get('tahun', date('Y'));

         $bulan = $request->get('bulan', date('m'));
        $tahun = $request->get('tahun', date('Y'));

        $laporan = Pekerjaan::whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->get();


    } else {
        $from = $request->from;
        $to   = $request->to;
        // echo $from;
        // return;
       $laporan = Pekerjaan::selectRaw('tanggal, COUNT(*) as jumlah')
    ->whereRaw('date(tanggal) >= ? and date(tanggal) <= ?', [$from, $to])
    ->groupBy('tanggal')
    ->orderBy('tanggal','asc')
    ->get();

    }

    // print_r($laporan);
    // return;
    return view('catatan_pemeliharaan.laporan', compact('laporan'));
}




}
