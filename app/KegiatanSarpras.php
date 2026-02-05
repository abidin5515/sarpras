<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Teknisi;
class KegiatanSarpras extends Model
{

    protected $table = 'kegiatan_sarpras';

    protected $fillable = [
        'nama_kegiatan',
        'tanggal',
        'jam_mulai',
        'jam_selesai',
        'status',
        'keterangan',
        'foto'
    ];

    /**
     * Relasi: 1 kegiatan punya banyak teknisi
     */
    public function teknisi()
    {
        return $this->belongsToMany(
            Teknisi::class,
            'kegiatan_teknisi',
            'kegiatan_id',
            'teknisi_id'
        );
    }
}
