<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Database\Eloquent\Model;

class LoginLog extends Model
{
    protected $fillable = [
        'user_id', 'login_time', 'ip_address'
    ];
}
