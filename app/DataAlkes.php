<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class DataAlkes extends Model
{
    //
    protected $table = 'data_alkes';

    public function ruangan(){
    	return $this->belongsTo('App\Ruangan', 'id_ruangan', 'id');
    }

    public function alat(){
        return $this->belongsTo('App\Alat', 'id_alat', 'id');
    }

    public function pemilik(){
    	return $this->belongsTo('App\Kepemilikan', 'id_kepemilikan', 'id');
    }

    public function supplier(){
    	return $this->belongsTo('App\Supplier', 'id_supplier', 'id');
    }

    public function sumber_dana(){
    	return $this->belongsTo('App\SumberDana', 'id_sumber_dana', 'id');
    }
}
