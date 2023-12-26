<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Ruangan; 
use App\UploadJadwal; 
use PDF;


class UploadJadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $dir = "jadwal_ipsrs";
    protected $url = "jadwal_ipsrs";


  



    public function json(){
          $data = UploadJadwal::select([
            'upload_jadwal.id',
            'upload_jadwal.nama_file',
            'upload_jadwal.tempat_file',
            'upload_jadwal.is_aktif',
            ]);

            return Datatables::of($data)->addColumn('action',function($d){
                return '<a class="btn btn-sm btn-info" target="_blank" href="'.url(@$d->tempat_file).'">lihat file</a>
                        <button class="btn btn-sm btn-danger delete-btn" href="'.url($this->url.'/'.$d->id).'"><i class="fas fa-trash"></i></button>

                        <a class="btn btn-sm btn-warning" href="'.url('aktifkan-jadwal').'/'.$d->id.'">Aktifkan</a>
                        ';


            })->editColumn('is_aktif', function($d){
              if ($d->is_aktif == 1) {
                return 'Aktif';
              }else {
                return '-';
              }
            })
            ->addIndexColumn()
            ->make(true);

    }





    public function index(Request $request)
    {


        $title = "Ruangan";


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
            'nama_file' => 'required',
            'file' => 'required',
        ]);


        $file = $request->file('file');
        $namaFile = $file->getClientOriginalName();
        $tujuan_upload = 'upluad_ipsrs/';
        $namaUpload = $tujuan_upload.$namaFile;
        $file->move($tujuan_upload,$file->getClientOriginalName());

        $ruangan = new UploadJadwal;
        $ruangan->nama_file = $request->nama_file;
        $ruangan->tempat_file = $namaUpload;
        $save = $ruangan->save();

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
        $table = UploadJadwal::find($id);
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

    
    public function aktifkan_jadwal($id){
      UploadJadwal::query()->update(['is_aktif' => 0]);

      $d = UploadJadwal::find($id);
      $d->is_aktif = 1;
      $s = $d->save();

      if($s){
        return view('jadwal_ipsrs.index');
      }
    }


    public function show_jadwal_ipsrs()
    {
        $data = UploadJadwal::where('is_aktif', 1)->first();
        if($data){
            $url_pdf = $data->tempat_file;
            return response()->file(public_path($url_pdf));
        }
    }
    

    

}
