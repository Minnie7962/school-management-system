<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    protected $fillable = [
        'sender_id', 'leave_type', 'leave_desc', 'start_date', 
        'end_date', 'reason', 'approved_by', 'status'
    ];

    public function sender()
    {
        return $this->belongsTo(User::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
    
}
