<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class CatatanPemeliharaanChecklist extends Model
{
    //
    protected $table = 'catatan_pemeliharaan_checklist';
    // public $timestamps = false;

    public function checklist(){
    	return $this->belongsTo('App\Checklist','id_checklist','id');
    }
}
