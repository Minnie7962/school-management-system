<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $fillable = [
        'exam_id', 'title', 'subject', 'class', 'section'
    ];

    public function marks() {
        return $this->hasMany(Mark::class);
    }    
}
