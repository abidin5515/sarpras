<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Teknisi; 


class TeknisiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $dir = "teknisi";
    protected $url = "teknisi";


  



    public function json(){
          $data = Teknisi::select([
'teknisi.id',
'teknisi.nama',
'teknisi.hp',
'teknisi.nip',
'teknisi.ttd',
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


    $teknisi = new Teknisi;

    $teknisi->nama = $request->nama;
    $teknisi->hp = $request->hp;
    $teknisi->nip = $request->nip;
$ttd = $request->file("ttd");
if(!empty($ttd)){
$ext_ttd = $ttd->getClientOriginalExtension();
$name_ttd = $ttd->getClientOriginalName();
$ttd_name = $name_ttd.time().$ext_ttd;
$ttd->move(public_path("signs"),$name_ttd);
$ttd_path = "signs/".$name_ttd;
$teknisi->ttd = $ttd_path;
}
$save = $teknisi->save();

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
        $data = Teknisi::find($id);

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

    @$teknisi =  Teknisi::find($id);

    $teknisi->nama = $request->nama;
    $teknisi->hp = $request->hp;
    $teknisi->nip = $request->nip;
$ttd = $request->file("ttd");
if(!empty($ttd)){
$ext_ttd = $ttd->getClientOriginalExtension();
$name_ttd = $ttd->getClientOriginalName();
$ttd_name = $name_ttd.time().$ext_ttd;
$ttd->move(public_path("signs"),$name_ttd);
$ttd_path = "signs/".$name_ttd;
$teknisi->ttd = $ttd_path;
}
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
        $table = Teknisi::find($id);
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
    

}
