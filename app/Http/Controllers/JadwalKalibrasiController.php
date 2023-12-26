<?php
namespace App\Http\Controllers;

use App\Alat;
use App\DataAlkes;
use App\JadwalKalibrasi;
use DataTables;
use Illuminate\Http\Request;

class JadwalKalibrasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $dir = "jadwal_kalibrasi";
    protected $url = "jadwal_kalibrasi";

    public function json()
    {

        return $dataalat;
        return Datatables::of($data)->addColumn('action', function ($d) {
            return '<button data-title="Ubah" class="btn btn-success create-btn" data-src="' . url($this->url . '/' . $d->id . '/edit') . '">Ubah</button>
                <button class="btn btn-danger delete-btn" href="' . url($this->url . '/' . $d->id) . '">Hapus</button>';
        })->make(true);

    }
    public function reminder(Request $request){
        $hari_ini = date('Y-m-d');
        $bulans = date_format(date_create($hari_ini), "m");
        $tahuns = date_format(date_create($hari_ini), "Y");

        $bulan = array(1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
        $alat = Alat::select(["*"])->get();

        $day = cal_days_in_month(CAL_GREGORIAN, $bulans, $tahuns);
        $query2 = DataAlkes::select(["*", "ruangan.nama as nama_ruang", "alat.nama as nama_alat"])->leftJoin('alat', function ($join) {
            $join->on('data_alkes.id_alat', '=', 'alat.id');
        })->leftJoin('ruangan', function ($join) {
            $join->on('data_alkes.id_ruangan', '=', 'ruangan.id');
        });
      
        $p = $query2->get();
        $count = $query2->count();


        $proses = [];
        $reminder = [];
        foreach ($p as $key => $val) {
            $kode = $val->kode;

            $tanggal = $val->tahun_pengadaan;
            $bulane = date_format(date_create($tanggal), "m");
            $hari_libur = [];
            if ($bulane == $bulans) {
                $hari = date_format(date_create($tanggal), "d");
                $hari_libur[] = $hari;
            }
            $val['hari_jadwal'] = $hari_libur;

           
            $tanggal_reminder = date('Y-m-d', strtotime('-7 days', strtotime($tanggal))); //operasi penjumlahan tanggal sebanyak 6 hari
            if ($this->check_in_range($tanggal_reminder, $tanggal, $hari_ini)) {
                
                $perbedaan = $this->dateDiff($hari_ini,$tanggal);
                $reminder[] = [
                    "kode_alat" => $val->kode,
                    "nama_alat" => $val->nama_alat,
                    "tanggal_kalibrasi" => $tanggal,
                    "waktu"=> $perbedaan." Hari lagi",
                    "gambar"=>$val->gambar
                ];
            }
          
            $proses[] = $val;
           

        }
        return view($this->dir . '/reminder', compact('reminder'));
    }

    public function index(Request $request)
    {
        //

        $title = "Jadwal Kalibrasi";

        $bulan = array(1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
        $alat = Alat::select(["*"])->get();

        $bulans = (isset($_GET['bulan']) && $_GET['bulan'] != '') ? $_GET['bulan'] : date('m');
        $tahuns = (isset($_GET['tahun']) && $_GET['tahun'] != '') ? $_GET['tahun'] : date('Y');
        $pages = (isset($_GET['page']) && $_GET['page'] != '') ? $_GET['page'] : '1';

        $offset = ($pages - 1) * 10;

        $day = cal_days_in_month(CAL_GREGORIAN, $bulans, $tahuns);
        $query2 = DataAlkes::select(["*", "ruangan.nama as nama_ruang", "alat.nama as nama_alat"])->leftJoin('alat', function ($join) {
            $join->on('data_alkes.id_alat', '=', 'alat.id');
        })->leftJoin('ruangan', function ($join) {
            $join->on('data_alkes.id_ruangan', '=', 'ruangan.id');
        });
        if (@$_GET['alat']) {
            $query2->where(['data_alkes.id_alat' => $_GET['alat']]);
        }
        // $query2->offset($offset);
        // $query2->limit(10);
        $p = $query2->get();
        $count = $query2->count();
        $jumlah_page = ceil($count / 10);
        $proses = [];
        $reminder = [];
        foreach ($p as $key => $val) {
            $kode = $val->kode;

            $tanggal = $val->tahun_pengadaan;
            $bulane = date_format(date_create($tanggal), "m");
            $hari_libur = [];
            if ($bulane == $bulans) {
                $hari = date_format(date_create($tanggal), "d");
                $hari_libur[] = $hari;
            }
            $val['hari_jadwal'] = $hari_libur;

            $hari_ini = date('Y-m-d');
            $tanggal_reminder = date('Y-m-d', strtotime('-7 days', strtotime($tanggal))); //operasi penjumlahan tanggal sebanyak 6 hari
            if ($this->check_in_range($tanggal_reminder, $tanggal, $hari_ini)) {
                
                $perbedaan = $this->dateDiff($hari_ini,$tanggal);
                $reminder[] = [
                    "kode_alat" => $val->kode,
                    "nama_alat" => $val->nama_alat,
                    "tanggal_kalibrasi" => $tanggal,
                    "waktu"=> $perbedaan." Hari lagi",
                    "gambar"=>$val->gambar
                ];
            }
          
            $proses[] = $val;
           

        }

        // $data = @Table::all();
        return view($this->dir . '/index', compact('title', 'bulans', 'tahuns', 'pages', 'bulan', 'alat', 'proses', 'offset', 'day', 'proses', 'jumlah_page', 'reminder'));
    }
    function dateDiff ($d1, $d2) {

        // Return the number of days between the two dates:    
        return round(abs(strtotime($d1) - strtotime($d2))/86400);
    
    } // end function dateDiff
     function check_in_range($start_date, $end_date, $date_from_user)
    {
        // Convert to timestamp
        $start_ts = strtotime($start_date);
        $end_ts = strtotime($end_date);
        $user_ts = strtotime($date_from_user);

        // Check that user date is between start & end
        return (($user_ts >= $start_ts) && ($user_ts <= $end_ts));
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

        return view($this->dir . '/create', compact('title'));
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

        $alat = $_POST['kode'];
        $data = @$_POST['jadwal'];
        $bulan = @$_POST['bulan'];
        $tahun = @$_POST['tahun'];
        $success = true;

        foreach ($alat as $alat) {
            $ubahstatus = JadwalKalibrasi::select("*")
                ->where(["id_alat" => $alat])
                ->whereMonth("tanggal", $bulan)
                ->whereYear("tanggal", $tahun)
                ->first();
            if ($ubahstatus) {

                $del = JadwalKalibrasi::where("id_alat", $ubahstatus["id_alat"]);
                $delete = $del->delete();
            }
            if (@$_POST['jadwal'][$alat]) {
                $libur = $_POST['jadwal'][$alat];
                if (count($libur)) {
                    foreach ($libur as $libur) {
                        $tanggal = $tahun . '-' . $bulan . '-' . sprintf('%02s', $libur);

                        $insertjadwal = new JadwalKalibrasi;
                        $insertjadwal->id_alat = $alat;
                        $insertjadwal->tanggal = $tanggal;
                        $save = $insertjadwal->save();
                        if (!$save) {
                            $success = false;
                        }
                    }
                }
            }
        }
        if ($success) {
            die(json_encode(array(
                'success' => true,
            )));
        } else {
            die(json_encode(array(
                'success' => false,
            )));
        }

    }

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
        $table = SumberDana::find($id);
        $title = "";
        $subtitle = "";
        return view($this->dir . '/info', compact('data', 'table', 'title', 'subtitle'));
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
        $data = SumberDana::find($id);

        $title = "Edit Data";
        $subtitle = "";

        return view($this->dir . '/edit', compact('data', 'title', 'subtitle'));
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
            "nama" => "required",

        ]);

        @$sumber_dana = SumberDana::find($id);

        $sumber_dana->nama = $request->nama;
        $save = $sumber_dana->save();

        if ($save) {
            //Do Your Something
            $status = 1;
            // return redirect($this->url);
            $msg = "Data Successfully Updated";
            $success = true;
        } else {
            //Do Your Something
            $status = 0;
            $success = false;
            $msg = "Data Failed to Update";

        }

        return [
            'success' => $success,
            'msg' => $msg,
        ];

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        //
        $table = SumberDana::find($id);
        $delete = $table->delete();
        if ($delete) {
            $success = true;
            $msg = 'Data Deleted successfully';

        } else {

            $msg = 'Failed to delete ';
            $success = false;
        }

        return [
            'success' => $success,
            'msg' => $msg,
        ];
    }

}
