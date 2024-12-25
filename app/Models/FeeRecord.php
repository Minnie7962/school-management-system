<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeeRecord extends Model
{
    protected $fillable = [
        'student_id', 'class', 'total_fees', 'paid_amount', 
        'balance', 'payment_date', 'status', 'remarks'
    ];

    public function student() {
        return $this->belongsTo(Student::class);
    }
    
}
