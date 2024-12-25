<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'email',
        'password',
        'password_hash',
        'role',
        'theme',
        'email_verified_at',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'password_hash',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'role' => 'string',
        'theme' => 'string',
    ];

    public function getRoleAttribute($value)
    {
        return $value;
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isTeacher(): bool
    {
        return $this->role === 'teacher';
    }

    public function isStudent(): bool
    {
        return $this->role === 'student';
    }

    public function admin() {
        return $this->hasOne(Admin::class);
    }
    
    public function student() {
        return $this->hasOne(Student::class);
    }
    
    public function teacher() {
        return $this->hasOne(Teacher::class);
    }
    
    public function notes() {
        return $this->morphMany(Note::class, 'noteable');
    }
    
    public function notices() {
        return $this->morphMany(Notice::class, 'notifiable');
    }
    
    public function timeTables() {
        return $this->morphedByMany(TimeTable::class, 'user');
    }
    
    public function leaves() {
        return $this->hasMany(Leave::class);
    }
    
    public function feedbacksGiven() {
        return $this->hasMany(Feedback::class, 'sender_id');
    }
    
    public function feedbacksReceived() {
        return $this->hasMany(Feedback::class, 'receiver_id');
    }
    
    public function reminders() {
        return $this->hasMany(Reminder::class);
    }    
}
