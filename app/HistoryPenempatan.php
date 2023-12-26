<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class HistoryPenempatan extends Model
{
    //
    protected $table = 'riwayat_perpindahan';
    public $timestamps = false;

    public function ruangan(){
    	return $this->belongsTo('App\Ruangan', 'id_ruangan', 'id');
    }

    public function alat(){
    	return $this->belongsTo('App\Alat', 'id_alat', 'id');
    }
}
