<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class ChecklistHeader extends Model
{
    protected $table = 'checklist_header';
    protected $guarded = ['id'];

    public function inventaris() {
        return $this->belongsTo(Inventaris::class, 'inventaris_id');
    }

    public function teknisi() {
        return $this->belongsTo(Teknisi::class, 'teknisi_id');
    }

    public function details() {
        return $this->hasMany(ChecklistDetail::class, 'checklist_header_id');
    }
}