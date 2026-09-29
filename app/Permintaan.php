<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Permintaan extends Model
{
    protected $table = 'permintaan';
    public $timestamps = false;

    public function master_ceklis(){
    	return $this->belongsTo('App\MasterCeklis','id_master_ceklis','id');
    }

    public function ruangan(){
    	return $this->belongsTo('App\Ruangan','id_ruang','id');
    }

    public function pekerjaan()
    {
        // Parameter 1: Class model Pekerjaan
        // Parameter 2: Foreign key di tabel pekerjaan ('id_permintaan')
        // Parameter 3: Local key di tabel permintaan ('id')
        return $this->hasOne(\App\Pekerjaan::class, 'id_permintaan', 'id');
    }
}
