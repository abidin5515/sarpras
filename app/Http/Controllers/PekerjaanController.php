<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CatatanPemeliharaan;
use App\CatatanPemeliharaanChecklist;
use App\CatatanPemeliharaanChecklistValue;
use DataTables;
use PDF;

use App\Checklist;
use App\DataAlkes;
use App\KategoriChecklist;
use App\MaintenanceInspection;
use App\Perbaikan;
use App\PerbaikanPetugas;
use App\PermintaanPelayanan;
use App\HasilPeninjauan;
use App\Kalibrasi;
class PekerjaanController extends Controller
{     
      protected $dir = "pekerjaan";
    	protected $url = "pekerjaan";



	public function index(){
		return view('pekerjaan/index');
	}



    public function json(Request $request){

    		$id_alkes = $request->id_alkes;
    		$mulai = $request->mulai;
    		$selesai = $request->selesai;

          $data = CatatanPemeliharaan::select([
          	'catatan_pemeliharaan.no_invent',
          	'catatan_pemeliharaan.id',
			'alat.nama',
			'catatan_pemeliharaan.masa_kalibrasi',
			'jenis_pekerjaan.nama as jenis_pekerjaan',
      'supplier.nama as vendor',
			'teknisi.nama as nama_teknisi',
      'catatan_pemeliharaan.mulai',
			'catatan_pemeliharaan.id_jenis_pekerjaan',
			'catatan_pemeliharaan.selesai',
      'catatan_pemeliharaan.id_teknisi_setempat',
      'catatan_pemeliharaan.id_vendor',
			'catatan_pemeliharaan.bengkel_rujukan',
			'catatan_pemeliharaan.jumlah_biaya',
		])->leftJoin('data_alkes','catatan_pemeliharaan.id_alkes','data_alkes.id')
          ->leftJoin('alat','data_alkes.id_alat','alat.id')
          ->leftJoin('jenis_pekerjaan','catatan_pemeliharaan.id_jenis_pekerjaan','jenis_pekerjaan.id')
          ->leftJoin('supplier','catatan_pemeliharaan.id_vendor','supplier.id')
          ->leftJoin('teknisi','catatan_pemeliharaan.id_teknisi_setempat','teknisi.id')
          ->orderBy('catatan_pemeliharaan.mulai','asc');

          if (!empty($id_alkes)) {
          	# code...
          	$data->where(['catatan_pemeliharaan.id_alkes'=>$id_alkes]);
          }
          if (!empty($mulai)) {
          	# code...
          	$data->whereDate('catatan_pemeliharaan.mulai','>=',$mulai);

          }

          if (!empty($selesai)) {
          	# code...
          	$data->whereDate('catatan_pemeliharaan.mulai','<=',$selesai);

          }


            return Datatables::of($data)->addColumn('action',function($d){

              $jenis_pekerjaan = $d->id_jenis_pekerjaan;

              $print ='';
              if ($jenis_pekerjaan=="3"||$jenis_pekerjaan=="4") {
                # code...
                $print ='
<button class="btn create-btn btn-info btn-sm" data-iframe="true" data-save="false" data-src="'.url('catatan-pemeliharaan/'.$d->id.'/print').'" data-title="Cetak"><i class="fas fa-print"></i></button>';
              }
              elseif ($jenis_pekerjaan=="5"||$jenis_pekerjaan=="6") {
                # code...
                $print = '
<button class="btn create-btn btn-info btn-sm" data-iframe="true" data-save="false" data-src="'.url('catatan-pemeliharaan/'.$d->id.'/print-surat-tugas').'" data-title="Cetak"><i class="fas fa-print"></i></button>';
              }elseif ($jenis_pekerjaan=='2') {
                # code...
                                $print = '
<button class="btn create-btn btn-info btn-sm"  data-save="false" data-src="'.url('catatan-pemeliharaan/'.$d->id.'/print-kalibrasi').'" data-title="Cetak"><i class="fas fa-print"></i></button>';

              }



                return '<a data-title="Ubah" class="btn btn-success btn-sm" href="'.url($this->url.'/'.$d->id.'/edit').'"><i class="fas fa-edit"></i></a>
<button class="btn btn-danger delete-btn btn-sm" href="'.url($this->url.'/'.$d->id).'"><i class="fas fa-trash"></i></button>
'.$print.'

';


            })
            ->editColumn('mulai',function($d){
            	return date('d-m-Y',strtotime($d->mulai));
            })
            ->editColumn('selesai',function($d){
            	return date('d-m-Y',strtotime($d->selesai));
            })
            ->addColumn('pelaksana',function($d){
              $pelaksana="";

              if (!empty($d->id_teknisi_setempat)) {
                # code...
                $pelaksana = $d->nama_teknisi;

              }
              elseif (!empty($d->bengkel_rujukan)) {
                # code...
                @$pelaksana = $d->bengkel_rujukan;
// echo "string";
              }

              elseif (!empty($d->id_vendor)) {
                # code...
                $pelaksana = $d->vendor;
              }

              return $pelaksana;
            })
            ->make(true);

    }



    public function create(Request $request){
    	$firstYear = (int)date('Y') - 5;
		  $lastYear = (int) date('Y') + 5;  

      if (!empty($request->permintaan_pelayanan)) {
        # code...
        $id_permintaan_pelayanan = $request->permintaan_pelayanan;
        $permintaan_pelayanan = PermintaanPelayanan::find($id_permintaan_pelayanan);
        $hasilPeninjauan = HasilPeninjauan::where('id_permintaan_pelayanan',$id_permintaan_pelayanan)->first();


      }



    	return view('catatan_pemeliharaan/create',compact('firstYear','lastYear','permintaan_pelayanan','hasilPeninjauan'));
    }


    public function edit($id){
    	$firstYear = (int)date('Y') - 5;
		$lastYear = (int) date('Y') + 5;

		$data = CatatanPemeliharaan::find($id);

    	return view('catatan_pemeliharaan/edit',compact('firstYear','lastYear','data'));
    }

    public function store(Request $request){
    
    $tanggal				=	$request->tanggal;
		$perbaikan					=	$request->perbaikan;
		$jam_mulai  = $request->jam_mulai;
    $jam_selesai = $request->jam_selesai;
    $lokasi = $request->lokasi;
    $status = $request->status;

    $validatedData = $request->validate([
        'tanggal' => 'required',
        'perbaikan' => 'required',
        'jam_mulai' => 'required',
        'jam_selesai' => 'required',
        'lokasi' => 'required',
        'status' => 'required',

    ]);
    
    $catatanPemeliharaan = new CatatanPemeliharaan;
    $catatanPemeliharaan->tanggal = $tanggal;
		$catatanPemeliharaan->perbaikan = $perbaikan;
		$catatanPemeliharaan->jam_mulai = $jam_mulai;
		$catatanPemeliharaan->jam_selesai = $jam_selesai;
		$catatanPemeliharaan->lokasi = $lokasi;
		$catatanPemeliharaan->status = $status;
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




   	$nama_alat				=	$request->nama_alat;
		$merek					=	$request->merek;
		$model					=	$request->model;
		$no_seri				=	$request->no_seri;
		$id_alat				=	$request->id_alat;
		$no_invent				=	$request->no_invent;
		$ruang					=	$request->ruang;
		$masa_kalibrasi			=	$request->masa_kalibrasi;
		$interval_pemeliharaan	=	$request->interval_pemeliharaan;
		$tanggal				=	$request->tanggal;
		$jenis_pekerjaan		=	$request->jenis_pekerjaan;
		$teknisi				=	$request->teknisi;
		$vendor					=	$request->vendor;
		$mulai					=	$request->mulai;
		$selesai				=	$request->selesai;
		$keluhan				=	$request->keluhan;
		$tindakan				=	$request->tindakan;
		$jumlah_biaya			=	$request->jumlah_biaya;
		$keterangan				=	$request->keterangan;
    $checklist 				= 	$request->checklist;
    $bengkel_rujukan 				= 	$request->bengkel_rujukan;
    $tahun        =   $request->tahun;
    $nama_user 				= 	$request->nama_user;
    $pelaksana = $request->pelaksana;

    $validatedData = $request->validate([
        'nama_alat' => 'required',
        'jenis_pekerjaan' => 'required',
        // 'teknisi' => 'required',
        // 'vendor' => 'required',
        'mulai' => 'required',
        'selesai' => 'required',
        // 'ruang' => 'required',
        'interval_pemeliharaan' => 'required',
        'tahun' => 'required',
        'tanggal' => 'required',
        'keluhan' => 'required',
        'tindakan' => 'required',
        'jumlah_biaya' => 'required',
        // 'keterangan' => 'required',
        // 'nama_user' => 'required',

    ]);


     if ($pelaksana=="1") {
      # code...
     $request->validate([
      'teknisi'=>'required'
     ]);

    }
    elseif ($pelaksana=="2") {
      # code...
         $request->validate([
      'bengkel_rujukan'=>'required'
     ]);

    }
    elseif ($pelaksana=="3") {

    $request->validate([
      'vendor'=>'required'
     ]);

      # code...
    }



  if ($request->jenis_pekerjaan=="6"||$request->jenis_pekerjaan=="5") {
    # code...

    // $perbaikanData = $request->all();


    $validatedData = $request->validate([
        'nomor' => 'required',
        'nama_pemesan' => 'required',
        'suku_cadang' => 'required',
        'hasil_perbaikan' => 'required',
        'saran_dari_petugas' => 'required',
        'ka_smf' => 'required',
        'nama_petugas_gudang' => 'required',
        'batas_waktu_perbaikan' => 'required',
        // 'jenis_pekerjaan' => 'required',
        // 'nama_user' => 'required',

    ]);


}



// 


    $catatanPemeliharaan =  CatatanPemeliharaan::find($id);
  $catatanPemeliharaan->id_alkes = $nama_alat;
    $catatanPemeliharaan->merek = $merek;
    $catatanPemeliharaan->model = $model;
    $catatanPemeliharaan->no_seri = $no_seri;
    // $catatanPemeliharaan->id_alat = $id_alat;
    $catatanPemeliharaan->no_invent = $no_invent;
    $catatanPemeliharaan->id_jenis_pekerjaan = $jenis_pekerjaan;
    // $catatanPemeliharaan->id_vendor = $vendor;

    $catatanPemeliharaan->mulai = $mulai;
    $catatanPemeliharaan->selesai = $selesai;

    $catatanPemeliharaan->id_ruang = $ruang;
    $catatanPemeliharaan->masa_kalibrasi = $masa_kalibrasi;
    $catatanPemeliharaan->interval_pemeliharaan = $interval_pemeliharaan;
    $catatanPemeliharaan->tahun = $tahun;
    $catatanPemeliharaan->tanggal = $tanggal;
    $catatanPemeliharaan->id_teknisi_setempat = 0;

    $catatanPemeliharaan->bengkel_rujukan = NULL;
    $catatanPemeliharaan->id_vendor = 0;

    if ($pelaksana=="1") {
      # code...
    $catatanPemeliharaan->id_teknisi_setempat = $teknisi;

    }
    elseif ($pelaksana=="2") {
      # code...
    $catatanPemeliharaan->bengkel_rujukan = $bengkel_rujukan;

    }
    elseif ($pelaksana=="3") {
    $catatanPemeliharaan->id_vendor = $vendor;

      # code...
    }
    $catatanPemeliharaan->bengkel_rujukan = $bengkel_rujukan;
    $catatanPemeliharaan->keluhan = $keluhan;
    $catatanPemeliharaan->tindakan = $tindakan;
    $catatanPemeliharaan->jumlah_biaya = $jumlah_biaya;
    $catatanPemeliharaan->keterangan = $keterangan;
    // $catatanPemeliharaan->nama_user = $nama_user;
    $catatanPemeliharaan->save();


    if ($request->new=="true") {
      # code...
      // echo "string";
      // ex

        $nama_checklist = $request->nama_checklist;

  $checklist_qty = setting()->checklist_qty;

  if (!empty($nama_checklist)) {
    # code...
    // echo $id;
    $catatanPemeliharaanChecklistData = CatatanPemeliharaanChecklist::where('id_catatan_pemeliharaan',$id);
    if ($catatanPemeliharaanChecklistData->count()) {
      # code...
    $dataCatatanPemeliharaanChecklist = $catatanPemeliharaanChecklistData->first();
    $id_catatan_pemeliharaan_checklist = $dataCatatanPemeliharaanChecklist->id;

    $catatanPemeliharaanChecklistValue = CatatanPemeliharaanChecklistValue::where('id_catatan_pemeliharaan_checklist',$id_catatan_pemeliharaan_checklist);
 
    $delete = CatatanPemeliharaanChecklist::where('id_catatan_pemeliharaan',$id)->delete();


    $delete = $catatanPemeliharaanChecklistData->delete();
 


    }
      foreach ($nama_checklist as $key => $nc) {
        # code...
        $namas = $nc['nama'];
        $value = @$nc['value'];
        $kategori = $key;
            

          foreach ($namas as $key2 => $nms) {
          # code...
            // print_r($nms)
            $catatanPemeliharaanChecklist = new CatatanPemeliharaanChecklist;
            $catatanPemeliharaanChecklist->id_catatan_pemeliharaan = $catatanPemeliharaan->id;
            $catatanPemeliharaanChecklist->id_kategori = $key;
            $catatanPemeliharaanChecklist->checklist = $nms;
            $catatanPemeliharaanChecklist->save();


            $values = @$value[$key2];
            for ($i=0; $i < $checklist_qty; $i++) { 

            // print_r(@$values[$i]);
              $valuess = @$values[$i];

                $catatanPemeliharaanChecklistValue = new CatatanPemeliharaanChecklistValue;
                $catatanPemeliharaanChecklistValue->id_catatan_pemeliharaan_checklist = $catatanPemeliharaanChecklist->id;
                if (!empty($valuess)) {
                  # code...
                  $catatanPemeliharaanChecklistValue->type = $i+1;
                $catatanPemeliharaanChecklistValue->status = $valuess;
                }
                else{
                $catatanPemeliharaanChecklistValue->type = $i+1;
                $catatanPemeliharaanChecklistValue->status = 0;                  
                }

                $catatanPemeliharaanChecklistValue->save();


            }
            // echo $nms."<br>";
            // print_r($key2);
        }
     


      }

  }



    }
    else{

  $nama_checklist = $request->nama_checklist;

    if (!empty($nama_checklist)) {
      # code...
      
      foreach ($nama_checklist as $key2 => $ncdata) {
        # code...

          foreach ($ncdata as $key3 => $itemdata) {
            # code...
            // print_r($key3);
            $idne = $key3;
            // $status = $itemdata;
            $first_value = reset($itemdata);
            $first_key = key($itemdata);
            // print_r($first_key);
            $type = $first_key;
            $statusData = array_values($itemdata)[0];
            $explode = explode('-', $statusData);
            $status = $explode[0];
            $id_catatan = $explode[1];
            // print_r($explode);
            // print_r($status);
            $catatanPemeliharaanChecklistValue = CatatanPemeliharaanChecklistValue::where('id',$idne);

            if ($catatanPemeliharaanChecklistValue->count()) {
              # code...
              $catatanPemeliharaanChecklistValue->update(['type'=>$type,'status'=>$status]);
            }
            else{

              $catatanPemeliharaanChecklistValue = new CatatanPemeliharaanChecklistValue;
              $catatanPemeliharaanChecklistValue->id_catatan_pemeliharaan_checklist = $id_catatan;
              $catatanPemeliharaanChecklistValue->type = $type;
              $catatanPemeliharaanChecklistValue->status = $status;
              $catatanPemeliharaanChecklistValue->save();

            }
            



            
            // print_r($itemdata);
          }
      }
    }

    }



      // exit();

  $date = $request->date;
  $user = $request->user;
  $teknisiData = $request->teknisiData;
  // print_r($user);
  // exit();
  if (!empty($date)) {
    # code...
    // print_r($teknisiData);
    // exit();

  foreach ($date as $key => $d) {
    # code...
    $date = $d[0];
    // echo $key;
    // echo $user = $user[$key][0];
    $userdata = $user[$key][0];
    $teknisiId =  @$teknisiData[$key]['id'][0];
    $teknisiTTD = @$teknisiData[$key]['ttd'][0];
    // echo $key;
    // print_r();
    // echo $date;
    if (!empty($teknisiId)) {
      # code...

    $MaintenanceInspection =  MaintenanceInspection::find($key);
    $MaintenanceInspection->id_teknisi = $teknisiId;
    $MaintenanceInspection->ttd_teknisi = $teknisiTTD;
    $MaintenanceInspection->tanggal = $date;
    $MaintenanceInspection->user = $userdata;
    $MaintenanceInspection->id_catatan_pemeliharaan =  $id;
    $MaintenanceInspection->save();
    }
    // else{

    // $MaintenanceInspection =  new MaintenanceInspection;
    // $MaintenanceInspection->id_teknisi = (is_null($teknisiId)? 0:$teknisiId);
    // $MaintenanceInspection->ttd_teknisi = $teknisiTTD;
    // $MaintenanceInspection->tanggal = $date;
    // $MaintenanceInspection->user = $userdata;
    // $MaintenanceInspection->id_catatan_pemeliharaan =  $id;
    // $MaintenanceInspection->save();
    // }
    // print_r($d);
  }

// exit();
  }

  if ($request->jenis_pekerjaan=="6"||$request->jenis_pekerjaan=="5") {
    # code...


    // $validatedData = $request->validate([
    //     'nomor' => 'required',
    //     'nama_pemesan' => 'required',
    //     'suku_cadang' => 'required',
    //     'hasil_perbaikan' => 'required',
    //     'saran_dari_petugas' => 'required',
    //     'ka_smf' => 'required',
    //     'nama_petugas_gudang' => 'required',
    //     // 'jenis_pekerjaan' => 'required',
    //     // 'nama_user' => 'required',

    // ]);


    $perbaikanData = $request->all();
    $perbaikan =  Perbaikan::where('id_catatan_pemeliharaan',$id);
    $idPerbaikan = $perbaikan->first()->id;


    $perbaikan =  Perbaikan::find($idPerbaikan);
    // $perbaikan->id_catatan_pemeliharaan = $catatanPemeliharaan->id;
    $perbaikan->nomor                   =  $perbaikanData['nomor'] ;
    $perbaikan->nama_pemesan            =  $perbaikanData['nama_pemesan'] ;
    $perbaikan->tanggal            =  $perbaikanData['tanggal'] ;
    
    // $perbaikan->laporan_kerusakan_awal  =  $perbaikanData['laporan_kerusakan_awal'] ;
    $perbaikan->batas_waktu_perbaikan   =  $perbaikanData['batas_waktu_perbaikan'] ;
    // $perbaikan->tindakan_perbaikan      =  $perbaikanData['tindakan_perbaikan'] ;
    $perbaikan->suku_cadang             =  $perbaikanData['suku_cadang'] ;
    // $perbaikan->nilai                   =  $perbaikanData['nilai'] ;
    $perbaikan->hasil_perbaikan         =  $perbaikanData['hasil_perbaikan'] ;
    $perbaikan->catatan                 =  $perbaikanData['catatan'] ;
    $perbaikan->pemberi_tugas           =  $perbaikanData['pemberi_tugas'] ;
    $perbaikan->pesan_pemberi_tugas     =  $perbaikanData['pesan_pemberi_tugas'] ;
    $perbaikan->diteruskan_kepada       =  $perbaikanData['diteruskan_kepada'] ;
    $perbaikan->nama_smf_bag            =  $perbaikanData['ka_smf'] ;
    $perbaikan->nama_petugas_gudang     =  $perbaikanData['nama_petugas_gudang'] ;
    $perbaikan->saran_dari_petugas      =  $perbaikanData['saran_dari_petugas'] ;
    // $perbaikan->id_teknisi_penanggung_jawab  =$perbaikanData['id_teknisi_penanggung_jawab']; 
    $perbaikan->mulai_dikerjakan        =  $request->mulai; 
    $perbaikan->selesai_dikerjakan      =  $request->selesai; 

    $perbaikan->save();




    if (!empty($request->petugas)) {
      # code...

      $perbaikanPetugasDelete = PerbaikanPetugas::where(['id_catatan_pemeliharaan'=>$id])->delete();

      foreach ($request->petugas as $idPetugas) {
        # code...
        $perbaikanPetugas = new PerbaikanPetugas;
        $perbaikanPetugas->id_petugas = $idPetugas;
        $perbaikanPetugas->id_catatan_pemeliharaan = $catatanPemeliharaan->id;
        $perbaikanPetugas->save();

      }
    }
  }

 


   if ($request->jenis_pekerjaan=='2') {
    # code...
    $file_kalibrasi = $request->file('file_kalibrasi');


    if (!empty($file_kalibrasi)) {

      $kalibrasi = Kalibrasi::where('id_catatan_pemeliharaan',$catatanPemeliharaan->id)->delete();

      foreach ($file_kalibrasi as $key => $value) {
        # code...
        
    $fileName = $value->getClientOriginalName();
    $fileExtension = $value->getClientOriginalExtension();
    $finalName = time().' - '.$fileName;

    $finalUploadPath = 'kalibrasi/'.$finalName;

    $move = $value->move(public_path('kalibrasi/'),$finalName);

    $kalibrasi = new Kalibrasi;
    $kalibrasi->id_catatan_pemeliharaan = $catatanPemeliharaan->id;
    $kalibrasi->file = $finalUploadPath;
    $kalibrasi->save();


      }
      # code...
    }
    


  }








		return [
			'success'=>true,
			'msg'=>"Data Berhasil Disimpan"
		];
		



   	}

   	 public function destroy($id,Request $request)
    {
        //	

        $catatanPemeliharaanChecklist = CatatanPemeliharaanChecklist::where('id_catatan_pemeliharaan',$id);

        if ($catatanPemeliharaanChecklist->count()) {
        	# code...
        	$catatanPemeliharaanChecklist->delete();
        }
        $table = CatatanPemeliharaan::find($id);
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
    	// echo "string";
    	$id_alkes = $request->id_alkes;
    	$mulai = $request->mulai;
    	$sampai = $request->sampai;
      $data_alkes = DataAlkes::find($id_alkes);


    	
          $records = CatatanPemeliharaan::select([
          	'catatan_pemeliharaan.no_invent',
          	'catatan_pemeliharaan.id',
			'alat.nama',
			'catatan_pemeliharaan.masa_kalibrasi',
			'jenis_pekerjaan.nama as jenis_pekerjaan',
			'supplier.nama as vendor',
			'catatan_pemeliharaan.mulai',
			'catatan_pemeliharaan.selesai',
			'catatan_pemeliharaan.id_teknisi_setempat',
			'catatan_pemeliharaan.bengkel_rujukan',
			'catatan_pemeliharaan.jumlah_biaya',
			'catatan_pemeliharaan.keluhan',
			'catatan_pemeliharaan.tindakan',
			// 'catatan_pemeliharaan.jumlah_biaya',
      'teknisi.nama as nama_teknisi',
			'catatan_pemeliharaan.keterangan',
		])->leftJoin('data_alkes','catatan_pemeliharaan.id_alkes','data_alkes.id')
          ->leftJoin('alat','data_alkes.id_alat','alat.id')
          ->leftJoin('jenis_pekerjaan','catatan_pemeliharaan.id_jenis_pekerjaan','jenis_pekerjaan.id')
          ->leftJoin('supplier','catatan_pemeliharaan.id_vendor','supplier.id')
          ->leftJoin('teknisi','catatan_pemeliharaan.id_teknisi_setempat','teknisi.id')
          ->orderBy('catatan_pemeliharaan.mulai','asc');

          if (!empty($id_alkes)) {
          	# code...
          	$records->where(['catatan_pemeliharaan.id_alkes'=>$id_alkes]);
          }
          if (!empty($mulai)) {
          	# code...
          	$records->whereDate('catatan_pemeliharaan.mulai','>=',$mulai);

          }

          if (!empty($selesai)) {
          	# code...
          	$records->whereDate('catatan_pemeliharaan.mulai','<=',$selesai);

          }

      $data['records'] = $records;
    	$data['data_alkes'] = $data_alkes;

    	$pdf = PDF::loadView('catatan_pemeliharaan.print-filter',$data);

    	    // $pdf->setPaper('A3', 'landscape');
		$pdf->setPaper(array(0,0,609.4488,935.433), 'landscape');
		return $pdf->stream('invoice.pdf');
    	// return view('catatan_pemeliharaan/print-filter');
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
}
