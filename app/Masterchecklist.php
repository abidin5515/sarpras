<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class MasterChecklist extends Model
{
    protected $table = 'master_checklist';
    protected $guarded = ['id'];

    public function masterBarang() {
        return $this->belongsTo(MasterBarang::class, 'master_barang_id');
    }
}