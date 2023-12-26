<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\MasterMerk; 


class MasterMerkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $dir = "master-merk";
    protected $url = "master-merk";


  



    public function json(){
        $data = MasterMerk::select([
            'master_merk.id',
            'master_merk.nama',
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
      "nama" => "required" ,
    ]);


    $teknisi = new MasterMerk;
    $teknisi->nama = $request->nama;
    $save = $teknisi->save();
    
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
        $data = MasterMerk::find($id);

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
"nama" => "required" ,

]);

    @$teknisi =  MasterMerk::find($id);

    $teknisi->nama = $request->nama;
    
$save = $teknisi->save();

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
        $table = MasterMerk::find($id);
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
        $data = MasterMerk::select(['master_merk.id','master_merk.nama as text'])->where('nama','like', '%'.$q.'%');
            $resuts = [];

        if ($data->count()==0) {
            # code...
        $data = MasterMerk::select(['master_merk.id','master_merk.nama as text'])->limit(10);

        }
       
            foreach ($data->get() as $key => $value) {
                # code...
                $resuts[] =[
                    'id'=>$value->id,
                    'text'=>$value->text,
                ];
            }


        return $resuts;
    }

        public function select2f(Request $req){
        $q = $req->q;
        $data = MasterMerk::select(['master_merk.id','master_merk.nama as text'])->where('nama','like', '%'.$q.'%');
            $resuts = [];

        if ($data->count()==0) {
            # code...
        $data = MasterMerk::select(['master_merk.id','master_merk.nama as text'])->limit(10);

        }
       
            foreach ($data->get() as $key => $value) {
                # code...
                $resuts[] =[
                    'id'=>$value->id,
                    'text'=>$value->text,
                ];
            }

        $array[] = array('id'=> '-', 'text'=> '-Semua-');
        $data = array_merge($array, $resuts);
        return $data;
    }
    

    

}
