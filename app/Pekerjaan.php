<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Pekerjaan extends Model
{
    protected $table = 'pekerjaan';

    public function teknisi(){
        return $this->belongsTo('App\Teknisi','id_teknisi','id');
    }


    public function permintaan(){
        return $this->belongsTo('App\Permintaan','id_permintaan','id');
    }
}
