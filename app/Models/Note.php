<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $fillable = [
        'sender_id', 'editor_id', 'class', 'subject', 'title', 'file'
    ];

    public function sender() {
        return $this->morphTo();
    }
    
    public function editor() {
        return $this->morphTo();
    }    
}
