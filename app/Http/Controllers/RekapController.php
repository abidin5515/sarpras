<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CatatanPemeliharaan;
use DataTables;

use PDF;
class RekapController extends Controller
{
    //

    public function rekap($rekap){



			$start = date('Y-m-d', strtotime('-3 years'));
			$end = date('Y-m-d', strtotime('+3 years'));
			$getRangeYear   = range(gmdate('Y', strtotime($start)), gmdate('Y', strtotime($end)));



    	if ($rekap=='kalibrasi') {
    		# code...
    		return view('rekap/kalibrasi',compact('getRangeYear'));

    	}
    	elseif ($rekap=='perbaikan') {
    		# code...
    		return view('rekap/perbaikan',compact('getRangeYear'));

    	}
    }

    public function data(Request $request){
    	$rekap = $request->rekap;
    	$tahun = $request->tahun;


    		// echo "string";


  $data = CatatanPemeliharaan::select([
          	'catatan_pemeliharaan.no_invent',
          	'catatan_pemeliharaan.id',
			'alat.nama',
			'data_alkes.merk',
			'data_alkes.tipe',
			'data_alkes.nomor_seri',
			'catatan_pemeliharaan.masa_kalibrasi',
			'jenis_pekerjaan.nama as jenis_pekerjaan',
      'supplier.nama as vendor',
			'teknisi.nama as nama_teknisi',
      'catatan_pemeliharaan.mulai',
      'catatan_pemeliharaan.tanggal',
			'catatan_pemeliharaan.id_jenis_pekerjaan',
			'catatan_pemeliharaan.selesai',
      'catatan_pemeliharaan.id_teknisi_setempat',
      'catatan_pemeliharaan.id_vendor',
			'catatan_pemeliharaan.bengkel_rujukan',
			'catatan_pemeliharaan.jumlah_biaya',
			'ruangan.nama as ruangan_nama',
		])->leftJoin('data_alkes','catatan_pemeliharaan.id_alkes','data_alkes.id')
          ->leftJoin('alat','data_alkes.id_alat','alat.id')
          ->leftJoin('jenis_pekerjaan','catatan_pemeliharaan.id_jenis_pekerjaan','jenis_pekerjaan.id')
          ->leftJoin('supplier','catatan_pemeliharaan.id_vendor','supplier.id')
          ->leftJoin('teknisi','catatan_pemeliharaan.id_teknisi_setempat','teknisi.id')
          ->leftJoin('ruangan','catatan_pemeliharaan.id_ruang','ruangan.id')
          ->orderBy('catatan_pemeliharaan.created_at','desc');

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

          if ($rekap=='perbaikan') {
          	# code...
          	$data->where('catatan_pemeliharaan.id_jenis_pekerjaan',6);

          }

          if ($rekap=='kalibrasi') {
          	# code...
          	$data->where('catatan_pemeliharaan.id_jenis_pekerjaan',2);

          }

          if (!empty($tahun)) {
          	# code...
          	$data->whereYear('tanggal',$tahun);
          }
          else{
          	$data->whereYear('tanggal',date('Y'));

          }


            return Datatables::of($data)
            ->editColumn('mulai',function($d){
            	return date('d-m-Y',strtotime($d->mulai));
            })
            ->editColumn('selesai',function($d){
            	return date('d/m/Y',strtotime($d->selesai));
            })
            ->editColumn('tanggal',function($d){
            	return date('d/m/Y',strtotime($d->tanggal));
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
            ->addIndexColumn()
            ->make(true);



    }



    public function perbaikanData(Request $request){
      $rekap = $request->rekap;
      $tahun = $request->tahun;
      if(empty($tahun) || $tahun=''){
        $tahun = date('Y');
      }else {
        $tahun = $request->tahun;
      }
      // echo $tahun;
      // exit;
      // return;


        // echo "string";


  $data = CatatanPemeliharaan::select([
            'catatan_pemeliharaan.no_invent',
            'catatan_pemeliharaan.id',
      'alat.nama',
      'data_alkes.merk',
      'data_alkes.tipe',
      'data_alkes.nomor_seri',
      'catatan_pemeliharaan.masa_kalibrasi',
      'jenis_pekerjaan.nama as jenis_pekerjaan',
      'supplier.nama as vendor',
      'teknisi.nama as nama_teknisi',
      'catatan_pemeliharaan.mulai',
      'catatan_pemeliharaan.tanggal',
      'catatan_pemeliharaan.id_jenis_pekerjaan',
      'catatan_pemeliharaan.selesai',
      'catatan_pemeliharaan.id_teknisi_setempat',
      'catatan_pemeliharaan.id_vendor',
      'catatan_pemeliharaan.bengkel_rujukan',
      'catatan_pemeliharaan.nomor',
      'catatan_pemeliharaan.jumlah_biaya',
      'ruangan.nama as ruangan_nama',
      'perbaikan.nomor as nomor_perbaikan',
      
      'perbaikan.nama_pemesan',
      'catatan_pemeliharaan.keluhan',
      'catatan_pemeliharaan.tindakan',
      'perbaikan.suku_cadang',
      'perbaikan.selesai_dikerjakan',
      'perbaikan.tanggal as perbaikan_tanggal',
      // 'perbaikan.laporan_kerusakan_awal',
    ])->leftJoin('data_alkes','catatan_pemeliharaan.id_alkes','data_alkes.id')
          ->leftJoin('alat','data_alkes.id_alat','alat.id')
          ->leftJoin('jenis_pekerjaan','catatan_pemeliharaan.id_jenis_pekerjaan','jenis_pekerjaan.id')
          ->leftJoin('supplier','catatan_pemeliharaan.id_vendor','supplier.id')
          ->leftJoin('teknisi','catatan_pemeliharaan.id_teknisi_setempat','teknisi.id')
          ->leftJoin('ruangan','catatan_pemeliharaan.id_ruang','ruangan.id')
          ->leftJoin('perbaikan','perbaikan.id_catatan_pemeliharaan','catatan_pemeliharaan.id')
          ->whereYear('catatan_pemeliharaan.tanggal', '=', $tahun);
          // ->whereYear('catatan_pemeliharaan.tanggal',$tahun)
          
          

          if (!empty($id_alkes)) {
            # code...
            $data->where(['catatan_pemeliharaan.id_alkes'=>$id_alkes]);
          }
          // if (!empty($mulai)) {
          //   # code...
          //   $data->whereDate('catatan_pemeliharaan.mulai','>=',$mulai);

          // }

          // if (!empty($selesai)) {
          //   # code...
          //   $data->whereDate('catatan_pemeliharaan.mulai','<=',$selesai);

          // }

          if ($rekap=='perbaikan') {
            # code...
            $data->where('catatan_pemeliharaan.id_jenis_pekerjaan',6)->orWhere('catatan_pemeliharaan.id_jenis_pekerjaan',5);

          }

          if ($rekap=='kalibrasi') {
            # code...
            $data->where('catatan_pemeliharaan.id_jenis_pekerjaan',2);

          }

          // if (!empty($tahun)) {
          //   // echo "mlebu";
          //   // exit;
          //   $data->whereYear('catatan_pemeliharaan.tanggal', '=', $tahun);
          //   // echo $tahun;
          //   // echo $tahun;
          //   // exit;
          // }
          // else{

          //   $data->whereYear('catatan_pemeliharaan.taggal',date('Y'));

          // }

          $data->orderBy('catatan_pemeliharaan.created_at','desc');
            return Datatables::of($data)
            ->editColumn('mulai',function($d){
              return date('d-m-Y',strtotime($d->mulai));
            })
            ->editColumn('selesai',function($d){
              return date('d-m-Y',strtotime($d->selesai));
            })
            ->editColumn('perbaikan_tanggal',function($d){
              return date('d/m/Y',strtotime($d->perbaikan_tanggal));

            })
            ->editColumn('tanggal',function($d){

              return date('d/m/Y',strtotime($d->tanggal));
            })

            ->editColumn('selesai_dikerjakan',function($d){
              return date('d/m/Y',strtotime($d->selesai_dikerjakan));
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
            ->addIndexColumn()
            ->make(true);



    }

    public function pdfKalibrasi(Request $request){

    	
    	    	// $rekap = $request->rekap;


    		// echo "string";
    	$tahun = (empty($request->tahun)? date('Y'):$request->tahun);


  $data = CatatanPemeliharaan::select([
          	'catatan_pemeliharaan.no_invent',
          	'catatan_pemeliharaan.id',
			'alat.nama',
			'data_alkes.merk',
			'data_alkes.tipe',
			'data_alkes.nomor_seri',
			'catatan_pemeliharaan.masa_kalibrasi',
			'jenis_pekerjaan.nama as jenis_pekerjaan',
      'supplier.nama as vendor',
			'teknisi.nama as nama_teknisi',
      'catatan_pemeliharaan.mulai',
      'catatan_pemeliharaan.tanggal',
			'catatan_pemeliharaan.id_jenis_pekerjaan',
			'catatan_pemeliharaan.selesai',
      'catatan_pemeliharaan.id_teknisi_setempat',
      'catatan_pemeliharaan.id_vendor',
			'catatan_pemeliharaan.bengkel_rujukan',
			'catatan_pemeliharaan.jumlah_biaya',
			'ruangan.nama as ruangan_nama',
		])->leftJoin('data_alkes','catatan_pemeliharaan.id_alkes','data_alkes.id')
          ->leftJoin('alat','data_alkes.id_alat','alat.id')
          ->leftJoin('jenis_pekerjaan','catatan_pemeliharaan.id_jenis_pekerjaan','jenis_pekerjaan.id')
          ->leftJoin('supplier','catatan_pemeliharaan.id_vendor','supplier.id')
          ->leftJoin('teknisi','catatan_pemeliharaan.id_teknisi_setempat','teknisi.id')
          ->leftJoin('ruangan','catatan_pemeliharaan.id_ruang','ruangan.id')
          ->orderBy('catatan_pemeliharaan.created_at','desc');



          $arr['tahun'] = $tahun;

          if (!empty($tahun)) {
          	# code...
          	$data->whereYear('catatan_pemeliharaan.tanggal',$tahun);
          }



        
          	# code...
          	$data->where('catatan_pemeliharaan.id_jenis_pekerjaan',2);

         $arr['data'] =$data;


        
    	$pdf = PDF::loadView('rekap.pdf.kalibrasi',$arr);





    	    $pdf->setPaper('A4', 'landscape');
		// $pdf->setPaper(array(0,0,609.4488,935.433), 'landscape');
    return $pdf->stream(time().' - REKAP KALIBRASI TAHUN '.$tahun.'.pdf');




    }

    public function pdfPerbaikan(Request $request) {
            $tahun = (empty($request->tahun)? date('Y'):$request->tahun);

      $data = CatatanPemeliharaan::select([
            'catatan_pemeliharaan.no_invent',
            'catatan_pemeliharaan.id',
      'alat.nama',
      'data_alkes.merk',
      'data_alkes.tipe',
      'data_alkes.nomor_seri',
      'catatan_pemeliharaan.masa_kalibrasi',
      'catatan_pemeliharaan.nomor',
      'jenis_pekerjaan.nama as jenis_pekerjaan',
      'supplier.nama as vendor',
      'teknisi.nama as nama_teknisi',
      'catatan_pemeliharaan.mulai',
      'catatan_pemeliharaan.tanggal',
      'catatan_pemeliharaan.id_jenis_pekerjaan',
      'catatan_pemeliharaan.selesai',
      'catatan_pemeliharaan.id_teknisi_setempat',
      'catatan_pemeliharaan.id_vendor',
      'catatan_pemeliharaan.bengkel_rujukan',
      'catatan_pemeliharaan.jumlah_biaya',
      'ruangan.nama as ruangan_nama',
      'perbaikan.nomor as nomor_perbaikan',
      'perbaikan.nama_pemesan',
      'catatan_pemeliharaan.keluhan',
      'catatan_pemeliharaan.tindakan',
      'perbaikan.suku_cadang',
      'perbaikan.selesai_dikerjakan',
      'perbaikan.tanggal as perbaikan_tanggal',
      // 'perbaikan.laporan_kerusakan_awal',
    ])->leftJoin('data_alkes','catatan_pemeliharaan.id_alkes','data_alkes.id')
          ->leftJoin('alat','data_alkes.id_alat','alat.id')
          ->leftJoin('jenis_pekerjaan','catatan_pemeliharaan.id_jenis_pekerjaan','jenis_pekerjaan.id')
          ->leftJoin('supplier','catatan_pemeliharaan.id_vendor','supplier.id')
          ->leftJoin('teknisi','catatan_pemeliharaan.id_teknisi_setempat','teknisi.id')
          ->leftJoin('ruangan','catatan_pemeliharaan.id_ruang','ruangan.id')
          ->leftJoin('perbaikan','perbaikan.id_catatan_pemeliharaan','catatan_pemeliharaan.id')
          ->orderBy('catatan_pemeliharaan.created_at','desc');

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


            # code...
            
            $data->where('catatan_pemeliharaan.id_jenis_pekerjaan',6)->orWhere('catatan_pemeliharaan.id_jenis_pekerjaan',5);



         

          if (!empty($tahun)) {
            # code...
            $data->whereYear('catatan_pemeliharaan.tanggal',$tahun);
          }
          else{
            $data->whereYear('catatan_pemeliharaan.tanggal',date('Y'));

          }



            // $data->where('catatan_pemeliharaan.id_jenis_pekerjaan',6);

         $arr['data'] =$data;
         $arr['tahun'] =$tahun;



        
      $pdf = PDF::loadView('rekap.pdf.perbaikan',$arr);





          $pdf->setPaper('A4', 'landscape');
    // $pdf->setPaper(array(0,0,609.4488,935.433), 'landscape');
    return $pdf->stream(time().' - REKAP PERBAIKAN TAHUN '.$tahun.'.pdf');

    }
}
