<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Ruangan; 
use App\UploadJadwal; 
use App\Pengadaan; 
use PDF;
use Image;
use Rap2hpoutre\FastExcel\FastExcel;


class PengadaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $dir = "pengadaan";
    protected $url = "pengadaan";


  



    public function json(Request $request){

            $dari_tanggal = ($request->dari_tanggal!=''? $request->dari_tanggal : date('Y-m-d'));
            $sampai_tanggal = ($request->sampai_tanggal!=''? $request->sampai_tanggal : date('Y-m-d'));

          $data = Pengadaan::select([
            'pengadaan.id',
            'pengadaan.nama_barang',
            'pengadaan.ruang',
            'pengadaan.foto',
            'pengadaan.qty',
            'pengadaan.status',
            'pengadaan.keterangan',
            'pengadaan.created_at',
            ]);

            if (!empty($dari_tanggal)) 
            {
                $data->whereDate('created_at', '>=', $dari_tanggal);
            }

            if (!empty($sampai_tanggal)) {
                $data->whereDate('created_at', '<=', $sampai_tanggal);
              }

            return Datatables::of($data)->addColumn('action',function($d){
                return '
                        <button class="btn btn-sm btn-danger delete-btn" href="'.url($this->url.'/'.$d->id).'"><i class="fas fa-trash"></i></button>

                        <button type="button" class="btn btn-sm btn-warning create-btn" data-src="'.url($this->url.'/'.$d->id.'/edit').'"><i class="fas fa-edit"></i></button>
                        ';


            })->editColumn('foto', function($d){
                if ($d->foto) {
                  return '<img src="'.url($d->foto).'" width="100" class="create-btn foto-zoom" data-lg="false" data-save="false" data-src="'.url('permintaan/view_gambar?url='.$d->foto).'">';
                }else {
                  return '';
                }
            })->addColumn('tanggal_input', function($d){
                return date('d-m-Y H:i', strtotime($d->created_at));
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
            'nama_barang' => 'required',
        ]);


        $file = $request->file('foto');
          if($file){
            $namaFile = $file->getClientOriginalName();
            $tujuan_upload = 'foto_pengadaan/';
            $namaUpload = $tujuan_upload.$namaFile;

            // compress gambar
            $img = Image::make($file->getRealPath());
            $img->resize(450, 450, function ($constraint) {
                $constraint->aspectRatio();
            })->save($tujuan_upload.$namaFile);

          }

        $data = new Pengadaan;
        $data->nama_barang = $request->nama_barang;
        $data->qty = $request->qty;
        $data->ruang = $request->ruang;
        $data->status = $request->status;
        if ($file) {
            $data->foto = $namaUpload;
        }
        $data->keterangan = $request->keterangan;
        $save = $data->save();

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
        $data = Pengadaan::find($id);

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
            'nama_barang' => 'required',
        ]);


        $file = $request->file('foto');
          if($file){
            $namaFile = $file->getClientOriginalName();
            $tujuan_upload = 'foto_pengadaan/';
            $namaUpload = $tujuan_upload.$namaFile;

            // compress gambar
            $img = Image::make($file->getRealPath());
            $img->resize(450, 450, function ($constraint) {
                $constraint->aspectRatio();
            })->save($tujuan_upload.$namaFile);

          }

        $data = Pengadaan::find($id);
        $data->nama_barang = $request->nama_barang;
        $data->qty = $request->qty;
        $data->ruang = $request->ruang;
        $data->status = $request->status;
        if ($file) {
            $data->foto = $namaUpload;
        }
        $data->keterangan = $request->keterangan;
        $save = $data->save();

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
        $table = Pengadaan::find($id);
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



     public function excel(Request $request)
    {
      $dari_tanggal = $request->dari_tanggal;
      $sampai_tanggal = $request->sampai_tanggal;
      $data = Pengadaan::whereDate('created_at', '>=', $dari_tanggal)
              ->whereDate('created_at', '<=', $sampai_tanggal)
              ->get();
              $nama_file = 'Pengadaan '.date('d-m-Y', strtotime($dari_tanggal)).' sd '.date('d-m-Y', strtotime($sampai_tanggal)).'.xlsx';
              return (new FastExcel($data))->download($nama_file, function ($d) {

            return [
              'Nama Barang'=> @$d->nama_barang,
              'Qty' => @$d->qty,
              'Ruang' => @$d->ruang,
              'Status' => @$d->status,
              'Keterangan' => $d->keterangan,

            ];
        });
    }
    

    

}
