<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Alat; 
use App\Ruangan;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use App\HistoryPenempatan;
use App\KategoriChecklist;

use App\Checklist;

class ChecklistAlatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $dir = "alat";
    protected $url = "alat";


  
    public function index(){

      return view('checklist-alat/index',compact('kategoriChecklist'));
    }

    public function store(Request $request){
      // print_r($request->all());
      $id_alat = $request->id_alat;

      $checklist = $request->checklist;

      // print_r($checklist);
      // exit();

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

        return [
          'success'=>true,
          'msg'=>'Berhasil Menyimpan Data'
        ];
      }
      else{

        return [
          'success'=>false,
          'msg'=>'Gagal Menyimpan Data'
        ];
      }
    }
 

    public function detail(Request $request){
      $kategoriChecklist = KategoriChecklist::all();
      $id = $request->id;
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
      return view('checklist-alat/detail',compact('kategoriChecklist','checklist','checklistGroup'));
    }



}
