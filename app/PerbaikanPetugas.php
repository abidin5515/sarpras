<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class PerbaikanPetugas extends Model
{
    //
    protected $table = 'perbaikan_petugas';
    // public $timestamps = false;


    public function petugas(){
        return $this->belongsTo('App\Teknisi','id_petugas','id');
    }
}
