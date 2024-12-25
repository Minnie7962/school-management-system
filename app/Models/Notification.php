<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'sender_id', 'class', 'section', 'type', 'title', 'message', 'file'
    ];

    public function sender()
    {
        return $this->belongsTo(User::class);
    }
}
