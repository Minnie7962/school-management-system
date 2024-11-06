<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Teacher extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'user_id',
        'employee_id',
        'qualification',
        'specialization',
        'phone',
        'address',
        'joining_date',
        'salary'
    ];

    protected $casts = [
        'joining_date' => 'date',
        'salary' => 'decimal:2'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
