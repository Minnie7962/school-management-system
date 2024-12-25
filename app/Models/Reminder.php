<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{
    protected $fillable = [
        'reminder_id', 'user_id', 'title', 'message', 
        'reminder_time', 'status'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
    
}
