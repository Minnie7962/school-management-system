<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Admin extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $fillable = [
        'admin_id', 'first_name', 'last_name', 'dob', 'phone'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }    
}
