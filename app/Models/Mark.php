<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Mark extends Model
{
    protected $fillable = [
        'student_id',
        'subject_id',
        'exam_type',
        'marks_obtained',
        'total_marks',
        'grade',
        'remarks'
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($mark) {
            $percentage = ($mark->marks_obtained / $mark->total_marks) * 100;
            $mark->grade = self::calculateGrade($percentage);
        });
    }

    protected static function calculateGrade($percentage)
    {
        if ($percentage >= 90) return 'A+';
        if ($percentage >= 80) return 'A';
        if ($percentage >= 70) return 'B+';
        if ($percentage >= 60) return 'B';
        if ($percentage >= 50) return 'C';
        return 'F';
    }
}
