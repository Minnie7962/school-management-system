<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassModel extends Model
{
    protected $fillable = [
        'name', 'section', 'fees'
    ];

    public function subjects()
    {
        return $this->hasMany(Subject::class, 'class', 'name');
    }
}
