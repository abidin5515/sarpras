<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class DataCeklis extends Model
{
    //
    protected $table = 'data_ceklis';
     protected $fillable = ['id_master_ceklis', 'tanggal', 'shif', 'jumlah', 'keterangan'];	
    public function master_ceklis(){


    return $this->belongsTo('App\MasterCeklis','id_master_ceklis','id');
    }
}
