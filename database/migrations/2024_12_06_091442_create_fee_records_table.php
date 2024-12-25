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
        Schema::create('fee_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            $table->string('class', 20);
            $table->decimal('total_fees', 10, 2);
            $table->decimal('paid_amount', 10, 2);
            $table->decimal('balance', 10, 2);
            $table->date('payment_date');
            $table->enum('status', ['paid', 'partial', 'unpaid'])->default('unpaid');
            $table->text('remarks')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fee_records');
    }
};
