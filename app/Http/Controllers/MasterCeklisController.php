<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\MasterCeklis; 


class MasterCeklisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $dir = "master_ceklis";
    protected $url = "master_ceklis";


  



    public function json(){
          $data = MasterCeklis::select([
            'master_ceklis.id',
            'master_ceklis.nama_ceklis',
          ]);

            return Datatables::of($data)->addColumn('action',function($d){
                return '<button data-title="Ubah" class="btn btn-sm btn-warning create-btn edit-btn" data-src="'.url($this->url.'/'.$d->id.'/edit').'"><i class="fas fa-edit"></i></button>
                <button class="btn btn-sm btn-danger delete-btn" href="'.url($this->url.'/'.$d->id).'"><i class="fas fa-trash"></i></button>';


            })->editColumn('ttd',function($d){
                if (!empty($d->ttd)) {
                    # code...
                return '<img src="'.url($d->ttd).'" style="width:100px;height:100px">';

                }
                return '';
            })

            ->addIndexColumn()
            ->make(true);

    }





    public function index(Request $request)
    {
        //

        $title = "List";
        // $kepala = MasterCeklis::where('kepala', 1);
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
        "nama_ceklis" => "required" ,
        ]); 

    $MasterCeklis = new MasterCeklis;

    $MasterCeklis->nama_ceklis = $request->nama_ceklis;
    $save = $MasterCeklis->save();

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
        $table = MasterCeklis::find($id);
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
        $data = MasterCeklis::find($id);

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
      "nama_ceklis" => "required" ,

      ]);

    @$MasterCeklis =  MasterCeklis::find($id);

     $MasterCeklis->nama_ceklis = $request->nama_ceklis;
     $save = $MasterCeklis->save();

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
        $table = MasterCeklis::find($id);
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
        $data = MasterCeklis::select(['MasterCeklis.id','MasterCeklis.nama as text','ttd'])->where('nama','like', '%'.$q.'%');
            $resuts = [];

        if ($data->count()==0) {
            # code...
        $data = MasterCeklis::select(['MasterCeklis.id','MasterCeklis.nama as text','ttd'])->limit(10);

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
            return ['success'=>false, 'msg'=>'Tentukan MasterCeklis!'];
        }else {
            $setDefault = MasterCeklis::where('id', '>', 0)->update(['kepala' => 0]);
            if($setDefault){
                $setKepala = MasterCeklis::find($id);
                $setKepala->kepala = 1;
                $save = $setKepala->save();
                if($save){
                    return ['success'=>true, 'msg'=>'Kepala MasterCeklis ditentutkan!'];
                }else {
                    return ['success'=>false, 'msg'=>'Terjadi Kesalahan!'];
                }
            }else {
                return ['success'=>false, 'msg'=>'gagal set value!'];
            }
        }    
    }
    

}
