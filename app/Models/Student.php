<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'user_id',
        'admission_number',
        'class',
        'section',
        'roll_number',
        'date_of_birth',
        'gender',
        'phone',
        'address',
        'parent_name',
        'parent_phone'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function attendances(): HasMany
    {
        return $this->hasMany(Attendance::class);
    }

    public function marks(): HasMany
    {
        return $this->hasMany(Mark::class);
    }
}
