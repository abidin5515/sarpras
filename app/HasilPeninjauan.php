<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class HasilPeninjauan extends Model
{
    //
    protected $table = 'hasil_tinjauan';
    public function petugas(){
     return $this->belongsTo('App\Teknisi', 'id_teknisi', 'id');
    }
    public function supplier(){
    	return $this->belongsTo('App\Supplier', 'id_supplier', 'id');
    }
}
