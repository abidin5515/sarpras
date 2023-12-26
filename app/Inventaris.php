<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventaris extends Model
{
    //
    protected $table = 'inventaris';


    public function mastermerk(){
    	return $this->belongsTo('App\MasterMerk','merk','id');
    }

    public function masterruang(){
    	return $this->belongsTo('App\Ruangan','ruang','id');
    }

    public function masterbarang(){
    	return $this->belongsTo('App\MasterBarang','master_barang_id','id');
    }
}
