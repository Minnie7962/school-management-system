<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dashboard extends Model
{
    use HasFactory;

    protected $fillable = [
        'total_students',
        'total_teachers',
        'total_courses',
        'total_enrollments',
    ];

    // Add any relationships or custom methods as needed
}
