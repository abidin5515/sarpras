<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class PenggunaanGenset extends Model
{
    protected $table = 'penggunaan_genset';
    public $timestamps = false;

    public function teknisi(){
        return $this->belongsTo('App\Teknisi','id_teknisi_setempat','id');
    }

}
