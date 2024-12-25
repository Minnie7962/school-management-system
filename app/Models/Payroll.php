<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    protected $fillable = [
        'payroll_id', 'employee_id', 'employee_type', 
        'basic_salary', 'allowances', 'deductions', 'net_salary', 
        'payment_date', 'status'
    ];

    public function employee() {
        return $this->belongsTo(User::class);
    }
    
}
