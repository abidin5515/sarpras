<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Perbaikan extends Model
{
    //
    protected $table = 'perbaikan';
    // public $timestamps = false;


    public function teknisi_penanggung_jawab(){
        return $this->belongsTo('App\Teknisi','id_teknisi_penanggung_jawab','id');
    }

    
}
