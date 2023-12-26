<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Permintaan extends Model
{
    protected $table = 'permintaan';
    public $timestamps = false;

    public function ruangan(){
    	return $this->belongsTo('App\Ruangan','id_ruang','id');
    }
}
