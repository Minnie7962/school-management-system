<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeacherGuardian extends Model
{
    protected $fillable = [
        'teacher_id', 'guardian_name', 'phone'
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}
