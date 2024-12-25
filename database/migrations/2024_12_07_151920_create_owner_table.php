<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('owners', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->text('address')->nullable();

            // Payment fields
            $table->string('payment_status')->nullable();
            $table->decimal('total_payments', 10, 2)->default(0);
            $table->timestamp('last_payment_date')->nullable();

            // Notice fields
            $table->boolean('can_send_notices')->default(false);
            $table->timestamp('last_notice_sent')->nullable();

            // QR and authentication
            $table->string('qr_code')->nullable();
            $table->timestamp('password_changed_at')->nullable();

            // Student and Teacher management
            $table->boolean('can_view_students')->default(false);
            $table->boolean('can_view_teachers')->default(false);

            // Attendance tracking
            $table->boolean('can_view_attendance')->default(false);
            $table->timestamp('last_attendance_check')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('owner');
    }
};
