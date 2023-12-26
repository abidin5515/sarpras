<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Ruangan; 
use App\MasterShift; 



class MasterShiftController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $dir = "master_shift";
    protected $url = "master_shift";


  



    public function json(){
          $data = MasterShift::select([
            'master_shift.id',
            'master_shift.nama','master_shift.jam_masuk', 'master_shift.jam_pulang'
            ]);

            return Datatables::of($data)->addColumn('action',function($d){
                return '<button data-title="Ubah" class="btn btn-sm btn-warning create-btn edit-btn" data-src="'.url($this->url.'/'.$d->id.'/edit').'"><i class="fas fa-edit"></i></button>
                    <button class="btn btn-sm btn-danger delete-btn" href="'.url($this->url.'/'.$d->id).'"><i class="fas fa-trash"></i></button>';


            })
            ->addIndexColumn()
            ->make(true);

    }





    public function index(Request $request)
    {


        $title = "Master Shift";


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
        'nama' => 'required',
        'jam_masuk' => 'required',
        'jam_pulang' => 'required',
    ]);

    

    $shift = new MasterShift;

    $shift->nama = $request->nama;
    $shift->jam_masuk = $request->jam_masuk;
    $shift->jam_pulang = $request->jam_pulang;
    $save = $shift->save();
        
        if ($save) {
            $msg = "Data Berhasil Disimpan";
            $success = true;


        }
        else {

            $msg = "Data gagal disimpan";
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
        $table = Ruangan::find($id);
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
        $data = Ruangan::find($id);

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
     

    
    @$ruangan =  Ruangan::find($id);

    $ruangan->nama = $request->nama;
    $ruangan->awalan = strtoupper($request->awalan);
$save = $ruangan->save();

       if ($save) {
        //Do Your Something
          $status = 1;
            // return redirect($this->url);
            $msg = "Data Berhasil Diubah";
          $success = true;
        }
        else {
        //Do Your Something 
          $status =0;
          $success = false;
            $msg = "Data Gagal Diubah";

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
        $table = Ruangan::find($id);
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

    
    public function select2(Request $req){
        $q = $req->q;
        

        $role = @user()->getRoles()[0];

        if ($role=='Ruangan') {
            # code...
        $id_ruangan = user()->id_ruangan;
            $data = Ruangan::select(['ruangan.id','ruangan.nama as text',])->where('id',$id_ruangan)->get();
        }
        else{
            $data = Ruangan::select(['ruangan.id','ruangan.nama as text',])->where('nama','like', '%'.$q.'%')->get();
        }
        // $h= [];
        // foreach ($data as $a) {
        //     $h[] = ['id'=>$a->id, 'text'=>$a->text];
        // }
        // $array[] = array('id'=> '-', 'text'=> '-- Semua --');
        // $data = array_merge($array, $h);
        return $data;
        // return $data;
    }


    public function select2f(Request $req){
        $q = $req->q;
        

        $role = @user()->getRoles()[0];

        if ($role=='Ruangan') {
            # code...
        $id_ruangan = user()->id_ruangan;
            $data = Ruangan::select(['ruangan.id','ruangan.nama as text',])->where('id',$id_ruangan)->get();
        }
        else{
            $data = Ruangan::select(['ruangan.id','ruangan.nama as text',])->where('nama','like', '%'.$q.'%')->get();
        }
        $h= [];
        foreach ($data as $a) {
            $h[] = ['id'=>$a->id, 'text'=>$a->text];
        }
        $array[] = array('id'=> '-', 'text'=> '-Semua-');
        $data = array_merge($array, $h);
        return $data;
        // return $data;
    }
    

    

}
