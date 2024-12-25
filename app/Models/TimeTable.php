<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TimeTable extends Model
{
    protected $fillable = [
        'timetable_id', 'class', 'section', 'start_time', 'end_time', 
        'subject', 'teacher_id', 'room', 'status', 'editor_id'
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id', 'teacher_id');
    }

    public function editor()
    {
        return $this->belongsTo(User::class, 'editor_id');
    }

    public function users() {
        return $this->morphToMany(User::class, 'user', 'time_table_user');
    }
    
}
