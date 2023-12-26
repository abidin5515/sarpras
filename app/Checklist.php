<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Checklist extends Model
{
    //
    protected $table = 'checklist';

    public function kategoriChecklist(){
    	return $this->belongsTo('App\KategoriChecklist','id_kategori_checklist','id');
    }
}
