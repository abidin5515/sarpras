<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class MaintenanceInspection extends Model
{
    //
    protected $table = 'maintenance_inspection';
    // public $timestamps = false;


    public function teknisi(){
    	return $this->belongsTo("App\Teknisi",'id_teknisi','id');
    }
    
}
