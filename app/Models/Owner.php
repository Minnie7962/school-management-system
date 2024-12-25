<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Owner extends Model
{
    use SoftDeletes, Notifiable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'owners';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        // Mapping from original PHP project owner panel fields
        'user_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'address',
        
        // Payment-related fields from make-payment.php
        'payment_status',
        'last_payment_date',
        'total_payments',
        
        // Notice-related fields from notices.php
        'can_send_notices',
        'last_notice_sent',
        
        // QR and authentication fields from qr.php and change-password.php
        'qr_code',
        'password_changed_at',
        
        // Student and Teacher list management fields
        'can_view_students',
        'can_view_teachers',
        
        // Attendance tracking
        'can_view_attendance',
        'last_attendance_check'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_payment_date' => 'datetime',
        'last_notice_sent' => 'datetime',
        'password_changed_at' => 'datetime',
        'last_attendance_check' => 'datetime',
        'can_send_notices' => 'boolean',
        'can_view_students' => 'boolean',
        'can_view_teachers' => 'boolean',
    ];

    /**
     * Relationship with User model
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the owner's full name
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    /**
     * Scope a query to only include active owners
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Generate a unique owner ID
     *
     * @return string
     */
    public static function generateOwnerId()
    {
        $prefix = 'OWN';
        $timestamp = now()->format('ymd');
        $randomDigits = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);
        
        return strtoupper($prefix . $timestamp . $randomDigits);
    }

    /**
     * Validation rules for owner
     *
     * @return array
     */
    public static function validationRules()
    {
        return [
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email|unique:owners,email',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
        ];
    }

    /**
     * Check if owner can send notices
     *
     * @return bool
     */
    public function canSendNotices()
    {
        return $this->can_send_notices === true;
    }

    /**
     * Check if owner can view students
     *
     * @return bool
     */
    public function canViewStudents()
    {
        return $this->can_view_students === true;
    }

    /**
     * Check if owner can view teachers
     *
     * @return bool
     */
    public function canViewTeachers()
    {
        return $this->can_view_teachers === true;
    }

    /**
     * Generate QR Code for owner
     *
     * @return string
     */
    public function generateQrCode()
    {
        // Implement QR code generation logic
        // Similar to original qr.php functionality
        return 'generated-qr-code-path';
    }

    /**
     * Make payment method
     *
     * @param float $amount
     * @return bool
     */
    public function makePayment($amount)
    {
        // Implement payment logic from make-payment.php
        $this->total_payments += $amount;
        $this->last_payment_date = now();
        $this->save();

        return true;
    }

    /**
     * Send notice method
     *
     * @param string $notice
     * @return bool
     */
    public function sendNotice($notice)
    {
        if (!$this->canSendNotices()) {
            return false;
        }

        // Implement notice sending logic from notices.php
        $this->last_notice_sent = now();
        $this->save();

        return true;
    }
}
