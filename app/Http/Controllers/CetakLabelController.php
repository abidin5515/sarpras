<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\DataAlkes; 
use App\Ruangan; 
use Haruncpi\LaravelIdGenerator\IdGenerator;
use App\HistoryPenempatan;
use PDF;
use QrCode;


class CetakLabelController extends Controller
{   

    protected $dir = "cetak-label";
    protected $url = "cetak-label";
    
    public function index(){
      return view($this->dir.'/index');
    }
  
    public function json(Request $req){
      $tipe = $req->tipe;
      $id = $req->id;
      if($tipe){
        if($id){
          if($tipe == 'supplier'){
          $wherenya = 'id_supplier';
        }else if($tipe == 'alat'){
          $wherenya = 'id_alat';
        }else {
          $wherenya = 'id_ruangan';
        }

        $data = DataAlkes::select(['alat.nama as nama_alat','merk','tipe','nomor_seri','manufacture','data_alkes.kode','data_alkes.id', 'data_alkes.id_ruangan', 'ruangan.nama as lokasi', 'supplier.nama as nama_supplier'
          ])->leftJoin('ruangan', function($join) {
            $join->on('ruangan.id', '=', 'data_alkes.id_ruangan');
          })->leftJoin('alat', function($join) {
           $join->on('alat.id', '=', 'data_alkes.id_alat');
            })->leftJoin('supplier', function($join) {
           $join->on('supplier.id', '=', 'data_alkes.id_supplier');
            })->where($wherenya, $id);
          }else {
            $data = DataAlkes::select(['alat.nama as nama_alat','merk','tipe','nomor_seri','manufacture','data_alkes.kode','data_alkes.id', 'data_alkes.id_ruangan', 'ruangan.nama as lokasi', 'supplier.nama as nama_supplier'
          ])->leftJoin('ruangan', function($join) {
            $join->on('ruangan.id', '=', 'data_alkes.id_ruangan');
          })->leftJoin('alat', function($join) {
           $join->on('alat.id', '=', 'data_alkes.id_alat');
            })->leftJoin('supplier', function($join) {
           $join->on('supplier.id', '=', 'data_alkes.id_supplier');
            });
          }
        

      }else {
        $data = DataAlkes::select(['alat.nama as nama_alat','merk','tipe','nomor_seri','manufacture','data_alkes.kode','data_alkes.id', 'data_alkes.id_ruangan', 'ruangan.nama as lokasi', 'supplier.nama as nama_supplier'
          ])->leftJoin('ruangan', function($join) {
            $join->on('ruangan.id', '=', 'data_alkes.id_ruangan');
          })->leftJoin('alat', function($join) {
           $join->on('alat.id', '=', 'data_alkes.id_alat');
            })->leftJoin('supplier', function($join) {
           $join->on('supplier.id', '=', 'data_alkes.id_supplier');
            });
      }
          

            return Datatables::of($data)
            ->addColumn('pilih',function($d){
              return '<input type="checkbox" value="'.$d->id.'">';
            })
            ->make(true);
    }

    public function semua(){
      $data = DataAlkes::all();  
      return view($this->dir.'/cetak_semua',compact('data'));
    }

    public function custom(Request $req){
      // print_r($req->all());
      // return;
      $berdasar = $req->filter;
      $id = $req->id_val;
      
      if($berdasar){
        if($berdasar == 'supplier'){
          $wherenya = 'id_supplier';
        }else {
          $wherenya = 'id_ruangan';
        }
      }  
        $data = DataAlkes::where($wherenya,  $id)->get();  
      
      return view($this->dir.'/cetak_semua',compact('data'));
    }

    public function customNew(Request $req){
      // print_r($req->all());
      // return;
      $id_alkes = $req->id_alkes;
      // print_r($id_alkes);
      // echo $id_alkes;
      if($id_alkes){
        $data = DataAlkes::whereIn('id', $id_alkes)->get();
      }else {
        return "KOSONG !";
      }
      
      return view($this->dir.'/cetak_semua',compact('data'));
    }

    public function getData(Request $req){
      // print_r($req->all());
      $berdasar = $req->tipe;
      $id = $req->id;
      
      if($berdasar != ''){
        if($berdasar == 'supplier'){
          $wherenya = 'id_supplier';
        }else {
          $wherenya = 'id_ruangan';
        }

        // $data = DataAlkes::where($wherenya,  $id)->get();
        $data = DataAlkes::select(['alat.nama as nama_alat','data_alkes.id as idne', 'ruangan.nama as lokasi', 'supplier.nama as nama_supplier'
          ])->leftJoin('ruangan', function($join) {
            $join->on('ruangan.id', '=', 'data_alkes.id_ruangan');
          })->leftJoin('alat', function($join) {
           $join->on('alat.id', '=', 'data_alkes.id_alat');
            })->leftJoin('supplier', function($join) {
           $join->on('supplier.id', '=', 'data_alkes.id_supplier');
            })->where($wherenya,  $id)->get();;
        
      }else {
        $data = null;
      } 

      return [
          'data'=>$data
        ]; 
    }

}
