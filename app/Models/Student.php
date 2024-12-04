<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'user_id', 'student_id', 'first_name', 'last_name',
        'date_of_birth', 'gender', 'class', 'section'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function marks()
    {
        return $this->hasMany(Mark::class);
    }

    public function feePayments()
    {
        return $this->hasMany(Fee_Payment::class);
    }
}
