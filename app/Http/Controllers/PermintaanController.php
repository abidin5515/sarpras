<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use PDF;
use Rap2hpoutre\FastExcel\FastExcel;
use App\Permintaan;
use Validator;
use Redirect;
use Image;
use App\Ruangan;

class PermintaanController extends Controller
{
  protected $dir = "permintaan";
  protected $url = "permintaan";

  public function index()
  {
    return view('permintaan/index');
  }

  public function json(Request $request)
  {

    $dari_tanggal = ($request->dari_tanggal != '' ? $request->dari_tanggal : date('Y-m-d'));
    $sampai_tanggal = ($request->sampai_tanggal != '' ? $request->sampai_tanggal : date('Y-m-d'));

    $data = Permintaan::select([
      'permintaan.id',
      'permintaan.id_ruang',
      'permintaan.pengirim',
      'permintaan.tanggal',
      'permintaan.masalah',
      'permintaan.lantai',
      'permintaan.foto',
      'permintaan.status',
      'permintaan.created_at'

    ])->where('status', 'pending')->orderBy('permintaan.id', 'desc');
    // $data->where('permintaan.status', '!=', 'selesai');

    if (!empty($dari_tanggal)) {
      // $data->where(['permintaan.tanggal'=>$tanggal]);
      $data->whereDate('created_at', '>=', $dari_tanggal);
    }

    if (!empty($sampai_tanggal)) {
      // $data->where(['permintaan.tanggal'=>$tanggal]);
      $data->whereDate('created_at', '<=', $sampai_tanggal);
    }


    return Datatables::of($data)->addColumn('action', function ($d) {
      return '<button class="btn btn-danger delete-btn btn-sm" href="' . url($this->url . '/' . $d->id) . '"><i class="fas fa-trash"></i></button>

                <a href="' . url('catatan-pemeliharaan/create?id_permintaan=') . $d->id . '" class="btn btn-primary">Kerjakan</a>

              ';
    })->addColumn('tanggal', function ($d) {
      return date('d-m-Y', strtotime($d->created_at));
    })->addColumn('ruang', function ($d) {
      return @$d->ruangan->nama;
    })

      ->addColumn('foto', function ($d) {
        if ($d->foto) {
          return '<img src="' . url($d->foto) . '" width="150" class="create-btn foto-zoom" data-lg="false" data-save="false" data-src="' . url('permintaan/view_gambar?url=' . $d->foto) . '">';
        } else {
          return '';
        }
      })
      ->make(true);
  }


  public function create()
  {
    $ruangan = Ruangan::all();
    return view('permintaan/create', compact('ruangan'));
  }



  public function store(Request $request)
  {

    // $pengirim   = $request->pengirim;
    // $tanggal =  $request->tanggal;
    $masalah        = $request->masalah;
    $lokasi          = $request->lokasi;
    $lantai  = $request->lantai;

    // $validatedData = Validator::make($request->all(), ([
    //     'masalah' => 'required',
    //     // 'lokasi' => 'required',
    //     'lantai' => 'required',
    //     'pengirim' => 'required',
    //     'tanggal' => 'required',
    // ]);


    $validatedData = Validator::make($request->all(), [ // <---
      'masalah' => 'required',
      // 'lokasi' => 'required',
      // 'lantai' => 'required',
      // 'pengirim' => 'required',
      // 'tanggal' => 'required',
    ]);

    if ($validatedData->fails()) {
      return Redirect::back()->withErrors($validatedData)->withInput();
    }

    $file = $request->file('foto');
    if ($file) {
      $namaFile = $file->getClientOriginalName();
      $tujuan_upload = 'gambar_permintaan/';
      $namaUpload = $tujuan_upload . $namaFile;
      // $file->move($tujuan_upload,$file->getClientOriginalName());

      // compress gambar
      $img = Image::make($file->getRealPath());
      $img->resize(450, 450, function ($constraint) {
        $constraint->aspectRatio();
      })->save($tujuan_upload . $namaFile);
    }



    $permintaan = new Permintaan;
    // $permintaan->tanggal = $tanggal;
    // $permintaan->pengirim = $pengirim;
    $permintaan->masalah = $masalah;
    $permintaan->lokasi = $lokasi;
    $permintaan->lantai = $lantai;
    $permintaan->id_ruang = $request->id_ruang;
    if ($file) {
      $permintaan->foto = $namaUpload;
    }
    $permintaan->status = 'pending';
    $save = $permintaan->save();


    if ($save) {
      return redirect()->back()->with('message', 'Data Berhasil Dikirim!');
    } else {
      return redirect()->back()->with('error', 'Data Gagal Dikirim!');
    }
  }

  public function destroy($id, Request $request)
  {
    $table = Permintaan::find($id);
    $delete = $table->delete();
    if ($delete) {
      $success = true;
      $msg = 'Data Berhasil Dihapus';
    } else {

      $msg = 'Data Gagal Dihapus';
      $success = false;
    }

    return [
      'success' => $success,
      'msg' => $msg
    ];
  }


  public function view_gambar(Request $req)
  {
    $url = $req->url;
    return view('permintaan.view_gambar', compact('url'));
  }




  public function permintaan_selesai()
  {
    return view('permintaan.permintaan_selesai');
  }


  public function selesai_json(Request $request)
  {

    $dari_tanggal = ($request->dari_tanggal != '' ? $request->dari_tanggal : date('Y-m-d'));
    $sampai_tanggal = ($request->sampai_tanggal != '' ? $request->sampai_tanggal : date('Y-m-d'));
    $data = Permintaan::select([
      'permintaan.id',
      'permintaan.id_ruang',
      'permintaan.pengirim',
      'permintaan.tanggal',
      'permintaan.masalah',
      'permintaan.lantai',
      'permintaan.foto',
      'permintaan.status',
      'permintaan.created_at'

    ])->where('status', 'selesai')->orderBy('permintaan.id', 'desc');
    // $data->where('permintaan.status', '!=', 'selesai');

    if (!empty($dari_tanggal)) {
      // $data->where(['permintaan.tanggal'=>$tanggal]);
      $data->whereDate('created_at', '>=', $dari_tanggal);
    }

    if (!empty($sampai_tanggal)) {
      // $data->where(['permintaan.tanggal'=>$tanggal]);
      $data->whereDate('created_at', '<=', $sampai_tanggal);
    }


    return Datatables::of($data)->addColumn('action', function ($d) {
      // return '<button class="btn btn-danger delete-btn btn-sm" href="'.url($this->url.'/'.$d->id).'"><i class="fas fa-trash"></i></button>  

      // ';
    })->addColumn('tanggal', function ($d) {
      return date('d-m-Y', strtotime($d->created_at));
    })->addColumn('ruang', function ($d) {
      return @$d->ruangan->nama;
    })

      ->addColumn('foto', function ($d) {
        if ($d->foto) {
          return '<img src="' . url($d->foto) . '" width="150" class="create-btn foto-zoom" data-lg="false" data-save="false" data-src="' . url('permintaan/view_gambar?url=' . $d->foto) . '">';
        } else {
          return '';
        }
      })
      ->make(true);
  }



  public function excel_selesai(Request $request)
  {
    $dari_tanggal = $request->dari_tanggal;
    $sampai_tanggal = $request->sampai_tanggal;
    $data = Permintaan::where('status', 'selesai')
      ->whereDate('created_at', '>=', $dari_tanggal)
      ->whereDate('created_at', '<=', $sampai_tanggal)
      ->get();
    $nama_file = 'Permintaan Selesai ' . date('d-m-Y', strtotime($dari_tanggal)) . ' sd ' . date('d-m-Y', strtotime($sampai_tanggal)) . '.xlsx';
    return (new FastExcel($data))->download($nama_file, function ($d) {

      return [
        'Ruang' => @$d->ruangan->nama,
        'Masalah' => $d->masalah,
        'Lantai' => $d->lantai,
        'Tanggal' => date('d-m-Y H:i', strtotime($d->created_at)),
        'Status' => $d->status,

      ];
    });
  }


  public function excel_pending(Request $request)
  {
    $dari_tanggal = $request->dari_tanggal;
    $sampai_tanggal = $request->sampai_tanggal;
    $data = Permintaan::where('status', 'pending')
      ->whereDate('created_at', '>=', $dari_tanggal)
      ->whereDate('created_at', '<=', $sampai_tanggal)
      ->get();
    $nama_file = 'Permintaan Pending ' . date('d-m-Y', strtotime($dari_tanggal)) . ' sd ' . date('d-m-Y', strtotime($sampai_tanggal)) . '.xlsx';
    return (new FastExcel($data))->download($nama_file, function ($d) {

      return [
        'Ruang' => @$d->ruangan->nama,
        'Masalah' => $d->masalah,
        'Lantai' => $d->lantai,
        'Tanggal' => date('d-m-Y H:i', strtotime($d->created_at)),
        'Status' => $d->status,

      ];
    });
  }

  public function pdf_pending(Request $request)
  {
    $dari_tanggal = $request->dari_tanggal;
    $sampai_tanggal = $request->sampai_tanggal;
    $data = Permintaan::where('status', 'pending')
      ->whereDate('created_at', '>=', $dari_tanggal)
      ->whereDate('created_at', '<=', $sampai_tanggal)
      ->orderBy('created_at', 'DESC')
      ->get();
    $nama_file = 'Permintaan Pending ' . date('d-m-Y', strtotime($dari_tanggal)) . ' sd ' . date('d-m-Y', strtotime($sampai_tanggal)) . '.pdf';
    $pdf = PDF::loadView('permintaan.pending_pdf', compact('data'));
    return $pdf->stream($nama_file);
  }


  // Ambil riwayat permintaan berdasarkan ruangan
 // Ambil Riwayat Hanya Ketika Ruangan Dipilih (Via AJAX)
// Ambil Riwayat khusus Ruangan terpilih
public function getHistory(Request $request)
{
    $id_ruang = $request->id_ruang;

    if (!$id_ruang) {
        return response()->json(['success' => false, 'data' => []]);
    }

    $history = Permintaan::with(['pekerjaan'])
        ->where('id_ruang', $id_ruang)
        ->orderBy('created_at', 'desc')
        ->limit(20)
        ->get();

    // Batch Query Teknisi
    $allTeknisiIds = [];
    foreach ($history as $item) {
        if ($item->pekerjaan && $item->pekerjaan->id_teknisi) {
            $ids = explode(',', $item->pekerjaan->id_teknisi);
            $allTeknisiIds = array_merge($allTeknisiIds, $ids);
        }
    }

    $teknisiMap = \App\Teknisi::whereIn('id', array_unique($allTeknisiIds))
        ->get()
        ->keyBy('id');

    // Format Data JSON
    $dataHistory = $history->map(function ($item) use ($teknisiMap) {
        $listTeknisi = [];
        $ratingTeknisiParsed = [];

        if ($item->pekerjaan) {
            // Parse JSON Rating Per Teknisi dari Database
            if ($item->pekerjaan->rating_teknisi) {
                $ratingTeknisiParsed = json_decode($item->pekerjaan->rating_teknisi, true) ?? [];
            }

            // Map ID Rating ke Teknisi
            $ratingByTeknisiId = [];
            foreach ($ratingTeknisiParsed as $rt) {
                $ratingByTeknisiId[$rt['id_teknisi']] = $rt['rating'];
            }

            if ($item->pekerjaan->id_teknisi) {
                $ids = explode(',', $item->pekerjaan->id_teknisi);
                foreach ($ids as $t_id) {
                    if (isset($teknisiMap[$t_id])) {
                        $listTeknisi[] = [
                            'id' => $teknisiMap[$t_id]->id,
                            'nama' => $teknisiMap[$t_id]->nama,
                            'rating' => $ratingByTeknisiId[$t_id] ?? null // Rating per teknisi
                        ];
                    }
                }
            }
        }

        return [
            'id' => $item->id,
            'tanggal' => date('d-m-Y H:i', strtotime($item->created_at)),
            'masalah' => $item->masalah,
            'status' => $item->status,
            'rating_kepuasan' => $item->rating_kepuasan,
            'catatan_kepuasan' => $item->catatan_kepuasan,
            'pekerjaan' => $item->pekerjaan ? [
                'perbaikan' => $item->pekerjaan->perbaikan,
                'keterangan' => $item->pekerjaan->keterangan,
                'list_teknisi' => $listTeknisi
            ] : null
        ];
    });

    return response()->json(['success' => true, 'data' => $dataHistory]);
}

// Simpan Rating via AJAX & Kirim Notifikasi
public function simpanRating(Request $request)
{
    $request->validate([
        'id_permintaan' => 'required',
        'rating_kepuasan' => 'required|integer|min:1|max:5',
    ]);

    // Update Permintaan
    $permintaan = Permintaan::findOrFail($request->id_permintaan);
    $permintaan->rating_kepuasan = $request->rating_kepuasan;
    $permintaan->catatan_kepuasan = $request->catatan_kepuasan;
    $permintaan->save();

    // Update Rating Per Teknisi pada Pekerjaan
    if ($request->has('rating_teknisi')) {
        $pekerjaan = \App\Pekerjaan::where('id_permintaan', $request->id_permintaan)->first();
        if ($pekerjaan) {
            $ratingTeknisiArr = [];
            foreach ($request->rating_teknisi as $id_teknisi => $score) {
                if (!empty($score)) {
                    $ratingTeknisiArr[] = [
                        'id_teknisi' => (int) $id_teknisi,
                        'rating' => (int) $score
                    ];
                }
            }
            $pekerjaan->rating_teknisi = json_encode($ratingTeknisiArr);
            $pekerjaan->save();
        }
    }

    return response()->json([
        'success' => true, 
        'message' => 'Terima kasih! Penilaian kepuasan pelayanan berhasil disimpan.'
    ]);
}

  // Simpan rating kepuasan & rating per teknisi

}
