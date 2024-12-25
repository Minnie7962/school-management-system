<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $fillable = [
        'sender_id', 'receiver_id', 'message', 'rating'
    ];

    public function sender() {
        return $this->belongsTo(User::class);
    }
    
    public function receiver() {
        return $this->belongsTo(User::class);
    }
    
}
