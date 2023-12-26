<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class KategoriChecklist extends Model
{
    //
    protected $table = 'kategori_checklist';

    public function checklists(){
    	    // public function hasMany($related, $foreignKey = null, $localKey = null)

    return $this->hasMany('App\Checklist','id_kategori_checklist','id');
    }
}
