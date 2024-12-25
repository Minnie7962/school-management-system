<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = [
        'subject_id', 'name', 'class'
    ];

    public function ClassModel()
    {
        return $this->belongsTo(ClassModel::class, 'class', 'name');
    }
}
