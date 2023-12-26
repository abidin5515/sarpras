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

class MintaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $dir = "permintaan";
    protected $url = "permintaan";


  
    public function index(){

      return view('checklist-alat/index',compact('kategoriChecklist'));
    }
}