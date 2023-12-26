<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\JenisPekerjaan; 







class JenisPekerjaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $dir = "jenis_pekerjaan";
    protected $url = "jenis-pekerjaan";


  



    public function json(){
          $data = JenisPekerjaan::select([
'jenis_pekerjaan.nama',
'jenis_pekerjaan.id',
]);

            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action',function($d){
                return '<button data-title="Ubah" class="btn btn-success create-btn" data-src="'.url($this->url.'/'.$d->id.'/edit').'">Ubah</button>
<button class="btn btn-danger delete-btn" href="'.url($this->url.'/'.$d->id).'">Hapus</button>';


            })->make(true);

    }





    public function index(Request $request)
    {
        //

        $title = "Jenis Pekerjaan";


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


    $jenis_pekerjaan = new JenisPekerjaan;

    $jenis_pekerjaan->nama = $request->nama;
$save = $jenis_pekerjaan->save();

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
        $table = JenisPekerjaan::find($id);
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
        $data = JenisPekerjaan::find($id);

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

    @$jenis_pekerjaan =  JenisPekerjaan::find($id);

    $jenis_pekerjaan->nama = $request->nama;
$save = $jenis_pekerjaan->save();

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
        $table = JenisPekerjaan::find($id);
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
        $data = JenisPekerjaan::select(['jenis_pekerjaan.id','jenis_pekerjaan.nama as text'])->where('nama','like', '%'.$q.'%')->get();

        return $data;
    }
    

}
