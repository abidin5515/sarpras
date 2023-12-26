<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Inventaris; 
use Rap2hpoutre\FastExcel\FastExcel;
use PDF;
class InventarisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $dir = "inventaris";
    protected $url = "inventaris";


  



    public function json(Request $request){ 
          // print_r($request->all());
          $merk = $request->merk;
          $ruang = $request->ruang;
          $master_barang_id = $request->master_barang_id;
          
          $data = Inventaris::select([
            'inventaris.id',
            'inventaris.master_barang_id',
            'inventaris.nama_barang',
            'inventaris.nomor_seri',
            'inventaris.merk',
            'inventaris.tipe',
            'inventaris.kapasitas',
            'inventaris.ruang',
            'inventaris.jumlah',
            'inventaris.kondisi',
            'inventaris.keterangan',
            ]);

            if (!empty($merk) && $merk != '-') {
              $data->where(['inventaris.merk'=>$merk]);
            }
            if (!empty($ruang) && $ruang!='-') {
              $data->where(['inventaris.ruang'=>$ruang]);
            }

            if (!empty($master_barang_id) && $master_barang_id!='-') {
              $data->where(['inventaris.master_barang_id'=>$master_barang_id]);
            }

            return Datatables::of($data)->addColumn('action',function($d){
                return '<a data-title="Ubah" class="btn btn-sm btn-warning edit-btn" href="'.url($this->url.'/'.$d->id.'/edit').'"><i class="fas fa-edit"></i></a>
<button class="btn btn-sm btn-danger delete-btn" href="'.url($this->url.'/'.$d->id).'"><i class="fas fa-trash"></i></button>';

            })->addColumn('namabarang',function($d){
                if ($d->master_barang_id) {
                  return @$d->masterbarang->nama;
                }
            
            })->addColumn('merknama',function($d){
                if ($d->merk) {
                  return @$d->mastermerk->nama;
                }
            })->addColumn('ruangnama',function($d){
                if (@$d->ruang) {
                  return @$d->masterruang->nama;
                }
            })

            ->addIndexColumn()
            ->make(true);

    }





    public function index(Request $request)
    {
        //

        $title = "List";
        // $kepala = Teknisi::where('kepala', 1);
        // if($kepala->count()){
        //     $kepala = $kepala->first();
        // }else {
        //     $kepala = NULL;
        // }

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

    // UNTUK DUMP NAMA FORM

    /**
     * Store a newly created resource in storage.
     *
     * @param  $request, $type untuk save/update,$table untuk Class nama tabel

     */


    public function store(Request $request)
    {




    $validatedData = $request->validate([
      // "nama_barang" => "required" ,
      "merk" => "required" ,
      "tipe" => "required" ,
      "ruang" => "required" ,
      "jumlah" => "required" ,
      "kondisi" => "required" ,
      'master_barang_id' => "required"
    ]);

    // return makekode($request->master_barang_id);
    // exit();

    $i = new Inventaris;

    $i->nomor_seri = makekode($request->master_barang_id);
    $i->master_barang_id = $request->master_barang_id;
    // $i->nama_barang = $request->nama_barang;
    $i->merk = $request->merk;
    $i->tipe = $request->tipe;
    $i->kapasitas = $request->kapasitas;
    $i->ruang = $request->ruang;
    $i->jumlah = $request->jumlah;
    $i->kondisi = $request->kondisi;
    $i->keterangan = $request->keterangan;
    $save = $i->save();

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
        $table = Teknisi::find($id);
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
        $data = Inventaris::find($id);

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
      // "nama_barang" => "required" ,
      "merk" => "required" ,
      "tipe" => "required" ,
      "ruang" => "required" ,
      "jumlah" => "required" ,
      "kondisi" => "required" ,
      "master_barang_id" => "required"
    ]);


    $i = Inventaris::find($id);

    if ($i->master_barang_id != $request->master_barang_id) {
      $i->nomor_seri = makekode($request->master_barang_id);
      $i->master_barang_id = $request->master_barang_id;
    }

    // $i->nama_barang = $request->nama_barang;
    $i->merk = $request->merk;
    $i->tipe = $request->tipe;
    $i->kapasitas = $request->kapasitas;
    $i->ruang = $request->ruang;
    $i->jumlah = $request->jumlah;
    $i->kondisi = $request->kondisi;
    $i->keterangan = $request->keterangan;
    $save = $i->save();

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
        $table = Inventaris::find($id);
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

    


    public function select2(Request $req){
        $q = $req->q;
        $data = Teknisi::select(['teknisi.id','teknisi.nama as text','ttd'])->where('nama','like', '%'.$q.'%');
            $resuts = [];

        if ($data->count()==0) {
            # code...
        $data = Teknisi::select(['teknisi.id','teknisi.nama as text','ttd'])->limit(10);

        }
       
            foreach ($data->get() as $key => $value) {
                # code...
                $resuts[] =[
                    'id'=>$value->id,
                    'text'=>$value->text,
                    'additionals'=>[
                        'ttd'=>$value->ttd
                    ]
                ];
            }


        return $resuts;
    }


    
    public function updateKepala(Request $req){
        $id = $req->id_petugas;
        if(empty($id)){
            return ['success'=>false, 'msg'=>'Tentukan teknisi!'];
        }else {
            $setDefault = Teknisi::where('id', '>', 0)->update(['kepala' => 0]);
            if($setDefault){
                $setKepala = Teknisi::find($id);
                $setKepala->kepala = 1;
                $save = $setKepala->save();
                if($save){
                    return ['success'=>true, 'msg'=>'Kepala teknisi ditentutkan!'];
                }else {
                    return ['success'=>false, 'msg'=>'Terjadi Kesalahan!'];
                }
            }else {
                return ['success'=>false, 'msg'=>'gagal set value!'];
            }
        }    
    }
    

    public function export(Request $req){
      $merk = $req->merk;
      $ruang = $req->ruang;
      $master_barang_id = $req->master_barang_id;
      $tipe = $req->tipe;


      $data = Inventaris::select([
            'inventaris.id',
            'inventaris.master_barang_id',
            'inventaris.nama_barang',
            'inventaris.nomor_seri',
            'inventaris.merk',
            'inventaris.tipe',
            'inventaris.kapasitas',
            'inventaris.ruang',
            'inventaris.jumlah',
            'inventaris.kondisi',
            'inventaris.keterangan',
            ]);

      if (!empty($merk) && $merk != '' && $merk != 'null' && $merk != '-') {
        $data->where(['inventaris.merk'=>$merk]);
      }
      if (!empty($ruang)  && $ruang != '' && $ruang != 'null' && $ruang != '-') {
        $data->where(['inventaris.ruang'=>$ruang]);
      }

      if (!empty($master_barang_id)  && $master_barang_id != '' && $master_barang_id != 'null' && $master_barang_id != '-') {
        $data->where(['inventaris.master_barang_id'=>$master_barang_id]);
      }

      $data = $data->get();
      
      if($tipe == 'pdf'){
        $pdf = PDF::loadView('inventaris.pdf', compact('data'));
        $pdf->setPaper('A4', 'portrait');
        return $pdf->download('inventaris.pdf');
      }else{
        return (new FastExcel($data))->download('inventaris.xlsx', function ($d) {
              return [
                'Nama Barang' => $d->masterbarang->nama,
                'Merk' => $d->mastermerk->nama,
                'Tipe' => $d->tipe,
                'Kapasitas' => $d->kapasitas,
                'Nomor Seri'=> $d->nomor_seri,
                'Ruang' => $d->masterruang->nama,
                'Jumlah'=> $d->jumlah,
                'Kondisi'=> $d->kondisi,
                'Keterangan'=> $d->keterangan
            ];
        });
      }
    }

}
