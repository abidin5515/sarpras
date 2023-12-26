<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class PermintaanPelayanan extends Model
{
    //
    protected $table = 'permintaan_pelayanan';


    public function ruangan(){
    	return $this->belongsTo('App\Ruangan','id_ruang','id');
    }
    public function data_alkes(){
    	return $this->belongsTo('App\DataAlkes','id_alkes','id');
    }

}
