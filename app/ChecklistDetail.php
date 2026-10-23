<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class ChecklistDetail extends Model
{
    protected $table = 'checklist_detail';
    protected $guarded = ['id'];

    public function masterChecklist() {
        return $this->belongsTo(MasterChecklist::class, 'master_checklist_id');
    }
}