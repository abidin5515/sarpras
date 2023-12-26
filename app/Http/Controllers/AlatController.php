<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Alat; 
use App\Checklist;
use App\KategoriChecklist;
// use App\Checklist;




class AlatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $dir = "alat";
    protected $url = "alat";


  



    public function json(){
          $data = Alat::select(['alat.id',
'alat.nama',
// 'alat.gambar',
// 'alat.merk',
// 'alat.tipe',
// 'alat.nomor_seri',
// 'alat.manufacture',
]);

            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action',function($d){
                return '<a class="btn btn-success " href="'.url($this->url.'/'.$d->id.'/edit').'">Ubah</a>
<button class="btn btn-danger delete-btn" href="'.url($this->url.'/'.$d->id).'">Hapus</button>';


            })->make(true);

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

        $kategoriChecklist = KategoriChecklist::all();
        $title = "Create";
        
        
        return view($this->dir.'/create',compact('title', 'kategoriChecklist'));
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
// "gambar" => "required" ,
// "merk" => "required" ,
// "tipe" => "required" ,
// "nomor_seri" => "required" ,
// "manufacture" => "required" ,

]);


    $alat = new Alat;

    $alat->nama = $request->nama;
// $gambar = $request->file("gambar");
// if(!empty($gambar)){
// $ext_gambar = $gambar->getClientOriginalExtension();
// $name_gambar = $gambar->getClientOriginalName();
// $gambar_name = time().'.'.$ext_gambar;
// $gambar->move(public_path("gambar_alat"),$gambar_name);
// $gambar_path = "gambar_alat/".$gambar_name;
// $alat->gambar = $gambar_path;
// }
// $alat->merk = $request->merk;
// $alat->tipe = $request->tipe;
// $alat->nomor_seri = $request->nomor_seri;
// $alat->manufacture = $request->manufacture;
$save = $alat->save();
$id_alat = $alat->id;

// insert checklist
$checklist = $request->checklist;
if (!empty($checklist)) {
        # code...
        foreach ($checklist as  $k =>$c) {
          # code...
          // print_r($c);
            if (!empty($c)) {
              # code...
              foreach ($c as $key => $value) {
                # code...
                // print_r(@$value['name']);
                $name = @$value['name'];
                $id = @$value['id'];

                // print_r($id);

                // var_dump($v);
                // print_r($value);
                  if (!empty($id)) {

                  if (!empty($name)) {

                    $explode = explode('-', $id);

                    if (count($explode)>1) {
                      # code...
                      $id = $explode[0];
                      $checklist =  Checklist::find($id);
                       $checklist->delete();
                    }
                    else{

                  $checklist =  Checklist::find($id);
                  $checklist->nama = $name;
                  $checklist->id_kategori_checklist = $k;
                  $checklist->id_alat = $id_alat;
                  $checklist->save();
                  
                    }
                   
                    # code...

                    // echo $id;

                  }
                  else{
                    // echo $name;
                  $checklist = new Checklist;
                  $checklist->nama = $name;
                  $checklist->id_kategori_checklist = $k;
                  $checklist->id_alat = $id_alat;
                  $checklist->save();
                  }
                  # code...
                }
                else{

                    // echo $name;
                  if (!empty($name)) {
                    # code...
                    
                  $checklist = new Checklist;
                  $checklist->nama = $name;
                  $checklist->id_kategori_checklist = $k;
                  $checklist->id_alat = $id_alat;
                  $checklist->save();
                  }
                }
              }
            }
        }

        // return [
        //   'success'=>true,
        //   'msg'=>'Berhasil Menyimpan Data'
        // ];
      }

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
        $table = Alat::find($id);
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
$kategoriChecklist = KategoriChecklist::all();
        // $data = $this->fields();
// echo $id;
// return;
        $data = Alat::find($id);

        $title = "Edit Data";
        $subtitle = "";
        
        $checklist = Checklist::where('id_alat',$id);
      if ($checklist->count()) {
        $checklistGroup = [];

        $num =0;
        foreach ($checklist->get() as $key => $value) {
          # code...
          $checklistGroup[$value->id_kategori_checklist][] = [
            'nama'=>$value->nama,
            'id'=>$value->id,
            // 'num'=>$num++
          ];
        }
        // print_r($checklistGroup);
        // return;

      }
        

        return view($this->dir.'/edit',compact('data','kategoriChecklist', 'checklist','checklistGroup'));
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
// "gambar" => "required" ,
// "merk" => "required" ,
// "tipe" => "required" ,
// "nomor_seri" => "required" ,
// "manufacture" => "required" ,

]);

    @$alat =  Alat::find($id);

    $alat->nama = $request->nama; 
// $gambar = $request->file("gambar");
// if(!empty($gambar)){
//     //menghapus gambar lama
//     $file_path = public_path().'/'.$alat->gambar;
//     if(file_exists($file_path)){
//         unlink($file_path);    
//     }

//     $ext_gambar = $gambar->getClientOriginalExtension();
//     $name_gambar = $gambar->getClientOriginalName();
//     $gambar_name = time().'.'.$ext_gambar;
//     $gambar->move(public_path("gambar_alat/"),$gambar_name);
//     $gambar_path = "gambar_alat/".$gambar_name;
//     $alat->gambar = $gambar_path;

    
// }

// $alat->merk = $request->merk;
// $alat->tipe = $request->tipe;
// $alat->nomor_seri = $request->nomor_seri;
// $alat->manufacture = $request->manufacture;
$save = $alat->save();

$id_alat = $id;
$checklist = $request->checklist;
if (!empty($checklist)) {
        # code...
        foreach ($checklist as  $k =>$c) {
          # code...
          // print_r($c);
            if (!empty($c)) {
              # code...
              foreach ($c as $key => $value) {
                # code...
                // print_r(@$value['name']);
                $name = @$value['name'];
                $id = @$value['id'];

                // print_r($id);

                // var_dump($v);
                // print_r($value);
                  if (!empty($id)) {

                  if (!empty($name)) {

                    $explode = explode('-', $id);

                    if (count($explode)>1) {
                      # code...
                      $id = $explode[0];
                      $checklist =  Checklist::find($id);
                       $checklist->delete();
                    }
                    else{

                  $checklist =  Checklist::find($id);
                  $checklist->nama = $name;
                  $checklist->id_kategori_checklist = $k;
                  $checklist->id_alat = $id_alat;
                  $checklist->save();
                  
                    }
                   
                    # code...

                    // echo $id;

                  }
                  else{
                    // echo $name;
                  $checklist = new Checklist;
                  $checklist->nama = $name;
                  $checklist->id_kategori_checklist = $k;
                  $checklist->id_alat = $id_alat;
                  $checklist->save();
                  }
                  # code...
                }
                else{

                    // echo $name;
                  if (!empty($name)) {
                    # code...
                    
                  $checklist = new Checklist;
                  $checklist->nama = $name;
                  $checklist->id_kategori_checklist = $k;
                  $checklist->id_alat = $id_alat;
                  $checklist->save();
                  }
                }
              }
            }
        }

        // return [
        //   'success'=>true,
        //   'msg'=>'Berhasil Menyimpan Data'
        // ];
      }

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
        $table = Alat::find($id);
        $delete = $table->delete();
         
         $ceknya = Checklist::where('id_alat', $id);
         if($ceknya->count()){
            $hapus = $ceknya->delete();
            }
         
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
        $data = Alat::select(['alat.id','alat.nama as text'])->where('nama','like', '%'.$q.'%')->get();

        return $data;
    }

    public function getChecklist(Request $request){
        // id_alat
        $id = $request->id;
        $checklist = Checklist::where('id_alat',$id)
        ->leftJoin('kategori_checklist','checklist.id_kategori_checklist','kategori_checklist.id')
        ->select(['kategori_checklist.nama as nama_kategori','checklist.*','kategori_checklist.id as id_kategori'])
        ->orderBy('checklist.id','ASC');



        if ($checklist->count()) {
            # code...
            $results = [];
            $checklistData = $checklist->get();
            foreach ($checklist->get() as $key => $value) {
                $results[$value->nama_kategori][] = [
                    'nama'=>$value->nama,
                    'id'=>$value->id
                ];
            }

            return [
                'data'=>$results
            ];
        }
        else{
            return [
                'data'=>null
            ];
        }

        // $group = $checklist->groupBy()



    }

    

}
