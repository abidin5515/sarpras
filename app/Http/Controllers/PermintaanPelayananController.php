<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\PermintaanPelayanan; 
use App\Ruangan; 
use App\DataAlkes; 
// use App\Ruangan; 
use App\HasilPeninjauan;

use PDF;
use App\Jadwal;
use App\JadwalDetail;
use App\Teknisi;






class PermintaanPelayananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $dir = "permintaan_pelayanan";
    protected $url = "permintaan-pelayanan";


  



    public function json(){
          $data = PermintaanPelayanan::join("ruangan","permintaan_pelayanan.id_ruang","=","ruangan.id")->join("data_alkes","permintaan_pelayanan.id_alkes","=","data_alkes.id")
            ->leftJoin('alat','data_alkes.id_alat','alat.id')
            // ->leftJoin('hasil_tinjauan','permintaan_pelayanan.id','hasil_tinjauan.id_permintaan_pelayanan')
            // ->leftJoin('')
            ->leftJoin('catatan_pemeliharaan','permintaan_pelayanan.id','catatan_pemeliharaan.id_permintaan_pelayanan')

          ->select([
'permintaan_pelayanan.id',
'permintaan_pelayanan.id_alkes',
'ruangan.nama as ruangan_nama',
'permintaan_pelayanan.kerusakan_alat',
'alat.nama as nama_alat',
'permintaan_pelayanan.merk',
'permintaan_pelayanan.status as statuse',
'permintaan_pelayanan.no_seri',
'permintaan_pelayanan.lain_lain',
'permintaan_pelayanan.kerusakan_awal',
'permintaan_pelayanan.tanggal_ajuan',
'permintaan_pelayanan.batas_waktu_perbaikan',
'permintaan_pelayanan.data_kerusakan_tanggal',
'permintaan_pelayanan.opsi_kerusakan',
'permintaan_pelayanan.catatan_tambahan',
'catatan_pemeliharaan.id as catatan_pemeliharaan_id',
// 'hasil_tinjauan.id as status_hasil_tinjauan'
])->orderBy('permintaan_pelayanan.created_at','DESC');

          $user = user();

          $role = $user->getRoles();
          $id_ruangan = $user->id_ruangan;
          // print_r($role);
          // exit();
          if (!empty($id_ruangan)) {
          //   # code...
            $data->where('permintaan_pelayanan.id_ruang',$id_ruangan);
          }

            return Datatables::of($data)
            ->editColumn('tanggal_ajuan', function($d){
              return date('d-m-Y', strtotime($d->tanggal_ajuan));
            })
            ->editColumn('batas_waktu_perbaikan', function($d){

              return ($d->batas_waktu_perbaikan!=null ? date('d-m-Y', strtotime($d->batas_waktu_perbaikan)):'-');
            })
            ->addColumn('action',function($d){
        $result = '';
                if ($d->statuse == 0) {
                    # code...
                    $result ='<a class="dropdown-item" href="'.url($this->url.'/'.$d->id.'/tinjauan').'">Tambah Hasil Tinjauan</a>';
                    // $result = '<span class="badge badge-warning">Belum Ditinjau</span>';
                }else {
                    $result ='<a class="dropdown-item" href="'.url($this->url.'/'.$d->id.'/editTinjauan').'">Edit Hasil Tinjauan</a>';
                }
               

               $result .= 
'<a class="dropdown-item create-btn" href="#"  data-iframe="true" data-lg="true" data-save="false" data-title="Cetak Form" data-src="'.url($this->url.'/'.$d->id.'/cetak').'">Cetak Permintaan Pelayanan</a>';

  

  if (!empty($d->catatan_pemeliharaan_id)) {
    # code...

                // $result = '<button class="btn create-btn btn-info btn-sm" data-iframe="true" data-save="false" data-src="'.url('catatan-pemeliharaan/'.$d->catatan_pemeliharaan_id.'/print-surat-tugas').'" data-title="Cetak">Cetak Catatan Pemeliharaan</button>';


               $result .= 
'<a class="dropdown-item create-btn" href="#"  data-iframe="true" data-lg="true" data-save="false" data-title="Cetak Catatan Pemeliharaan" data-src="'.url('catatan-pemeliharaan/'.$d->catatan_pemeliharaan_id.'/print-surat-tugas').'">Cetak Surat Tugas</a>';




  }
  else{
        $result .= '<a class="dropdown-item"  data-title="Cetak Form" href="'.url('catatan-pemeliharaan/create?permintaan_pelayanan='.$d->id).'">Tambah Catatan Pemeliharaan</a>';
   } 


                return '
                <div class="btn-group">

  <button type="button" class="btn btn-sm btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Action
  </button>
  <div class="dropdown-menu">
  '.$result.'
    <a class="dropdown-item" href="'.url($this->url.'/'.$d->id.'/edit').'">Edit</a>
    <button class="dropdown-item delete-btn" href="'.url($this->url.'/'.$d->id).'">Hapus</button>
</div>';





            })

            ->editColumn('status',function($d){

                $result = '';
                if ($d->statuse == 0) {
                    # code...
                    $result = '<span class="badge badge-warning">Belum Ditinjau</span>';
                }
                else{
                    $result = '<span class="badge badge-success">Sudah Ditinjau</span>';

                }
                return $result;
            })
            ->make(true);

    }





    public function index(Request $request)
    {
        //

        $title = "List";


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
        
        $ruangan= Ruangan::all(); 

        return view($this->dir.'/create',compact('title','ruangan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    // UNTUK DUMP NAMA FORM

    /**
     * Store a newly created resource in storage.
     *
     * @param  $request, $type untuk save/update,$table untuk Class nama tabel

     */


    public function store(Request $request)
    {




    $validatedData = $request->validate([
"id_ruang" => "required" ,
"kerusakan_alat" => "required" ,
"id_alkes" => "required" ,
"tanggal_ajuan" => "required" ,

]);


    $permintaan_pelayanan = new PermintaanPelayanan;

    $permintaan_pelayanan->id_ruang = $request->id_ruang;
$permintaan_pelayanan->kerusakan_alat = $request->kerusakan_alat;
$permintaan_pelayanan->id_alkes = $request->id_alkes;
$permintaan_pelayanan->merk = $request->merk;
$permintaan_pelayanan->no_seri = $request->no_seri;
$permintaan_pelayanan->model = $request->model;
$permintaan_pelayanan->lain_lain = $request->lain_lain;
$permintaan_pelayanan->kerusakan_awal = $request->kerusakan_awal;
$permintaan_pelayanan->tanggal_ajuan = $request->tanggal_ajuan;
$permintaan_pelayanan->batas_waktu_perbaikan = $request->batas_waktu_perbaikan;
$permintaan_pelayanan->data_kerusakan_tanggal = $request->data_kerusakan_tanggal;
$permintaan_pelayanan->opsi_kerusakan = $request->opsi_kerusakan;
$permintaan_pelayanan->catatan_tambahan = $request->catatan_tambahan;
$save = $permintaan_pelayanan->save();

  # code...

#store





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
        //

        $data = $this->fields();
        $table = PermintaanPelayanan::find($id);
        $title = "";
        $subtitle = "";
        return view($this->dir.'/info',compact('data','table','title','subtitle'));
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
        $data = PermintaanPelayanan::find($id);

        $title = "Edit Data";
        $subtitle = "";
        

        $ruangan= Ruangan::where('id',$data->id_ruang)->get(); 
        $alkes= DataAlkes::where('id',$data->id_alkes)->get(); 


        // print_r($alkes);
        return view($this->dir.'/edit',compact('data','title','subtitle','ruangan','alkes'));
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
"id_ruang" => "required" ,
"kerusakan_alat" => "required" ,
"id_alkes" => "required" ,
"tanggal_ajuan" => "required" ,

]);

    @$permintaan_pelayanan =  PermintaanPelayanan::find($id);

    $permintaan_pelayanan->id_ruang = $request->id_ruang;
$permintaan_pelayanan->kerusakan_alat = $request->kerusakan_alat;
$permintaan_pelayanan->id_alkes = $request->id_alkes;
$permintaan_pelayanan->merk = $request->merk;
$permintaan_pelayanan->no_seri = $request->no_seri;
$permintaan_pelayanan->model = $request->model;

$permintaan_pelayanan->lain_lain = $request->lain_lain;
$permintaan_pelayanan->kerusakan_awal = $request->kerusakan_awal;
$permintaan_pelayanan->tanggal_ajuan = $request->tanggal_ajuan;
$permintaan_pelayanan->batas_waktu_perbaikan = $request->batas_waktu_perbaikan;
$permintaan_pelayanan->data_kerusakan_tanggal = $request->data_kerusakan_tanggal;
$permintaan_pelayanan->opsi_kerusakan = $request->opsi_kerusakan;
$permintaan_pelayanan->catatan_tambahan = $request->catatan_tambahan;
$save = $permintaan_pelayanan->save();

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
        $table = PermintaanPelayanan::find($id);
        $hasilPeninjauan = HasilPeninjauan::where(['id_permintaan_pelayanan'=>$id]);
        if ($hasilPeninjauan->count()) {
          # code...
          $hasilPeninjauan->delete();
        }


        $delete = $table->delete();
         if ($delete) {
            $bersihkan = HasilPeninjauan::where('id_permintaan_pelayanan', $id);
            if($bersihkan->count()){
              $bersihkan->delete();  
            }
            
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

    

    public function tinjauan($id){
        return view('permintaan_pelayanan.tinjauan', compact('id'));
    }
    
    public function cetak(Request $req,$id){
// >>>>>>> 2b44d4e34295dbe1d0d980050ca98beca666cf76
      $bulan = array(1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
      $bulan_get = $req->bulan;
      $tahun_get = $req->tahun;
      if(!$bulan_get){
        $bulan_get = 1;
      }
      if(!$tahun_get){
        $tahun_get = 1;
      }
      $kepala = Teknisi::where('kepala', 1);
          if($kepala->count()){
              $kepala = $kepala->first();
          }else {
              $kepala = NULL;
          }
  
      $bulannya = $bulan[$bulan_get];
      // $data = Jadwal::where('bulan', $bulan_get)->where('tahun', $tahun_get)->get();


      $table = PermintaanPelayanan::find($id);
      $hasilPeninjauan = HasilPeninjauan::where('id_permintaan_pelayanan',$id)->first();

      $pdf = PDF::loadView('permintaan_pelayanan.cetak-form-permintaan',compact('data', 'bulannya', 'kepala','table','hasilPeninjauan'));
      
      $pdf->setPaper(array(0,0,609.4488,935.433), 'potrait');



      return $pdf->stream('cetak_jadwal.pdf');
    }

    
    public function getForm(Request $req, $id){
        $id_tinjau = $req->id_tinjau;
        if(!empty($id_tinjau)){
            $data_tinjau = HasilPeninjauan::find($id_tinjau);
        }else {
            $data_tinjau = NULL;
        }
        return view('permintaan_pelayanan.getForm', compact('id', 'data_tinjau'));
    }

    public function storeTinjauan(Request $req){
        // print_r($req->all());
        // return;
        $new = new HasilPeninjauan;
        $new->oleh_instalasi_alkes = $req->oleh_instalasi_alkes;
        $new->oleh_seksi_penunjang_non_medik = $req->oleh_seksi_penunjang;
        $new->kesimpulan = $req->kesimpulan;
        $new->alasan_kesimpulan = $req->kesimpulan_alasan;
        $new->alat_diperbaiki_oleh = $req->diperbaiki_oleh;
        $new->tanggal = $req->tanggal;
        $new->id_teknisi = $req->id_petugas;
        $new->id_supplier = $req->id_supplier;
        // $new->nama_perusahaan = $req->nama_perusahaan;
        // $new->alamat = $req->alamat;
        $new->rab = $req->rab;
        $new->proses_perbaikan_tanggal = $req->proses_perbaikan_tanggal;
        $new->mulai_dikerjakan = $req->mulai_dikerjakan;
        $new->perkiraan_selesai = $req->perkiraan_selesai;
        $new->pelaksanaan_swakelola = $req->pelaksanaan_swakelola;
        $new->uji_coba = $req->uji_fungsi;
        $new->kondisi_akhir = $req->kondisi_akhir;
        $new->waktu_jaminan = $req->waktu_jaminan;
        $new->catatan_tambahan = $req->catatan_tambahan;
        $new->id_permintaan_pelayanan = $req->id_permintaan_pelayanan;
        $save = $new->save();
        if($save){
            $update = PermintaanPelayanan::find($req->id_permintaan_pelayanan);
            $update->status = '1';
            $simpan = $update->save();
            if($simpan){
              $msg = "data saved successfully";
              $success = true;  
            }else {
              $msg = "Terjadi Kesalahan";
              $success = false;
            }
            
        }else {
           $msg = "data failed to save";
            $success = false; 
        }

        return [
            'success'=>$success,
            'msg'=>$msg
        ];
    }

    public function editTinjauan($id){
        $tinjauan = HasilPeninjauan::where('id_permintaan_pelayanan', $id);
        if($tinjauan->count()){
            $data = $tinjauan->first(); 
        }else {
            $data = NULL;
        }
        // print_r($data);
        // return;
        return view('permintaan_pelayanan.tinjauan_edit', compact('data'));
    }

    public function updateTinjauan(Request $req){
        $id = $req->id;
        $new = HasilPeninjauan::find($id);
        $new->oleh_instalasi_alkes = $req->oleh_instalasi_alkes;
        $new->oleh_seksi_penunjang_non_medik = $req->oleh_seksi_penunjang;
        $new->kesimpulan = $req->kesimpulan;
        $new->alasan_kesimpulan = $req->kesimpulan_alasan;
        $new->alat_diperbaiki_oleh = $req->diperbaiki_oleh;
        $new->tanggal = $req->tanggal;
        $new->id_teknisi = $req->id_petugas;
        $new->id_supplier = $req->id_supplier;
        // $new->nama_perusahaan = $req->nama_perusahaan;
        // $new->alamat = $req->alamat;
        $new->rab = $req->rab;
        $new->proses_perbaikan_tanggal = $req->proses_perbaikan_tanggal;
        $new->mulai_dikerjakan = $req->mulai_dikerjakan;
        $new->perkiraan_selesai = $req->perkiraan_selesai;
        $new->pelaksanaan_swakelola = $req->pelaksanaan_swakelola;
        $new->uji_coba = $req->uji_fungsi;
        $new->kondisi_akhir = $req->kondisi_akhir;
        $new->waktu_jaminan = $req->waktu_jaminan;
        $new->catatan_tambahan = $req->catatan_tambahan;
        $new->id_permintaan_pelayanan = $req->id_permintaan_pelayanan;
        $save = $new->save();

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
}
