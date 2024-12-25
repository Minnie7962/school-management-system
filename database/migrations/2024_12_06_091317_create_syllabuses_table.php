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
        Schema::create('syllabuses', function (Blueprint $table) {
            $table->id();
            $table->string('syllabus_id', 40)->unique();
            $table->string('subject', 100);
            $table->string('class', 20);
            $table->string('title', 255);
            $table->text('description')->nullable();
            $table->string('file', 255)->default('-1');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('syllabuses');
    }
};
