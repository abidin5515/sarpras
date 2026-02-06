<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\KegiatanSarpras;
use App\Teknisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KegiatanSarprasController extends Controller
{
    /**
     * Menampilkan daftar kegiatan sarpras
     */
    public function index()
    {
        $kegiatan = KegiatanSarpras::with('teknisi')
            ->orderBy('tanggal', 'desc')
            ->orderBy('jam_mulai', 'desc')
            ->get();
        // return "ok";
        return view('kegiatan.index', compact('kegiatan'));
    }

    /**
     * Form tambah kegiatan
     */
    public function create()
    {
        $teknisi = Teknisi::orderBy('nama')->get();
        // print_r($teknisi);
        // return;
        return view('kegiatan.create', compact('teknisi'));
    }

    /**
     * Simpan kegiatan baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'tanggal'        => 'required|date',
            'jam_mulai'      => 'required',
            'teknisi'        => 'required|array|min:1',
            'foto'           => 'nullable|image|max:2048'
        ]);

        $fotoPath = null;

        if ($request->hasFile('foto')) {

            $file = $request->file('foto');

            $ext = strtolower($file->getClientOriginalExtension());
            $filename = 'kegiatan_' . time() . '_' . rand(100, 999) . '.jpg';
            $folder = storage_path('app/public/kegiatan_sarpras');

            if (!file_exists($folder)) {
                mkdir($folder, 0775, true);
            }

            // ===== create image resource
            if ($ext === 'jpg' || $ext === 'jpeg') {
                $source = imagecreatefromjpeg($file->getPathname());
            } elseif ($ext === 'png') {
                $source = imagecreatefrompng($file->getPathname());
            } else {
                return back()->withErrors(['foto' => 'Format foto tidak didukung']);
            }

            // ===== resize (max width 1280)
            $width  = imagesx($source);
            $height = imagesy($source);

            $maxWidth = 1280;

            if ($width > $maxWidth) {
                $newWidth  = $maxWidth;
                $newHeight = intval(($height / $width) * $newWidth);
            } else {
                $newWidth  = $width;
                $newHeight = $height;
            }

            $resize = imagecreatetruecolor($newWidth, $newHeight);
            imagecopyresampled($resize, $source, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

            // ===== save as JPG (quality 70)
            imagejpeg($resize, $folder . '/' . $filename, 38);

            // ===== cleanup memory
            imagedestroy($source);
            imagedestroy($resize);

            $fotoPath = 'kegiatan_sarpras/' . $filename;
        }

        $kegiatan = KegiatanSarpras::create([
            'nama_kegiatan' => $request->nama_kegiatan,
            'tanggal'        => $request->tanggal,
            'jam_mulai'      => $request->jam_mulai,
            'jam_selesai'    => $request->jam_selesai,
            'status'         => $request->status,
            'keterangan'     => $request->keterangan,
            'foto'           => $fotoPath
        ]);

        // simpan relasi teknisi
        $kegiatan->teknisi()->sync($request->teknisi);

        return redirect()
            ->route('kegiatan-sarpras.index')
            ->with('success', 'Kegiatan Sarpras berhasil ditambahkan');
    }

    /**
     * Detail kegiatan
     */
    public function show($id)
    {
        $kegiatan = KegiatanSarpras::with('teknisi')->findOrFail($id);
        return view('kegiatan.show', compact('kegiatan'));
    }

    /**
     * Form edit kegiatan
     */
    public function edit($id)
    {
        $kegiatan = KegiatanSarpras::with('teknisi')->findOrFail($id);
        $teknisi  = Teknisi::orderBy('nama')->get();

        return view('kegiatan.edit', compact('kegiatan', 'teknisi'));
    }

    /**
     * Update kegiatan
     */
    public function update(Request $request, $id)
    {
        $kegiatan = KegiatanSarpras::findOrFail($id);

        $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'tanggal'        => 'required|date',
            'jam_mulai'      => 'required',
            'teknisi'        => 'required|array|min:1',
            'foto'           => 'nullable|image|max:2048'
        ]);

        // update foto jika ada (compress)
        if ($request->hasFile('foto')) {

            // hapus foto lama
            if ($kegiatan->foto && Storage::disk('public')->exists($kegiatan->foto)) {
                Storage::disk('public')->delete($kegiatan->foto);
            }

            $file = $request->file('foto');
            $ext = strtolower($file->getClientOriginalExtension());

            $filename = 'kegiatan_' . time() . '_' . rand(100, 999) . '.jpg';
            $folder = storage_path('app/public/kegiatan_sarpras');

            if (!file_exists($folder)) {
                mkdir($folder, 0775, true);
            }

            // create image
            if (in_array($ext, ['jpg', 'jpeg'])) {
                $source = imagecreatefromjpeg($file->getPathname());
            } elseif ($ext === 'png') {
                $source = imagecreatefrompng($file->getPathname());
            } else {
                return back()->withErrors(['foto' => 'Format foto tidak didukung']);
            }

            // rotate exif (HP sering butuh)
            $exif = @exif_read_data($file->getPathname());
            if (!empty($exif['Orientation'])) {
                switch ($exif['Orientation']) {
                    case 3:
                        $source = imagerotate($source, 180, 0);
                        break;
                    case 6:
                        $source = imagerotate($source, -90, 0);
                        break;
                    case 8:
                        $source = imagerotate($source, 90, 0);
                        break;
                }
            }

            // resize
            $width  = imagesx($source);
            $height = imagesy($source);
            $maxWidth = 1280;

            if ($width > $maxWidth) {
                $newWidth  = $maxWidth;
                $newHeight = intval(($height / $width) * $newWidth);
            } else {
                $newWidth  = $width;
                $newHeight = $height;
            }

            $resize = imagecreatetruecolor($newWidth, $newHeight);
            imagecopyresampled($resize, $source, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

            // save
            imagejpeg($resize, $folder . '/' . $filename, 38);

            imagedestroy($source);
            imagedestroy($resize);

            $kegiatan->foto = 'kegiatan_sarpras/' . $filename;
        }

        $kegiatan->update([
            'nama_kegiatan' => $request->nama_kegiatan,
            'tanggal'        => $request->tanggal,
            'jam_mulai'      => $request->jam_mulai,
            'jam_selesai'    => $request->jam_selesai,
            'keterangan'     => $request->keterangan,
            'status'         => $request->status,
        ]);

        // update teknisi
        $kegiatan->teknisi()->sync($request->teknisi);

        return redirect()
            ->route('kegiatan-sarpras.index')
            ->with('success', 'Kegiatan Sarpras berhasil diperbarui');
    }

    /**
     * Tandai kegiatan selesai
     */
    public function selesai($id)
    {
        $kegiatan = KegiatanSarpras::findOrFail($id);

        $kegiatan->update([
            'status'      => 'selesai',
            'jam_selesai' => now()->format('H:i:s')
        ]);

        return back()->with('success', 'Kegiatan ditandai selesai');
    }

    /**
     * Hapus kegiatan
     */
    public function destroy($id)
    {
        $kegiatan = KegiatanSarpras::findOrFail($id);

        if ($kegiatan->foto) {
            Storage::disk('public')->delete($kegiatan->foto);
        }

        $kegiatan->delete();

        return back()->with('success', 'Kegiatan Sarpras berhasil dihapus');
    }
}
