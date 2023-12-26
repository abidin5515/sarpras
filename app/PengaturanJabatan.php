<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class PengaturanJabatan extends Model
{
    protected $table = 'pengaturan_jabatan';
    
    public function kepala_teknisi(){
    	return $this->belongsTo("App\Teknisi",'kepala_instalasi_alkes','id');
    }
    
}
