<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\DataCeklis; 
use App\MasterCeklis; 

class DataCeklisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $dir = "data_ceklis";
    protected $url = "data_ceklis";


  



    public function json(){
          $data = DataCeklis::select([
            'data_ceklis.id',
            'data_ceklis.id_master_ceklis',
            'data_ceklis.tanggal',
            'data_ceklis.shif',
            'data_ceklis.jumlah',
            'data_ceklis.keterangan',
          ]);

            return Datatables::of($data)->addColumn('action',function($d){
                return '<button data-title="Ubah" class="btn btn-sm btn-warning create-btn edit-btn" data-src="'.url($this->url.'/'.$d->id.'/edit').'"><i class="fas fa-edit"></i></button>

                <button class="btn btn-sm btn-danger delete-btn" href="'.url($this->url.'/'.$d->id).'"><i class="fas fa-trash"></i></button>';


            })->editColumn('tanggal',function($d){
               return date('d-m-Y', strtotime($d->tanggal));
            })->addColumn('ceklis',function($d){
               return $d->master_ceklis->nama_ceklis;
            })

            ->addIndexColumn()
            ->make(true);

    }





    public function index(Request $request)
    {
        $title = "List";
        $master_ceklis = MasterCeklis::all();
        $tanggal = @$_GET['tanggal']!='' ? @$_GET['tanggal'] : date('Y-m-d');
        $data = DataCeklis::whereDate('tanggal', $tanggal)->get();

        $datanya = [];
        foreach ($data as $d) {
          $datanya[$d->id_master_ceklis][$d->shif] = ['jumlah'=>$d->jumlah, 'keterangan'=>$d->keterangan];  
        }

        // print_r($datanya);
        // exit();

        return view($this->dir.'/index',compact('title', 'master_ceklis', 'datanya', 'tanggal'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $master_ceklis = MasterCeklis::all();

        $title = "Create";
        
        
        return view($this->dir.'/create',compact('title', 'master_ceklis'));
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
        "tanggal" => "required" ,
        "id_master_ceklis" => "required" ,
        "shif" => "required" ,
        "jumlah" => "required" ,
      ]);


      $simpan = new DataCeklis;

      $simpan->tanggal = $request->tanggal;
      $simpan->id_master_ceklis = $request->id_master_ceklis;
      $simpan->shif = $request->shif;
      $simpan->jumlah = $request->jumlah;
      $simpan->keterangan = $request->keterangan;
      $save = $simpan->save();

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
        $table = DataCeklis::find($id);
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
        $data = DataCeklis::find($id);
        $master_ceklis = MasterCeklis::all();
        $title = "Edit Data";
        $subtitle = "";
        

        

        return view($this->dir.'/edit',compact('data','title','subtitle', 'master_ceklis'));
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
        "tanggal" => "required" ,
        "id_master_ceklis" => "required" ,
        "shif" => "required" ,
        "jumlah" => "required" ,
      ]);

      @$simpan =  DataCeklis::find($id);

      $simpan->tanggal = $request->tanggal;
      $simpan->id_master_ceklis = $request->id_master_ceklis;
      $simpan->shif = $request->shif;
      $simpan->jumlah = $request->jumlah;
      $simpan->keterangan = $request->keterangan;
      $save = $simpan->save();

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
        $table = DataCeklis::find($id);
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
        $data = DataCeklis::select(['DataCeklis.id','DataCeklis.nama as text','ttd'])->where('nama','like', '%'.$q.'%');
            $resuts = [];

        if ($data->count()==0) {
            # code...
        $data = DataCeklis::select(['DataCeklis.id','DataCeklis.nama as text','ttd'])->limit(10);

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
            return ['success'=>false, 'msg'=>'Tentukan DataCeklis!'];
        }else {
            $setDefault = DataCeklis::where('id', '>', 0)->update(['kepala' => 0]);
            if($setDefault){
                $setKepala = DataCeklis::find($id);
                $setKepala->kepala = 1;
                $save = $setKepala->save();
                if($save){
                    return ['success'=>true, 'msg'=>'Kepala DataCeklis ditentutkan!'];
                }else {
                    return ['success'=>false, 'msg'=>'Terjadi Kesalahan!'];
                }
            }else {
                return ['success'=>false, 'msg'=>'gagal set value!'];
            }
        }    
    }
    

    function store_update(Request $req)
    {
        $tipe = $req->tipe;
        $id_master_ceklis = $req->id_master_ceklis;
        $tanggal = $req->tanggal;
        $val = $req->val;
        $shif = $req->shif;

        $cek = DataCeklis::updateOrCreate([
            'id_master_ceklis' => $id_master_ceklis,
            'tanggal' => $tanggal,
            'shif' => $shif
        ], [
            $tipe => $val,
        ]);

        if($cek){
          return ['success'=>true, 'msg'=>'berhaisl disimpan'];
        }else {
          return ['success'=>false, 'msg'=>'gagal disimpan'];
        }
    }

}
