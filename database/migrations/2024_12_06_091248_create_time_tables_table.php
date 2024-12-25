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
        Schema::create('time_tables', function (Blueprint $table) {
            $table->id();
            $table->string('timetable_id', 40)->unique();
            $table->string('class', 20);
            $table->string('section', 10);
            $table->time('start_time');
            $table->time('end_time');
            $table->string('subject', 100);
            $table->string('teacher_id', 40);
            $table->string('room', 50)->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->foreignId('editor_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('time_tables');
    }
};
