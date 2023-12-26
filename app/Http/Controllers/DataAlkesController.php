<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\DataAlkes; 
use App\Ruangan; 
use Haruncpi\LaravelIdGenerator\IdGenerator;
use App\HistoryPenempatan;
use App\Alat;
use App\JenisPekerjaan;
use App\CatatanPemeliharaan;
use PDF;

class DataAlkesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $dir = "data_alkes";
    protected $url = "data-alkes";


  



    public function json(Request $req, $tipe, $id){

        if($tipe == 'n'){
          $data = DataAlkes::select(['alat.nama as nama_alat','data_alkes.no_invent', 'merk','tipe','nomor_seri','manufacture','data_alkes.kode','data_alkes.id', 'data_alkes.id_ruangan', 'ruangan.nama as lokasi', 'supplier.nama as nama_supplier'])
          ->leftJoin('ruangan', function($join) {
            $join->on('ruangan.id', '=', 'data_alkes.id_ruangan');
          })->leftJoin('alat', function($join) {
            $join->on('alat.id', '=', 'data_alkes.id_alat');
          })->leftJoin('supplier', function($join) {
            $join->on('supplier.id', '=', 'data_alkes.id_supplier');
          })->orderBy('data_alkes.id', 'DESC');
        }else {
          if($tipe == 'supplier'){
            $wherenya = 'data_alkes.id_supplier';
          }else if($tipe == 'ruangan'){
            $wherenya = 'data_alkes.id_ruangan';
          }else {
            $wherenya = 'data_alkes.id_alat';
          }

          $data = DataAlkes::select(['alat.nama as nama_alat','data_alkes.no_invent', 'merk','tipe','nomor_seri','manufacture','data_alkes.kode','data_alkes.id', 'data_alkes.id_ruangan', 'ruangan.nama as lokasi', 'supplier.nama as nama_supplier'])
          ->leftJoin('ruangan', function($join) {
            $join->on('ruangan.id', '=', 'data_alkes.id_ruangan');
          })->leftJoin('alat', function($join) {
            $join->on('alat.id', '=', 'data_alkes.id_alat');
          })->leftJoin('supplier', function($join) {
            $join->on('supplier.id', '=', 'data_alkes.id_supplier');
          })->where($wherenya, $id)
          ->orderBy('data_alkes.id', 'DESC');
                        
        }


          

            return Datatables::of($data)->addColumn('action',function($d){
                return '
                <div class="btn-group">
  <button type="button" class="btn btn-sm btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Action
  </button>
  <div class="dropdown-menu">
    <a class="dropdown-item" href="'.url($this->url.'/'.$d->id.'/show').'">Detail</a>
    <a class="dropdown-item" href="'.url($this->url.'/'.$d->id.'/edit').'">Edit</a>
    <button class="dropdown-item delete-btn" href="'.url($this->url.'/'.$d->id).'">Hapus</button>
</div>';
        })->make(true);

            // 
            // <button class="btn btn-info create-btn show-alat" data-id="'.$d->id.'" data-src="'.url($this->url.'/'.$d->id.'/show').'" data-save="false">History</button>

    }





    public function index(Request $request)
    {
        //

        $title = "Alat";


          // $data = @Table::all();
        return view($this->dir.'/index',compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //


        $title = "Create";
        
        
        return view($this->dir.'/create',compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    // UNTUK DUMP nama_alat FORM

    /**
     * Store a newly created resource in storage.
     *
     * @param  $request, $type untuk save/update,$table untuk Class nama_alat tabel

     */


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            "id_alat" => "required",
            "no_invent" => "required",
            "merk" => "required",
            "tipe" => "required",
            "nomor_seri" => "required",
            "manufacture" => "required",
            // "gambar" => "required",
            'id_ruangan'=> "required",
            'kondisi'=> "required",
            'id_supplier'=> "required",
            'tahun_pengadaan'=> "required",
            'harga_beli'=> "required",
            'id_sumber_dana'=> "required",
            // 'expected_life_time'=> "required",
            // 'present_year'=> "required",
            // 'penyusutan_pertahun'=> "required",
            // 'nilai_akumulasi'=> "required",
            // 'nilai_buku'=> "required",
            // 'sop_alat'=> "required",
            // 'operating_manual'=> "required",
            // 'service_manual'=> "required",
            // 'warranty_expired'=> "required",
            'id_kepemilikan'=> "required",
            'status'=> "required",
            'daya_listrik'=> "required",
        ]);
        $gambar = $request->file("gambar");
        if(!empty($gambar)){
          $ext_gambar = $gambar->getClientOriginalExtension();
          $name_gambar = $gambar->getClientOriginalName();
          $gambar_name = 'gambar'.time().'.'.$ext_gambar;
          $gambar->move(public_path("alat_image/gambar_alat"),$gambar_name);
          $gambar_path = "alat_image/gambar_alat/".$gambar_name;
        }

        $sop = $request->file("sop");
        if(!empty($sop)){
          $ext_sop = $sop->getClientOriginalExtension();
          $name_sop = $sop->getClientOriginalName();
          $sop_name = 'sop'.time().'.'.$ext_sop;
          $sop->move(public_path("alat_image/sop_alat"),$sop_name);
          $sop_path = "alat_image/sop_alat/".$sop_name;
        }

        $operating_manual = $request->file("operating_manual");
        if(!empty($operating_manual)){
          $ext_om = $operating_manual->getClientOriginalExtension();
          $name_om = $operating_manual->getClientOriginalName();
          $om_name = 'operating_manual'.time().'.'.$ext_om;
          $operating_manual->move(public_path("alat_image/operating_manual"),$om_name);
          $om_path = "alat_image/operating_manual/".$om_name;
        }

        // service manual
        $sm = $request->file("service_manual");
        if(!empty($sm)){
          $ext_sm = $sm->getClientOriginalExtension();
          $name_sm = $sm->getClientOriginalName();
          $sm_name = 'service_manual'.time().'.'.$ext_sm;
          $sm->move(public_path("alat_image/service_manual"),$sm_name);
          $sm_path = "alat_image/service_manual/".$sm_name;
        }
        
        // ambil awalan
        $ruangan = Ruangan::where('id', $request->id_ruangan)->first();
        $data_awalan = $ruangan->awalan;
        $kode_alat = IdGenerator::generate(['table' => 'data_alkes', 'field'=>'kode', 'length' => 6, 'prefix' =>$data_awalan, 'reset_on_prefix_change'=>true]);
        $alat = new DataAlkes;
        $alat->kode = $kode_alat;
        $alat->no_invent = $request->no_invent;
        $alat->id_alat = $request->id_alat;
        $alat->merk = $request->merk;
        $alat->tipe = $request->tipe;
        $alat->nomor_seri = $request->nomor_seri;
        $alat->manufacture = $request->manufacture;
        $alat->gambar = @$gambar_path;
        $alat->sop = @$sop_path;
        $alat->id_ruangan = $request->id_ruangan;
        $alat->kondisi = $request->kondisi;
        $alat->id_supplier = $request->id_supplier;
        $alat->tahun_pengadaan = $request->tahun_pengadaan;
        $alat->harga_beli = $request->harga_beli;
        $alat->id_sumber_dana = $request->id_sumber_dana;
        if (!empty($request->expected_life_time)) {
          # code...
        $alat->expected_life_time = $request->expected_life_time;
          
        }
        $alat->present_year = $request->present_year;
        $alat->penyusutan_pertahun = $request->penyusutan_pertahun;
        $alat->nilai_akumulasi = $request->nilai_akumulasi;
        $alat->nilai_buku = $request->nilai_buku;
        // $alat->sop_alat = $request->sop_alat;
        $alat->operating_manual = @$om_path;
        $alat->service_manual = @$sm_path;
        $alat->warranty_expired = $request->warranty_expired;
        $alat->id_kepemilikan = $request->id_kepemilikan;
        $alat->status = $request->status;
        $alat->daya_listrik = $request->daya_listrik;
        $save = $alat->save();
        
        // $history = new HistoryPenempatan;
        // $history->id_alat = $alat->id;
        // $history->id_ruangan = $request->id_ruangan;
        // $history->tgl_masuk = date('Y-m-d H:i:s');
        // $history->save();

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

      

        // $table = new Table;
        // print_r($request->all());


    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = DataAlkes::find($id);
        $jenis_pekerjaan = JenisPekerjaan::all();
        return view($this->dir.'/show', compact('data', 'jenis_pekerjaan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

        // $data = $this->fields();
        $data = DataAlkes::find($id);

        $title = "Edit Data";
        $subtitle = "";
        

        

        return view($this->dir.'/edit',compact('data','title','subtitle'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
     

      $validatedData = $request->validate([
        "no_invent" => "required",
        "id_alat" => "required",
        "merk" => "required",
            "tipe" => "required",
            "nomor_seri" => "required",
            "manufacture" => "required",
        'id_ruangan'=> "required",
        'kondisi'=> "required",
        'id_supplier'=> "required",
        'tahun_pengadaan'=> "required",
        'harga_beli'=> "required",
        'id_sumber_dana'=> "required",
        'expected_life_time'=> "required",
        // 'present_year'=> "required",
        // 'penyusutan_pertahun'=> "required",
        // 'nilai_akumulasi'=> "required",
        // 'nilai_buku'=> "required",
        // 'sop_alat'=> "required",
        // 'operating_manual'=> "required",
        // 'service_manual'=> "required",
        'warranty_expired'=> "required",
        'id_kepemilikan'=> "required",
        'status'=> "required",
        'daya_listrik'=> "required",
      ]);



    @$alat =  DataAlkes::find($id);
          $gambar = $request->file("gambar");
          if(!empty($gambar)){
              
              if($alat->gambar){
                $file_path = public_path().'/'.$alat->gambar;
                if(file_exists($file_path)){
                    unlink($file_path);    
                }  
              }
              $ext_gambar = $gambar->getClientOriginalExtension();
              $name_gambar = $gambar->getClientOriginalName();
              $gambar_name = 'gambar'.time().'.'.$ext_gambar;
              $gambar->move(public_path("alat_image/gambar_alat/"),$gambar_name);
              $gambar_path = "alat_image/gambar_alat/".$gambar_name;
              $alat->gambar = $gambar_path;
              
          }

          $sop = $request->file("sop");
          if(!empty($sop)){
              if($alat->sop){
                $file_path = public_path().'/'.$alat->sop;
                if(file_exists($file_path)){
                    unlink($file_path);    
                }  
              }
              $ext_sop = $sop->getClientOriginalExtension();
              $name_sop = $sop->getClientOriginalName();
              $sop_name = 'sop'.time().'.'.$ext_sop;
              $sop->move(public_path("alat_image/sop_alat/"),$sop_name);
              $sop_path = "alat_image/sop_alat/".$sop_name;
              $alat->sop = $sop_path;
          }

          $om = $request->file("operating_manual");
          if(!empty($om)){
              if($alat->operating_manual){
                $file_path = public_path().'/'.$alat->operating_manual;
                if(file_exists($file_path)){
                    unlink($file_path);    
                }  
              }
              $ext_om = $om->getClientOriginalExtension();
              $name_om = $om->getClientOriginalName();
              $om_name = 'operating_manual'.time().'.'.$ext_om;
              $om->move(public_path("alat_image/operating_manual/"),$om_name);
              $om_path = "alat_image/operating_manual/".$om_name;
              $alat->operating_manual = $om_path;
          }

          $sm = $request->file("service_manual");
          if(!empty($sm)){
              if($alat->service_manual){
                $file_path = public_path().'/'.$alat->service_manual;
                if(file_exists($file_path)){
                    unlink($file_path);    
                }  
              }
              $ext_sm = $sm->getClientOriginalExtension();
              $name_sm = $sm->getClientOriginalName();
              $sm_name = 'service_manual'.time().'.'.$ext_sm;
              $sm->move(public_path("alat_image/service_manual/"),$sm_name);
              $sm_path = "alat_image/service_manual/".$sm_name;
              $alat->service_manual = $sm_path;
          }

    // if($alat->id_ruangan != $request->id_ruangan){
    //   $update_history = HistoryPenempatan::where('id_alat', $id)->orderBy('id', 'DESC')->first();
      
    //   $perbarui_history = HistoryPenempatan::find($update_history->id);
    //   $perbarui_history->tgl_keluar = date('Y-m-d H:i:s');
    //   $perbarui_history->save();

    //   $insert_history = new HistoryPenempatan;
    //   $insert_history->id_alat = $id;
    //   $insert_history->id_ruangan = $request->id_ruangan;
    //   $insert_history->tgl_masuk = date('Y-m-d H:i:s');
    //   $insert_history->save();
    // }       

    $alat->id_alat = $request->id_alat;
    $alat->no_invent = $request->no_invent;
    $alat->merk = $request->merk;
    $alat->tipe = $request->tipe;
    $alat->nomor_seri = $request->nomor_seri;
    $alat->manufacture = $request->manufacture;
    
    $alat->id_ruangan = $request->id_ruangan;
    $alat->kondisi = $request->kondisi;
    $alat->id_supplier = $request->id_supplier;
    $alat->tahun_pengadaan = $request->tahun_pengadaan;
    $alat->harga_beli = $request->harga_beli;
    $alat->id_sumber_dana = $request->id_sumber_dana;
    $alat->expected_life_time = $request->expected_life_time;
    $alat->present_year = $request->present_year;
    $alat->penyusutan_pertahun = $request->penyusutan_pertahun;
    $alat->nilai_akumulasi = $request->nilai_akumulasi;
    $alat->nilai_buku = $request->nilai_buku;
    // $alat->sop_alat = $request->sop_alat;
    // $alat->operating_manual = $request->operating_manual;
    // $alat->service_manual = $request->service_manual;
    $alat->warranty_expired = $request->warranty_expired;
    $alat->id_kepemilikan = $request->id_kepemilikan;
    $alat->status = $request->status;
    $alat->daya_listrik = $request->daya_listrik;
    $save = $alat->save();



       if ($save) {
        //Do Your Something
          $status = 1;
            // return redirect($this->url);
            $msg = "Data Successfully Updated";
          $success = true;
        }
        else {
        //Do Your Something 
          $status =0;
          $success = false;
            $msg = "Data Failed to Update";

        }

        return [
          'success'=>$success,
          'msg'=>$msg
        ];


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,Request $request)
    {
        //
        $table = DataAlkes::find($id);
        $delete = $table->delete();
         if ($delete) {
        $success= true;
          $msg = 'Data Deleted successfully';

        }
        else {

          $msg = 'Failed to delete ';
            $success = false;
        }

        return [
          'success'=>$success,
          'msg'=>$msg
        ];
    }

    

    
//     public function history($id){
//       $data = HistoryPenempatan::select(['ruangan.nama as nama_ruangan', 'tgl_masuk', 'tgl_keluar'
// ])->leftJoin('ruangan', function($join) {
//       $join->on('ruangan.id', '=', 'riwayat_perpindahan.id_ruangan');
//     })->where('id_alat', $id)->orderBy('riwayat_perpindahan.id', 'DESC');
//       return Datatables::of($data)->editColumn('tgl_masuk', function($d){
//         return date('d-m-Y H:i:s', strtotime($d->tgl_masuk));
//       })->editColumn('tgl_keluar', function($d){
//         if ($d->tgl_keluar) {
//           return date('d-m-Y H:i:s', strtotime($d->tgl_keluar));  
//         }else {
//           return '-';
//         }
        
//       })->make(true);
//     }

    

    public function select2(Request $request){
      $q =$request->q;
                $data = DataAlkes::where('alat.nama','LIKE','%'.$q.'%')
                ->leftJoin('alat','data_alkes.id_alat','alat.id')
                ->leftJoin('ruangan','data_alkes.id_ruangan','ruangan.id')
                ->select(['data_alkes.id','alat.nama as text','data_alkes.no_invent','data_alkes.merk','data_alkes.tipe','data_alkes.nomor_seri','data_alkes.id_alat','ruangan.nama as nama_ruangan','data_alkes.id_ruangan']);

                if (!empty($request->ruangan)) {
                  # code...
                  $data->where('data_alkes.id_ruangan',$request->ruangan);
                }

                if ($data->count()) {
                  # code...
                  $results = [];
                  $datane = $data->get();
                  $additionals = [];
                  foreach ($datane as $key => $value) {
                    $additionals[$value->id] =[
                      'merk'=>$value->merk,
                      'tipe'=>$value->tipe,
                      'nomor_seri'=>$value->nomor_seri,
                      'id_alat'=>$value->id_alat,
                      'nama_ruangan'=>$value->nama_ruangan,
                      'id_ruangan'=>$value->id_ruangan,
                      'no_invent'=>$value->no_invent
                    ];
                  }
                  foreach ($datane as $key => $value) {
                    # code...
                    $results[] = [
                        'id'=>$value->id,
                        'text'=>$value->text.' - '.$value->no_invent,
                        'additionals'=>$additionals[$value->id]
                    ];
                  }
                }


    return $results;

    }

    public function record_pekerjaan($id_alkes, $id_pekerjaan){
       $data = CatatanPemeliharaan::select([
            'catatan_pemeliharaan.no_invent',
            'catatan_pemeliharaan.id',
      'alat.nama',
      'catatan_pemeliharaan.masa_kalibrasi',
      'jenis_pekerjaan.nama as jenis_pekerjaan',
      'supplier.nama as vendor',
      'catatan_pemeliharaan.mulai',
      'catatan_pemeliharaan.selesai',
      'catatan_pemeliharaan.id_teknisi_setempat',
      'catatan_pemeliharaan.id_vendor',
      'catatan_pemeliharaan.bengkel_rujukan',
      'catatan_pemeliharaan.jumlah_biaya',
        ])->where('id_alkes', $id_alkes)->where('id_jenis_pekerjaan', $id_pekerjaan)
          ->leftJoin('data_alkes','catatan_pemeliharaan.id_alkes','data_alkes.id')
          ->leftJoin('alat','data_alkes.id_alat','alat.id')
          ->leftJoin('jenis_pekerjaan','catatan_pemeliharaan.id_jenis_pekerjaan','jenis_pekerjaan.id')
          ->leftJoin('supplier','catatan_pemeliharaan.id_vendor','supplier.id')
          ->orderBy('catatan_pemeliharaan.created_at','desc');
    
          return Datatables::of($data)
          ->editColumn('masa_kalibrasi', function($d){
            return date('d-m-Y', strtotime($d->masa_kalibrasi));
          })
          ->editColumn('mulai', function($d){
            return date('d-m-Y', strtotime($d->mulai));
          })->editColumn('selesai', function($d){
            return date('d-m-Y', strtotime($d->selesai));
          })->addColumn('pelaksana', function($d){
            if($d->id_teknisi_setempat){
              return "Teknisi Setempat : ".$d->teknisi->nama;
            }else if($d->id_vendor){
              return "Pihak Ketiga : ".$d->vendor->nama;
            }else if($d->bengkel_rujukan){
              return "Bengkel Rujukan : ".$d->bengkel_rujukan;
            }
          })->editColumn('jumlah_biaya', function($d){
            return "Rp " . number_format($d->jumlah_biaya,2,',','.');
          })
          ->make(true);

    }
    
    public function cetak(){
      $data = DataAlkes::all();
      $pdf = PDF::loadView('data_alkes.cetak',compact('data'));
      $pdf->setPaper(array(0,0,609.4488,935.433), 'portrait');
      return $pdf->stream('Data Alkes.pdf');
    }

    public function cetakCustom($tipe, $id){
      // echo $tipe;
      // echo $id;
      // return;
      if($tipe){
        if($tipe == 'supplier'){
        $wherenya = 'id_supplier';
        }else if($tipe == 'ruangan'){
          $wherenya = 'id_ruangan';
        }else {
          $wherenya = 'id_alat';
        }
        $data = DataAlkes::where($wherenya, $id)->get();
        // $namanya = $data->
      }else {
        $data = DataAlkes::all();
      }

      // print_r($data);
      
      $pdf = PDF::loadView('data_alkes.cetak',compact('data', 'tipe', 'id'));
      $pdf->setPaper(array(0,0,609.4488,935.433), 'portrait');
      return $pdf->stream('Data Alkes.pdf');
    }

    public function filter($tipe){
      return view('layouts.filter',compact('tipe'));
    }

} 
