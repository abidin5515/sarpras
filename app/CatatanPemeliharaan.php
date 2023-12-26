<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class CatatanPemeliharaan extends Model
{
    //
    protected $table = 'catatan_pemeliharaan';
    public $timestamps = false;




    public function data_alkes(){
    	return $this->belongsTo('App\DataAlkes','id_alkes','id');
    }


    public function vendor(){
    	return $this->belongsTo('App\Supplier','id_vendor','id');
    }



    public function teknisi(){
        return $this->belongsTo('App\Teknisi','id_teknisi_setempat','id');
    }


    public function jenis_pekerjaan(){
    	return $this->belongsTo('App\JenisPekerjaan','id_jenis_pekerjaan','id');
    }

    public function ruangan(){
    	return $this->belongsTo('App\Ruangan','id_ruang','id');
    }
}
